<?php

namespace Domain\Categories\Models;

use Database\Factories\CategoryFactory;
use Domain\Images\Models\Image;
use Domain\Products\Models\Product;
use Domain\Shared\Interfaces\IHasImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model implements IHasImages
{
    use HasFactory;

    const IMAGEABLE_DIRECTORY = '/categories';

    protected $fillable = ['name', 'description'];

    public array $allowedSorts = ['name'];

    // Model functions
    protected static function newFactory(): CategoryFactory
    {
        return new CategoryFactory();
    }

    public function directoryForImages(): string
    {
        return self::IMAGEABLE_DIRECTORY;
    }

    // Resource functions
    public function getProducts(): array
    {
        $data = [];
        foreach ($this->products as $product){
            $data[] = $product->fieldsForRelations();
        }
        return $data;
    }

    public function fields(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'created-at' => $this->created_at->format('d-m-Y'),
            'updated-at' => $this->updated_at->format('d-m-Y'),
        ];
    }

    public function fieldsForRelations(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => route('api.categories.show', $this),
            'is_main' => (bool)$this->pivot->main,
        ];
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
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('main');
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
}
