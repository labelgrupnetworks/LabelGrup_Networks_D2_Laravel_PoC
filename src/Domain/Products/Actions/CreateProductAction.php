<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;
use Domain\Shared\Services\CreateProductCategoriesService;
use Domain\Shared\Services\SaveAndAttachImagesService;
use Domain\Shared\Services\SaveCategoryMainService;

class CreateProductAction
{
    public function __invoke(ProductData $data): Product
    {
        $product = Product::create([
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price,
            'stock' => $data->stock,
        ]);

        if ($data->categories){
            CreateProductCategoriesService::execute($data->categories, $product);
        }

        if ($data->category_main){
            SaveCategoryMainService::execute($product, $data->category_main);
        }

        if ($data->images){
            SaveAndAttachImagesService::execute($product, $data->images);
        }

        return $product;
    }
}
