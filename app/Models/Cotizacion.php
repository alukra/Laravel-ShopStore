<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotizacion extends Model
{
  protected $table = "Cotizacion";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
