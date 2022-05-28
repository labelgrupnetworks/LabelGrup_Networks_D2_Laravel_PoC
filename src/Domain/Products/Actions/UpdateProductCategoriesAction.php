<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductCategoriesData;
use Domain\Products\Models\Product;
use Domain\Shared\Services\UpdateProductCategoriesService;
use Illuminate\Database\Eloquent\Collection;

class UpdateProductCategoriesAction
{
    public function __invoke(ProductCategoriesData $data, Product $product): Collection
    {
        UpdateProductCategoriesService::execute($product, $data->categories);
        return $product->categories;
    }
}
