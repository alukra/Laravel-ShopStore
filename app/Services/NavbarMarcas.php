<?php

namespace App\Services;

use Auth;
use App\User;
use App\Models\Marca;

class NavbarMarcas {


    /*
     * Crear el menu
     *
     *
     *
     * @return object
     */
    public static function create(){
      $perfil   = Session()->get('perfil');

      //Consultas del menu
      $marcas = Marca::select('marca.*', 'imagen.url')
                ->join('imagen', 'imagen.id', '=', 'imagen_id')->get();

      $menu = '<div class="col-md-8 col-sm-6">
                <h3 class="mega-menu-heading"><i class="fa fa-shopping-bag fa-fw"></i> Marcas </h3>
                  <ul class="list-unstyled style-list" style="-webkit-column-count: 3;  -moz-column-count: 3;  column-count: 3;">';

      foreach ($marcas as $key => $marca) {
        $menu .= '<li>
            <a href="'. url('products/0/0/' . $marca->id) .'">
              <img style="height:25px; width: auto;" src="'. asset($marca->url ) .'"> ' . $marca->nombre .'
            </a>
          </li>';
      }

      $menu .= '</ul></div>';

      return $menu;
    }

}
