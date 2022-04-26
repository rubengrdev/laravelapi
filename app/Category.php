<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['id', 'name', 'title'];

    function product(){
        return $this->hasMany(Product::class);
    }
}
