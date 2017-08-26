<?php

namespace App\Services;

use Auth;
use App\User;
use App\Models\Modulo;
use App\Models\Modulo_seccion;
use Illuminate\Support\Facades\URL;

class Menu {


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
      $modulos = Modulo::select('Modulo.id', 'Modulo.nombre', 'Modulo.icono')
                ->join('Modulo_seccion', 'Modulo.id', '=', 'modulo_id')
                ->join('Permiso_rol', 'Modulo_seccion.id', '=', 'Permiso_rol.modulo_seccion_id')
                ->where('rol_id', '=', Auth::user()->rol_id)
                ->groupBy('Modulo.id', 'Modulo.nombre', 'Modulo.icono')
                ->orderBy('Modulo.orden', 'asc')
                ->get();

      $submodulos = Modulo_seccion::select('Modulo_seccion.nombre', 'Modulo_seccion.url', 'Modulo_seccion.icono', 'modulo_id')
                ->join('Permiso_rol', 'Modulo_seccion.id', '=', 'Permiso_rol.modulo_seccion_id')
                ->where('rol_id', '=', Auth::user()->rol_id)
                ->orderBy('orden', 'asc')
                ->get();

      //---------------------------
      //inicialización
      //variable activo la cual usaré para verificar si esta o no
      $activo = "";
      //Url Actual
      $url_activa = str_replace("/valdezmobile/public/", "", $_SERVER['REQUEST_URI']);
      //Verifico el módulo activo, en caso de ser el dashboard se quedará en 0 sino dirá el id del módulo
      //Además especifica el id de la sección a la cual pertenece
      $modulo_activo = 0;
      $submodulo_activo = 0;
      //Recorre las secciones para verificar en que lugar esta apuntando
      foreach( $submodulos as $submodulo){
        if ( str_replace("/index", "", $submodulo->url ) ==  str_replace("/index", "", $url_activa )  ) {
          $modulo_activo = $submodulo->modulo_id;
          $submodulo_activo = $submodulo->id;
        }
      }

      //si el dashboard es la url activa colocarlo e inicializarlo activo
      if ($url_activa == "dashboard" || $url_activa = "" || $url_activa== "back" || $url_activa == "back/dashboard" ) { $activo = "active"; }
      if ( Auth::user()->tipo == 1 ) {
        $url_dash = "/back/dashboard";
      }else{
        $url_dash = "/";
      }
      $menu = "<li class='". $activo . "'><a href='" . url($url_dash) . "'><i class='fa fa-home'></i> <span> Inicio </span></a></li>";
      foreach ($modulos as $modulo) {

        if ($modulo->id == $modulo_activo) { $activo = "active"; $collapse = ""; }else{ $activo = ""; $collapse = "collapse";} //verificación del modulo con url activa

        //Menu del afiliado
        $menu .= "<li class='" . $activo .  "'>
          <a href='#'>
            <i class='fa ". $modulo->icono ."'></i>
            <span class='nav-label'>" . $modulo->nombre . "</span>
            <span class='fa arrow'></span>
          </a>
          <ul class='nav nav-second-level " . $collapse ."'>";

        //Generación de las secciones
        $submenu = "";
        foreach( $submodulos as $submodulo){
          if( $modulo->id == $submodulo->modulo_id ){
            if ( $submodulo_activo == $submodulo->id ){ $activo = "active"; }else{ $activo = ""; }
            $submenu .= "<li class='". $activo ."'>
                <a href='" . url($submodulo->url) . "'>
                <i class='fa " . $submodulo->icono . "'></i>
                <span>" .$submodulo->nombre . "</span>
                </a>
              </li>";
          }
        }
        $menu .= $submenu;
        $menu .= "</ul></li>";
      }

      return $menu;
    }

}
