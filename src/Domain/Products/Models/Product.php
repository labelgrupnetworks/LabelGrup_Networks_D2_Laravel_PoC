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

    public function fields(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'created-at' => $this->created_at,
            'updated-at' => $this->updated_at,
        ];
    }

    public function fieldsForRelations(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => route('products.show', $this),
        ];
    }

    public function getCategories(): array
    {
        $data = [];
        foreach ($this->categories as $key => $category){
            $data[] = $category->fieldsForRelations();
        }
        return $data;
    }

    protected static function newFactory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withPivot('main');
    }
}
