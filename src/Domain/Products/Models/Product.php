<?php

namespace Domain\Products\Models;

use Database\Factories\ProductFactory;
use Domain\Categories\Models\Category;
use Domain\Images\Models\Image;
use Domain\Shared\Interfaces\IHasImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model implements IHasImages
{
    use HasFactory;

    const IMAGEABLE_DIRECTORY = '/products';

    protected $fillable = ['name', 'description', 'price', 'stock'];

    public array $allowedSorts = ['name', 'price', 'stock'];

    // Model functions
    protected static function newFactory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function directoryForImages(): string
    {
        return self::IMAGEABLE_DIRECTORY;
    }

    // Resource functions
    public function fields(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'created-at' => $this->created_at->format('d-m-Y'),
            'updated-at' => $this->updated_at->format('d-m-Y'),
        ];
    }

    public function fieldsForRelations(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => route('api.products.show', $this),
        ];
    }

    public function getCategories(): array
    {
        $data = [];
        foreach ($this->categories as $category){
            $data[] = $category->fieldsForRelations();
        }
        return $data;
    }

    public function getImages()
    {
        $data = [];
        foreach ($this->images as $image){
            $data[] = $image->fieldsForRelations();
        }
        return $data;
    }

    // Relations
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withPivot('main');
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class,'imageable');
    }

    // SCOPES
    public function scopeName(Builder $query, $value)
    {
        $query->orWhere('name', 'LIKE', "%$value%");
    }

    public function scopePrice(Builder $query, $value)
    {
        $query->orWhere('price', 'LIKE', "%$value%");
    }
}
