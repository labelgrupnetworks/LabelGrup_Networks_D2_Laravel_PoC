<?php

namespace Domain\Images\Models;

use Database\Factories\ImageFactory;
use Domain\Categories\Models\Category;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path', 'url'];
    protected array $allowedSorts = ['name'];

    // Model functions
    protected static function newFactory(): ImageFactory
    {
        return new ImageFactory();
    }

    // Resource functions
    public function fieldsForRelations(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
        ];
    }

    public function fields(): array
    {
        return [
            'name' => $this->name,
            'path' => $this->path,
            'url' => $this->url,
            'created-at' => $this->created_at->format('d-m-Y'),
            'updated-at' => $this->updated_at->format('d-m-Y'),
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

    public function getProducts(): array
    {
        $data = [];
        foreach ($this->products as $product){
            $data[] = $product->fieldsForRelations();
        }
        return $data;
    }

    // Relations
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'imageable');
    }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'imageable');
    }

    // SCOPES
    public function scopeName(Builder $query, $value)
    {
        $query->orWhere('name', 'LIKE', "%$value%");
    }
}
