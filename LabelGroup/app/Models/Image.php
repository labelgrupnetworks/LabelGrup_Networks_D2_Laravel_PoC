<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    /**
    * Get the Image record associated with the ImageType.
    */
    public function productCategory()
    {
        return $this->hasMany('App\Models\ImageType');
    }
}
