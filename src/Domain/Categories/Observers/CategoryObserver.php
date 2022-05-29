<?php

namespace Domain\Categories\Observers;

use Domain\Categories\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    public function deleting(Category $category)
    {
        $images = $category->images;
        foreach ($images as $image) {
            Storage::delete($image->path);
            $image->delete();
        }
    }
}
