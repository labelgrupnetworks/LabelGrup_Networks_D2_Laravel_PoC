<?php

namespace App\Observers;

use App\Models\Image;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        if (request()->has('images')) {

            $storagePath = 'public/images';

            foreach (request()->file('images') as $image) {

                $hashedName = $image->hashName();

                $path = $image->storeAs($storagePath, $hashedName);

                Image::create([
                    'url' => $path,
                    'product_id' => $product->id
                ]);
            }
        }
    }
}
