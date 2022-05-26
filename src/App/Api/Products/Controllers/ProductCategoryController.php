<?php

namespace App\Api\Products\Controllers;

use App\Api\Products\Requests\ProductsCategoryRequest;
use App\Api\Products\Resources\ProductCategoryCollection;
use App\Http\Controllers\Controller;
use Domain\Products\Actions\CreateProductCategoriesAction;
use Domain\Products\Actions\DestroyProductCategoriesAction;
use Domain\Products\Actions\UpdateProductCategoriesAction;
use Domain\Products\DTO\ProductCategoriesData;
use Domain\Products\Models\Product;
use Throwable;

class ProductCategoryController extends Controller
{
    public function index(Product $product): ProductCategoryCollection
    {
        $categories = $product->categories;
        return ProductCategoryCollection::make($categories);
    }

    public function store(Product $product, ProductsCategoryRequest $request, CreateProductCategoriesAction $createProductCategoriesAction): ProductCategoryCollection
    {
        $data = new ProductCategoriesData(...$request->validated());
        $categories = ($createProductCategoriesAction)($data, $product);
        return ProductCategoryCollection::make($categories);
    }

    public function update(Product $product, ProductsCategoryRequest $request, UpdateProductCategoriesAction $updateProductCategoriesAction): ProductCategoryCollection
    {
        $data = new ProductCategoriesData(...$request->validated());
        $categories = ($updateProductCategoriesAction)($data, $product);
        return ProductCategoryCollection::make($categories);
    }

    /**
     * @throws Throwable
     */
    public function destroy(Product $product, ProductsCategoryRequest $request, DestroyProductCategoriesAction $destroyProductCategoriesAction): ProductCategoryCollection
    {
        $data = new ProductCategoriesData(...$request->validated());
        $categories = ($destroyProductCategoriesAction)($data, $product);
        return ProductCategoryCollection::make($categories);
    }
}
