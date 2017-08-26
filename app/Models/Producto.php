<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
  protected $table = "Producto";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
