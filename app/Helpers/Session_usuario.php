<?php

	namespace App\Helpers;

	use Session;
	use Auth;
  use Carbon\Carbon;

  //use App\Models\Sesion_usuario;
	use App\Models\Empleado;
  use App\Models\Afiliado;


	class Session_usuario{

		/**
     * Extrae el perfil del usuario según su tipo
     * busca en su tabla y los guarda en la variable de sesion de perfil
     * @return [type] [description]
     */
    public static function session_usuario(){
      if ( Auth::user()->tipo == 1) {
        $data = Empleado::select('empleado.id', 'fecha_nacimiento', 'genero', 'url')
                  ->join('imagen', 'empleado.imagen_id','=', 'imagen.id')
                  ->where('empleado.usuario_id', '=', Auth::user()->id )
                  ->first();
      }elseif( Auth::user()->tipo == 2 ){
        $data = Afiliado::select( 'afiliado.id', 'afiliado.nombre', 'apellido', 'notificaciones_activas', 'estado_registro',
                    'url','afiliado.codigo', 'idioma.nombre as idioma', 'idioma.codigo as idioma_abr' , 'fase'
                  )
                  ->join('imagen_usuario', 'imagen_usuario.usuario_id', '=', 'afiliado.usuario_id')
                  ->join('idioma', 'afiliado.idioma_id', '=', 'idioma.id')
                  ->where('afiliado.usuario_id', '=', Auth::user()->id)
                  ->where('imagen_usuario.estado', '=', 1)
                  ->first();
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
