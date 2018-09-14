<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'occupation', 'introduction','avatar'
  ];
}
