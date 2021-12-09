<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassEntryResource;
use App\Models\ClassEntity;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ClassEntryController extends Controller
{
    use ApiResponse;

    public function store(ClassEntity $entity, Request $request) {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        if (! $entity->isBookable() || $entity->isBookedByUser([$request->user_id])) {
            return $this->errorResponse(400, 'Already booked or unavailable');
        }

        return new ClassEntryResource($entity->entries()->create(['user_id' => $request->user_id]));
    }
}
