<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Product\ProductStoreRequest;
use App\Http\Requests\API\Product\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use DB;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        return new ProductCollection(Product::cursorPaginate(50));
    }

    public function store(ProductStoreRequest $productStoreRequest): JsonResponse
    {
        $validated = $productStoreRequest->safe()->merge(['user_id' => auth()->id()])->except(['categories']);

        $categoriesIds = $productStoreRequest->only(['categories'])['categories'];

        DB::transaction(function () use ($validated, $categoriesIds) {
            $product = Product::create($validated);
            $categories = Category::whereIn('id', $categoriesIds)->get();
            $product->categories()->syncWithoutDetaching($categories);
        });

        return response()->json([
            'message' => 'Product has been stored successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }

    public function show(string $id): ProductResource
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function update(ProductUpdateRequest $productUpdateRequest, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->update($productUpdateRequest->validated());

        return response()->json([
            'message' => 'Product has benn updated successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }

    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Product has been deleted successfully.',
            'code' => 'LabelGroup:OK'
        ], Response::HTTP_OK);
    }
}
