<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;
use Domain\Shared\Services\SaveAndAttachImagesService;

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

        if (isset($data->images)){
            SaveAndAttachImagesService::execute($product, $data->images);
        }

        return $product;
    }
}
