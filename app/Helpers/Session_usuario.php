<?php

	namespace App\Helpers;

	use Session;
	use Auth;
  use Carbon\Carbon;

  //use App\Models\Sesion_usuario;
	use App\Models\Empleado;


	class Session_usuario{

		/**
     * Extrae el perfil del usuario según su tipo
     * busca en su tabla y los guarda en la variable de sesion de perfil
     * @return [type] [description]
     */
    public static function session_usuario(){
      if ( Auth::user()->tipo == 1) {
        $data = Empleado::select('Empleado.id', 'fecha_nacimiento', 'genero', 'url')
                  ->join('Imagen', 'Empleado.imagen_id','=', 'Imagen.id')
                  ->where('Empleado.usuario_id', '=', Auth::user()->id )
                  ->first();
      }elseif( Auth::user()->tipo == 2 ){

      }
      Session::put('perfil', $data);
    }

    public static function redireccion_usuario(){
      if ( Auth::user()->tipo == 1 ) {
        return redirect('back/dashboard');
      }elseif( Auth::user()->tipo == 2 ){
        return redirect('/');
      }
    }

	}

?>
