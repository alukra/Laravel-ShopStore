<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto_imagen extends Model
{
  protected $table = "Producto_imagen";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
