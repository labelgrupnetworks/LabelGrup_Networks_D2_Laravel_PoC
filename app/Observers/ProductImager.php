<?php 
namespace App\Observers;

use App\Http\Controllers\API\ImageController;
use App\Models\Image;
use App\Models\Product;

class ProductImager
{

    public function created(Product $product): void
    {
        $this->createFiles($product);
    }

    public function updated(Product $product): void
    {
        Image::where('id_product', '=', $product->id_product)->delete();

        $this->createFiles($product);
    }

    public function createFiles(Product $product) {
        (new ImageController)->store(request(), $product);
    }
}