<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable=['id', 'name', 'address', 'desc'];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
