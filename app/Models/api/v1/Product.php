<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function images()
    {
        $this->mophMany(Image::class, 'imageable');
    }
    public function categories()
    {

        return $this->belongsToMany(Category::class, 'product_category')
        ->withPivot('is_main')->withTimestamps();
    }

}
