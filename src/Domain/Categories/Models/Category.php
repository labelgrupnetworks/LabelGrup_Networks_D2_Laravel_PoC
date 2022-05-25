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
        return $this->belongsToMany(Product::class)->withPivot('main');
    }

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
            'created-at' => $this->created_at,
            'updated-at' => $this->updated_at,
        ];
    }

    public function fieldsForRelations(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'is_main' => (bool)$this->pivot->main,
        ];
    }
}
