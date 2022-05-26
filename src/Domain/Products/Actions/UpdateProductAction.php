<?php

namespace Domain\Products\Actions;

use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;
use Support\Services\ClearNullOnUpdatesService;

class UpdateProductAction
{
    public function __invoke(ProductData $data, Product $product): Product
    {
        $data = ClearNullOnUpdatesService::execute($data);
        $product->fill($data);

        return $product;
    }
}
