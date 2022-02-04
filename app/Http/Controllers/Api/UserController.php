<?php

namespace App\Http\Controllers\Api;

use App\Helpers\EntryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\InitialUpdateRequest;
use App\Http\Resources\CenterResource;
use App\Http\Resources\ClassEntryResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserSubscriptionResource;
use App\Models\ClassEntry;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function user() {
        return new UserResource(request()->user());
    }

    public function update(InitialUpdateRequest $request) {
        return new UserResource($this->userService->edit($request->user(), $request->validated()));
    }

    public function favourites(Request $request) {
        return CenterResource::collection($request->user()->centers()->get());
    }

    public function entries(Request $request) {
        $ids = array_filter(array_merge($request->user()->children()->get()->pluck('id')->toArray(), [$request->user()->id]));
        $query = ClassEntry::query()->with('user', 'entity', 'entity.template');

        if (isset($request->user_id)) {
            $query->where('user_id', $request->user_id);
        } else {
            $query->whereIn('user_id', $ids);
        }

        if (isset($request->code)) {
            $query->whereHas('entity.template.center', function ($query) use ($request) {
                $query->where('code', $request->code);
            });
        }

        return ClassEntryResource::collection($query->get());
    }

    public function pendingClasses(Request $request) {
        $ids = array_filter(array_merge($request->user()->children()->get()->pluck('id')->toArray(), [$request->user()->id]));
        $query = ClassEntry::query()
            ->with('user', 'entity', 'entity.template')
            ->where('status', EntryStatus::PENDING);

        if (isset($request->user_id)) {
            $query->where('user_id', $request->user_id);
        } else {
            $query->whereIn('user_id', $ids);
        }

        if (isset($request->code)) {
            $query->whereHas('entity.template.center', function ($query) use ($request) {
                $query->where('code', $request->code);
            });
        }

        return ClassEntryResource::collection($query->get());
    }

    public function subscription(Request $request) {
        $sub = $request->user()->userSubscription()?->first();

        if (! $sub) {
            return response()->json(['data' => null]);
        }

        return new UserSubscriptionResource($sub);
    }
}
