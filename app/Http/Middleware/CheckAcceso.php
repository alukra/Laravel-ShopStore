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
      $urls = DB::select("SELECT Rol.id, Rol.nombre, modulo_seccion_id, Modulo_seccion.nombre, Modulo_seccion.url
        FROM Rol
        INNER JOIN Permiso_rol ON Permiso_rol.rol_id = Rol.id
        INNER JOIN Modulo_seccion ON Permiso_rol.modulo_seccion_id = Modulo_seccion.id 
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
