<?php

namespace App\Api\Categories\Controllers;

use App\Api\Categories\Requests\CreateCategoryRequest;
use App\Api\Categories\Requests\UpdateCategoryRequest;
use App\Api\Categories\Resources\CategoryCollection;
use App\Api\Categories\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Domain\Categories\Actions\CreateCategoryAction;
use Domain\Categories\Actions\UpdateCategoryAction;
use Domain\Categories\DTO\CategoryData;
use Domain\Categories\Models\Category;
use Illuminate\Http\JsonResponse;
use Throwable;


class CategoryController extends Controller
{
    public function index(): CategoryCollection
    {
        $categories = Category::applySorts(request('sort'))->applyFilters()->jsonPaginate();
        return CategoryCollection::make($categories);
    }

    public function store(CreateCategoryRequest $request, CreateCategoryAction $createCategoryAction): CategoryResource
    {
        $data = new CategoryData(...$request->validated());
        $category = ($createCategoryAction)($data);
        return CategoryResource::make($category);
    }

    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }

    public function update(
        UpdateCategoryRequest $request,
        Category              $category,
        UpdateCategoryAction  $updateCategoryAction
    ): CategoryResource
    {
        $data = new CategoryData(...$request->validated());
        $category = ($updateCategoryAction)($data, $category);
        return CategoryResource::make($category);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->deleteOrFail();
        return response()->json([
            'message' => 'Category has been deleted',
        ]);
    }
}
