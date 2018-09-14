<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
  protected $fillable = [
    'title','sector'
  ];

   public function images(){
     return $this->hasMany('App\Models\Main\Image');
   }
}
