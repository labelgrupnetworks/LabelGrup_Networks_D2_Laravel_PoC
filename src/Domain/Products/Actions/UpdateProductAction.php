<?php

namespace Domain\Products\Actions;

use Domain\Images\Models\Image;
use Domain\Products\DTO\ProductData;
use Domain\Products\Models\Product;
use Domain\Shared\Services\SaveAndAttachImagesService;
use Domain\Shared\Services\SaveCategoryMainService;
use Domain\Shared\Services\UpdateProductCategoriesService;
use Illuminate\Support\Facades\Storage;
use Support\Services\ClearNullOnUpdatesService;

class UpdateProductAction
{
    public function __invoke(ProductData $data, Product $product): Product
    {
        $data = ClearNullOnUpdatesService::execute($data);
        $product->fill($data);

        if (isset($data['categories'])){
            UpdateProductCategoriesService::execute($product, $data['categories']);
        }

        if (isset($data['categories'])){
            SaveCategoryMainService::execute($product, $data['category_main']);
        }

        if (isset($data['images'])){
            SaveAndAttachImagesService::execute($product, $data['images']);
        }

        return $product;
    }
}
