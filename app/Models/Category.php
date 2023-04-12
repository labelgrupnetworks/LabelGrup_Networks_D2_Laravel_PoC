<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }
}
