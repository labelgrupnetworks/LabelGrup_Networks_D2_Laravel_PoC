<?php

namespace Domain\Shared\Services;

use Domain\Products\Models\Product;

class UpdateProductCategoriesService
{
    public static function execute(Product $product, array $categoriesFromRequest): void
    {
        $product->categories()->sync($categoriesFromRequest);
        $product->refresh();
    }
}
