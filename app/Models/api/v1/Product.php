<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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

    // public function mainCategory(){

    //     return $this->hasOne(Category::class, 'product_category')->where('is_main',1);
    // }
}
