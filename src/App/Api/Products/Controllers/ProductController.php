<?php

namespace App\Api\Products\Controllers;

use App\Api\Products\Requests\CreateProductRequest;
use App\Api\Products\Requests\UpdateProductRequest;
use App\Api\Products\Resources\ProductCollection;
use App\Api\Products\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Domain\Products\Actions\CreateProductAction;
use Domain\Products\Actions\UpdateProductAction;
use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;
use Illuminate\Http\JsonResponse;
use Throwable;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        $products = Product::applySorts(request('sort'))
            ->applyFilters()
            ->jsonPaginate();

        return ProductCollection::make($products);
    }

    public function store(CreateProductRequest $request, CreateProductAction $createProductAction): ProductResource
    {
        $data = new ProductData(...$request->validated());
        $product = ($createProductAction)($data);
        return ProductResource::make($product);
    }

    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    public function update(
        UpdateProductRequest  $request,
        Product               $product,
        UpdateProductAction   $updateProductAction
    ): ProductResource
    {
        $data = new ProductData(...$request->validated());
        $product = ($updateProductAction)($data, $product);
        return ProductResource::make($product);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->deleteOrFail();
        return response()->json([
            'message' => 'Product has been deleted',
        ]);
    }
}
