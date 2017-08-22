<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckAcceso{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
      $flag = false;
      $urls = DB::select("SELECT rol.id, rol.nombre, modulo_seccion_id, modulo_seccion.nombre, modulo_seccion.url 
        FROM rol 
        INNER JOIN permiso_rol ON permiso_rol.rol_id = rol.id
        INNER JOIN modulo_seccion ON permiso_rol.modulo_seccion_id = modulo_seccion.id 
        WHERE rol_id = ?", [ $request->user()->rol_id ]);
    
      foreach ($urls as $url) {
        if ( str_replace("/index", "", $url->url ) ==  str_replace("/index", "", $request->path() )   ) {
          $flag = true;
        }
      }

      if ($flag == true) {
        return $next($request);
      }else{
        return response('Unauthorized.', 403);
      }
    }
}
