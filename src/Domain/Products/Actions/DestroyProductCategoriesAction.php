<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductCategoriesData;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class DestroyProductCategoriesAction
{
    public function __invoke(ProductCategoriesData $data, Product $product): Collection
    {
        $categoriesIds = explode(',', $data->categories);
        $product->categories()->detach($categoriesIds);
        $product->refresh();

        return $product->categories;
    }
}
