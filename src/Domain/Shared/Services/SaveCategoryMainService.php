<?php

namespace Domain\Shared\Services;

use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Services\SetFalseMainCategoryService;

class SaveCategoryMainService
{
    public static function execute(Product $product, int $mainCategoryFromRequest): Model|BelongsToMany|null
    {
        $categoryToSetMain = $product->categories()->withPivot('main')
            ->where('product_id', $product->id)
            ->where('category_id', $mainCategoryFromRequest)
            ->firstOrFail();

        SetFalseMainCategoryService::execute($product);

        $categoryToSetMain->pivot->main = true;
        $categoryToSetMain->pivot->save();

        return $categoryToSetMain;
    }
}
