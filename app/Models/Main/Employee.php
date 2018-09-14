<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'title', 'description','avatar'
  ];
}
