<?php

namespace Domain\Products\Observers;

use Domain\Images\Models\Image;
use Domain\Products\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function deleting(Product $product)
    {
        $images = $product->images;
        foreach ($images as $image) {
            Storage::delete($image->path);
            $image->delete();
        }
    }
}
