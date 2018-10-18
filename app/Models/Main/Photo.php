<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'filename', 'filename2', 'directory', 'description', 'gallery_id'
  ];

  public function gallery(){
    return $this->belongsTo('App\Models\Main\Gallery', 'gallery_id');
  }
}
