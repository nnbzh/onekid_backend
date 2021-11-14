<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Models\Filters\GenderFilter;
use App\Models\Gender;
use Illuminate\Http\JsonResponse;

class GenderController extends BaseController
{

    /**
     * @OA\Get (
     *     path="/api/v1/genders",
     *     summary = "List of genders",
     *     operationId="genders.list",
     *     tags={"Genders"},
     *     security={ {"bearer": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="Genders",
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->successResponse(Gender::query()->get());
    }
}