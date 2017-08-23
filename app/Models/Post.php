<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  protected $table = "post";

  use SoftDeletes;
  protected $dates = ['deleted_at'];
}