<?php

namespace App\Http\Grants;

use App\Exceptions\InvalidCodeException;
use App\Exceptions\SmsCodeExpiredException;
use App\Helpers\PhoneNumberFormatter;
use App\Helpers\Redis\RedisCache;
use App\Helpers\Redis\RedisKey;
use App\Models\User;
use DateInterval;
use Illuminate\Http\Request;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;

class PhoneNumberGrant extends AbstractGrant
{
    private RedisCache $redis;

    /**
     * @param UserRepositoryInterface         $userRepository
     * @param RefreshTokenRepositoryInterface $refreshTokenRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository,
        RedisCache $redis
    ) {
        $this->setUserRepository($userRepository);
        $this->setRefreshTokenRepository($refreshTokenRepository);
        $this->redis = $redis;

        $this->refreshTokenTTL = new \DateInterval('P1M');
    }

    public function getIdentifier(): string
    {
        return 'phone_number';
    }

    /**
     * @throws UniqueTokenIdentifierConstraintViolationException
     * @throws OAuthServerException
     */
    public function respondToAccessTokenRequest(ServerRequestInterface $request, ResponseTypeInterface $responseType, DateInterval $accessTokenTTL): ResponseTypeInterface
    {
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($this->getRequestParameter('scope', $request));
        $user = $this->validateUser($request);

        $scopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);

        // Inject tokens into response
        $responseType->setAccessToken($accessToken);
        $responseType->setRefreshToken($refreshToken);

        return $responseType;
    }

    public function validateUser(ServerRequestInterface $request) {
        $code = $this->getRequestParameter('code', $request);
        $phoneNumber = $this->getRequestParameter('phone', $request);

        if (empty($code)) {
            throw OAuthServerException::invalidRequest('code');
        }

        if (empty($phoneNumber)) {
            throw OAuthServerException::invalidRequest('phone');
        }

        $user = $this->validateCodeAndGetUser(new Request($request->getParsedBody()));

        if ($user instanceof UserEntityInterface === false) {
            $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));

            throw OAuthServerException::invalidCredentials();
        }

        return $user;
    }

    public function validateCodeAndGetUser(Request $request) {
        $provider = config('auth.guards.api.provider');

        if (is_null($model = config('auth.providers.'.$provider.'.model'))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }

        $phoneNumber =  PhoneNumberFormatter::clear($request->get('phone'));
        $value = $this->redis->get(RedisKey::AUTH_CODE.$phoneNumber);

        if (! $value) {
            throw new SmsCodeExpiredException();
        }

        if ($value['code'] !== $request->get('code')) {
            throw new InvalidCodeException();
        }

        $user = User::query()->find($value['user_id']);

        if (! $user) return;

        $user->is_verified = true;
        $user->saveOrFail();

        return new \Laravel\Passport\Bridge\User($user->getAuthIdentifier());
    }
}