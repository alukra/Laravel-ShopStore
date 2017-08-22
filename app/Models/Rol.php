<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
  protected $table = "rol";

  public function permiso_rol(){
     return $this->hasMany('App\Models\Permiso_rol');
  }

  protected $hidden = ['updated_at', 'created_at'];

}
