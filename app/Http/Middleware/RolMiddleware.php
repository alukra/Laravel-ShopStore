<?php

namespace App\Http\Middleware;

use Closure;

class RolMiddleware{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next, $tipo){
      //Revision del tipo de usuario
      //Los tipos son:
      // 1: Empleado
      // 2: Usuario
      if ( $request->user()->tipo != $tipo ){
        if ($request->ajax()) {
          return response('Unauthorized.', 401);
        } else {
          return redirect('/login');
        }
      }
      return $next($request);
    }
}
