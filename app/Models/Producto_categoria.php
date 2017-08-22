<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto_categoria extends Model
{
  protected $table = "producto_categoria";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
