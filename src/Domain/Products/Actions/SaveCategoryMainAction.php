<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\CategoryMainData;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Services\SetFalseMainCategoryService;

class SaveCategoryMainAction
{
    public function __invoke(CategoryMainData $data, Product $product): Model|BelongsToMany|null
    {
        $mainCategory = $product->categories()->withPivot('main')
            ->where('product_id', $product->id)
            ->where('category_id', $data->main)
            ->firstOrFail();

        SetFalseMainCategoryService::execute($product);

        $mainCategory->pivot->main = true;
        $mainCategory->pivot->save();

        return $mainCategory;
    }
}
