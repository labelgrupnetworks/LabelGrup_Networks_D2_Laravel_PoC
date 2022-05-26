<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductCategoriesData;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CreateProductCategoriesAction
{
    public function __invoke(ProductCategoriesData $data, Product $product): Collection
    {
        $currentCategoriesIds = $product->categories->pluck('id')->toArray();
        $categoriesIds = explode(',', $data->categories);

        foreach ($categoriesIds as $key => $value) {
            if (in_array($value, $currentCategoriesIds)){
                unset($categoriesIds[$key]);
            }
        }

        if (!empty($categoriesIds)){
            $product->categories()->attach($categoriesIds);
            $product->refresh();
        }

        return $product->categories;
    }
}
