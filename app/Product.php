<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      //
      protected $fillable = ['id','title','description','price','company_id', 'category_id'];

      public function company(){
          return $this->belongsTo(Company::class);
      }
}
