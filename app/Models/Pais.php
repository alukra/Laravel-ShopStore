<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model
{
  protected $table = "pais";

  public function departamento(){
    return $this->hasMany('App\Models\Departamento');
  }

  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $hidden = ['deleted_at' ,'updated_at', 'created_at'];
}
