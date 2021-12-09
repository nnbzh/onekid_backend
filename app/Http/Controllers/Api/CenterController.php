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

    public function index(ClassCategory $category) {
        return CenterResource::collection($category->centers()->paginate(20));
    }
}
