<?php

namespace Domain\Categories\Actions;

use Domain\Categories\DTO\CategoryData;
use Domain\Categories\Models\Category;

class CreateCategoryAction
{
    public function __invoke(CategoryData $data): Category
    {
        return Category::create([
            'name' => $data->name,
            'description' => $data->description,
        ]);
    }
}
