<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso_rol extends Model
{
  protected $table = 'permiso_rol';

  protected $fillable = [
    'modulo_seccion_id',
    'rol_id',
  ];

  public function modulo_seccion(){
      return $this->belongsTo('App\Models\Modulo_seccion');
  }

  public function rol(){
      return $this->belongsTo('App\Models\Rol');
  }
}
