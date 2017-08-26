<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle_promocion extends Model
{
  protected $table = "Detalle_promocion";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
