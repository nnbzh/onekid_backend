<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof InvalidCodeException) {
            return $this->errorResponse($exception->getCode(), $exception->getMessage());
        }

        if ($exception instanceof SmsCodeExpiredException) {
            return $this->errorResponse($exception->getCode(), $exception->getMessage());
        }

        if ($exception instanceof ThrottleRequestsException) {
            return $this->errorResponse(400, "Вы совершили слишком много попыток, попробуйте позже.");
        }

        if ($exception instanceof OAuthServerException) {
            $error = OAuthExceptionTranslator::translate($exception);

            return $this->errorResponse($error['code'], $error['message']);
        }

        return parent::render($request, $exception);
    }
}
