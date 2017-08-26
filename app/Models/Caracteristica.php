<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caracteristica extends Model
{
  protected $table = "Caracteristica";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
