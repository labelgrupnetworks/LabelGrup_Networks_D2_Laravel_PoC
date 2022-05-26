<?php

namespace Support\Services;

use Domain\Products\Models\Product;

class SetFalseMainCategoryService
{
    public static function execute(Product $product): void
    {
        $product->categories()
            ->withPivot('main')
            ->each(function ($key) {
                $key->pivot->main = false;
                $key->pivot->save();
            });
    }
}
