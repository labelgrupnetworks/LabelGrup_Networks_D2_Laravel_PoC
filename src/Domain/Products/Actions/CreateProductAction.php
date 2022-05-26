<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;

class CreateProductAction
{
    public function __invoke(ProductData $data)
    {
        return Product::create([
            'name' => $data->name,
            'description' => $data->description,
            'price' => $data->price,
            'stock' => $data->stock,
        ]);
    }
}
