<?php

namespace Domain\Products\Observers;

use Domain\Images\Models\Image;
use Domain\Products\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function created(Product $product)
    {

    }

    public function updated(Product $product)
    {
        //
    }

    public function deleted(Product $product)
    {
        //
    }

    public function restored(Product $product)
    {
        //
    }

    public function forceDeleted(Product $product)
    {
        //
    }
}
