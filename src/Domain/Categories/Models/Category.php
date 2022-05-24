<?php

namespace Domain\Categories\Models;

use Database\Factories\CategoryFactory;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected static function newFactory(): CategoryFactory
    {
        return new CategoryFactory();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
