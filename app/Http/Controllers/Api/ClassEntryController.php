<?php

namespace App\Http\Controllers\Api;

use App\Helpers\EntryStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassEntryResource;
use App\Models\ClassEntity;
use App\Models\ClassEntry;
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
            return $this->errorResponse(200, 'Already booked or unavailable');
        }

        return new ClassEntryResource($entity->entries()->create(['user_id' => $request->user_id]));
    }

    public function approve(ClassEntry $entry) {
        $entry->status = EntryStatus::APPROVED;
        $entry->saveOrFail();

        return new ClassEntryResource($entry);
    }

    public function visit(ClassEntry $entry) {
        $entry->status = EntryStatus::VISITED;
        $entry->saveOrFail();

        return new ClassEntryResource($entry);
    }
}
