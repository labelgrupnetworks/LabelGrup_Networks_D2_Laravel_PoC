<?php

namespace Domain\Shared\Services;

use Domain\Products\Models\Product;
use Domain\Shared\Interfaces\IData;

class CreateProductCategoriesService
{
    public static function execute(array $categoriesFromRequest, Product $product): void
    {
        $currentCategoriesIds = $product->categories->pluck('id')->toArray();

        foreach ($categoriesFromRequest as $key => $value) {
            if (in_array($value, $currentCategoriesIds)){
                unset($categoriesFromRequest[$key]);
            }
        }

        if (!empty($categoriesFromRequest)){
            $product->categories()->attach($categoriesFromRequest);
            $product->refresh();
        }
    }
}
