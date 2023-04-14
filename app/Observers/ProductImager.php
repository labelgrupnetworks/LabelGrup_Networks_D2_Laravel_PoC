<?php 
namespace App\Observers;

use App\Models\Image;
use App\Models\Product;

class ProductImager
{
    public function created(Product $product): void
    {
        if (request()->has('images')) {
            $storagePath = 'public/images';

            foreach (request()->file('images') as $img) {
                $path = $img->storeAs($storagePath, $img->hashName());

                Image::create([
                    'file' => $path,
                    'id_product' => $product->id_product
                ]);
            }
        }
    }
}