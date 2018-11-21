<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class donor extends Model
{
  protected $fillable = [
      'title', 'logo', 'current'
  ];
}
