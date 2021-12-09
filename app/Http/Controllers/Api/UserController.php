<?php

namespace App\Http\Controllers\Api;

use App\Helpers\EntryStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\InitialUpdateRequest;
use App\Http\Resources\ClassEntryResource;
use App\Http\Resources\UserResource;
use App\Models\ClassEntry;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function user() {
        return request()->user();
    }

    public function update(InitialUpdateRequest $request) {
        return new UserResource($this->userService->edit($request->user(), $request->validated()));
    }

    public function entries(Request $request) {
        $ids = array_filter(array_merge($request->user()->children()->get()->pluck('id')->toArray(), [$request->user()->id]));
        $query = ClassEntry::query()
            ->whereIn('user_id', $ids)
            ->whereIn('status', [EntryStatus::PENDING, EntryStatus::APPROVED]);

        if (isset($request->code)) {
            $query->whereHas('entity.template.center', function ($query) use ($request) {
                $query->where('code', $request->code);
            });
        }

        return ClassEntryResource::collection($query->get());
    }
}
