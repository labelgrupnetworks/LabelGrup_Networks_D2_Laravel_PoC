<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\CategoryMainData;
use Domain\Products\Models\Product;
use Domain\Shared\Services\SaveCategoryMainService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Services\SetFalseMainCategoryService;

class SaveCategoryMainAction
{
    public function __invoke(CategoryMainData $data, Product $product): Model|BelongsToMany|null
    {
        return SaveCategoryMainService::execute($product, $data->main);
    }
}
