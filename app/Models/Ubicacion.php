<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
  protected $table = "ubicacion";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}