<?php

namespace Domain\Categories\Actions;

use Domain\Categories\DTO\CategoryData;
use Domain\Categories\Models\Category;
use Domain\Shared\Services\SaveAndAttachImagesService;
use Support\Services\ClearNullOnUpdatesService;

class UpdateCategoryAction
{
    public function __invoke(CategoryData $data, Category $category): Category
    {
        $data = ClearNullOnUpdatesService::execute($data);
        $category->fill($data);

        if (isset($data['images'])){
            SaveAndAttachImagesService::execute($category, $data['images']);
        }

        return $category;
    }
}
