<?php

namespace Domain\Categories\Actions;

use Domain\Categories\DTO\CategoryData;
use Domain\Categories\Models\Category;
use Domain\Shared\Services\SaveAndAttachImagesService;

class CreateCategoryAction
{
    public function __invoke(CategoryData $data): Category
    {
        $category = Category::create([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        if (isset($data->images)){
            SaveAndAttachImagesService::execute($category, $data->images);
        }

        return $category;
    }
}
