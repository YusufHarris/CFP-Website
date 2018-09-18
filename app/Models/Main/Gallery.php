<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
  protected $fillable = [
    'title','sector'
  ];

   public function photos(){
     return $this->hasMany('App\Models\Main\Photo');
   }
}
