<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductCategoriesData;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class DestroyProductCategoriesAction
{
    public function __invoke(ProductCategoriesData $data, Product $product): Collection
    {
        $categoriesFromRequest = $data->categories;
        $product->categories()->detach($categoriesFromRequest);
        $product->refresh();

        return $product->categories;
    }
}
