<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Category\CategoryStoreRequest;
use App\Http\Requests\API\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): CategoryCollection
    {
        return new CategoryCollection(Category::cursorPaginate(50));
    }

    public function store(CategoryStoreRequest $categoryStoreRequest): JsonResponse
    {
        $validated = $categoryStoreRequest->validated();

        Category::create($validated);

        return response()->json([
            'message' => 'Category has been stored successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }

    public function show(string $id): CategoryResource
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    public function update(CategoryUpdateRequest $categoryUpdateRequest, string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $category->update($categoryUpdateRequest->validated());

        return response()->json([
            'message' => 'Category has benn updated successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }

    public function destroy(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'message' => 'Category has been deleted successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }
}
