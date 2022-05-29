<?php

namespace App\Api\Products\Controllers;

use App\Api\Categories\Resources\CategoryResource;
use App\Api\Products\Requests\CategoryMainRequest;
use App\Http\Controllers\Controller;
use Domain\Products\Actions\SaveCategoryMainAction;
use Domain\Products\DTO\CategoryMainData;
use Domain\Products\Models\Product;

class CategoryMainController extends Controller
{
    public function __invoke(
        Product $product,
        CategoryMainRequest $request,
        SaveCategoryMainAction $saveCategoryMainAction
    ): CategoryResource
    {
        $data = new CategoryMainData(...$request->validated());
        $mainCategory = ($saveCategoryMainAction)($data, $product);

        return CategoryResource::make($mainCategory);

    }
}
