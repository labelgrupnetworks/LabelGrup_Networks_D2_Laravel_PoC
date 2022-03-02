<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
    * Get the category record associated with the ProductCategory.
    */
    public function productCategory()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }
}
