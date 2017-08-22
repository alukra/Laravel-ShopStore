<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto_caracteristica extends Model
{
  protected $table = "producto_caracteristica";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
