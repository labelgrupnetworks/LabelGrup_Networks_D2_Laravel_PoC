<?php

namespace Domain\Categories\Models;

use Database\Factories\CategoryFactory;
use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public array $allowedSorts = ['name'];

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
            'created-at' => $this->created_at->format('d-m-Y'),
            'updated-at' => $this->updated_at->format('d-m-Y'),
        ];
    }

    public function fieldsForRelations(): array
    {
        return [
            'name' => $this->name,
            'location' => route('categories.show', $this),
            'is_main' => (bool)$this->pivot->main,
        ];
    }

    public function scopeName(Builder $query, $value)
    {
        $query->orWhere('name', 'LIKE', "%$value%");
    }
}
