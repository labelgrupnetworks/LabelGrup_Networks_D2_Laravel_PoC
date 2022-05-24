<?php

namespace Domain\Products\Models;

use Database\Factories\ProductFactory;
use Domain\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected static function newFactory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withPivot('main');
    }
}
