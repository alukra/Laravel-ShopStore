<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suscripcion extends Model
{
  protected $table = "Suscripcion";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
