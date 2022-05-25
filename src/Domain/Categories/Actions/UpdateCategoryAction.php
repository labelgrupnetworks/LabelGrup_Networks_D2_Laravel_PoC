<?php

namespace Domain\Categories\Actions;

use Domain\Categories\DTO\CategoryData;
use Domain\Categories\Models\Category;
use Support\Services\ClearNullOnUpdatesService;

class UpdateCategoryAction
{
    public function __invoke(CategoryData $data, Category $category): Category
    {
        $data = ClearNullOnUpdatesService::execute($data);
        $category->fill($data);

        return $category;
    }
}
