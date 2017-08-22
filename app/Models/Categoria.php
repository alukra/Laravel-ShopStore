<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
  protected $table = "categoria";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
