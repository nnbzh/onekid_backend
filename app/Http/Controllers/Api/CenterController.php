<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CenterResource;
use App\Models\Center;
use App\Models\ClassCategory;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function qrCode(Request $request) {
        $code = $request->code;

        return view('qr_code', compact(['code']));
    }

    public function all(Request $request) {
        return CenterResource::collection(Center::query()->get());
    }

    public function index(ClassCategory $category) {
        return CenterResource::collection($category->centers()->paginate(20));
    }

    public function like(Request $request, Center $center) {
        if ($request->user()->centers()->where('id', $center->id)->doesntExist()) {
            $request->user()->centers()->attach($center);
        }

        return response()->noContent();
    }

    public function dislike(Request $request, Center $center) {
        $request->user()->centers()->where('id', $center->id)->detach($center);

        return response()->noContent();
    }

    public function show(Center $center) {
        return new CenterResource($center);
    }
}
