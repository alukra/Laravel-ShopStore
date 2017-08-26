<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle_cotizacion extends Model
{
  protected $table = "Detalle_cotizacion";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
