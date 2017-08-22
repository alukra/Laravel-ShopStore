<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
  protected $table = 'municipio';

  public function departamento(){
    return $this->belongsTo("App\Models\Departamento","departamento_id");
  }

  protected $hidden = ['deleted_at' ,'updated_at', 'created_at'];
  use SoftDeletes;
  protected $dates = ['deleted_at'];
}
