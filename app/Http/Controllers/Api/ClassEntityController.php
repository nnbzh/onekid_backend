<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassEntityResource;
use App\Models\ClassTemplate;
use Illuminate\Http\Request;

class ClassEntityController extends Controller
{
    public function index(Request $request, ClassTemplate $template) {
        $this->validate($request, [
            'weekday' => 'nullable|int|lte:7|gt:0'
        ]);

        $weekday = $request->weekday ?? now()->weekday();

        $entities = $template->entities()->where('weekday', $weekday)->get();

        return ClassEntityResource::collection($entities);
    }
}
