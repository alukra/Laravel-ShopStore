<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
  protected $table = "cliente";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
