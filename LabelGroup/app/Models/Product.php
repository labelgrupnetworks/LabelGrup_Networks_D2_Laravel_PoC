<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
    * Get the product record associated with the ProductCategory.
    */
    public function productCategory()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }
}
