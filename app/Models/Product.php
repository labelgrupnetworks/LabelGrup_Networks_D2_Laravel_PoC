<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public const PER_CENT = 100;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps()
            ->withPivot(['is_main']);
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $price) => $price / self::PER_CENT,
            set: fn (float $price) => $price * self::PER_CENT
        );
    }
}
