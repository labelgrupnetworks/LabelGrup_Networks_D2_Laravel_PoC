<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductCategoriesData;
use Domain\Products\Models\Product;
use Domain\Shared\Services\CreateProductCategoriesService;
use Illuminate\Database\Eloquent\Collection;

class CreateProductCategoriesAction
{
    public function __invoke(ProductCategoriesData $data, Product $product): Collection
    {
        if ($data->categories){
            CreateProductCategoriesService::execute($data->categories, $product);
        }

        return $product->categories;
    }
}
