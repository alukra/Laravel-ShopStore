<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo_seccion extends Model
{
  protected $table = "modulo_seccion";

  public function modulo(){
      return $this->belongsTo('App\Models\Modulo');
  }
}
