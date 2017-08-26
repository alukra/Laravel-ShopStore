<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
  protected $table = "Tipo";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
