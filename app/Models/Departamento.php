<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model{

  	protected $table = 'Departamento';

  	public function ciudad()
    {
      return $this->hasMany('App\Models\Ciudad');
    }

	public function pais(){
	return $this->belongsTo("App\Models\Pais");
	}

    protected $hidden = ['deleted_at' ,'updated_at', 'created_at'];

}
