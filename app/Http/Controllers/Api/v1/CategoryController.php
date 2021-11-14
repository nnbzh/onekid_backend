<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\Pagination;
use App\Http\Controllers\BaseController;
use App\Models\ClassCategory;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{

    /**
     * @OA\Get (
     *     path="/api/v1/categories",
     *     summary = "List of categories",
     *     operationId="categories.list",
     *     tags={"Categories"},
     *     security={ {"bearer": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="Categories",
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->successResponse(Pagination::handle(ClassCategory::query()
            ->withCount('classTemplates')
            ->paginate(10)
        ));
    }

    /**
     * @OA\Get (
     *     path="/api/v1/categories/{id}",
     *     summary = "Get category",
     *     operationId="categories.get",
     *     tags={"Categories"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search class by name",
     *         required=false,
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page",
     *         required=false,
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Categories",
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function get($id) {
        $category = ClassCategory::query()->findOrFail($id);
        $classTemplates = $category->classTemplates()->with('centre');

        if (! empty($keyword = request()->get('keyword'))) {
            $classTemplates->where('name', 'ilike', "$keyword%");
        }

        $category->setRelation('class_templates', Pagination::handle($classTemplates->paginate(10)));

        return $this->successResponse($category);
    }
}