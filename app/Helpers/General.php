<?php

  namespace App\Helpers;

  use DB;
  use DateTime;


  use App\User;


  /**
   *
   * Helper de funciones Generales del sistema de acciones recurrentes
   */
  class General {


    /**
     * Creado de mensajes (pendiente de modificar)
     * @param  Array $mensajes    Conjuto de mensajes que se enviarán
     * @param  string $tipo       Tipo de mensaje que se enviará
     * @param  string $redireccion Lugar donde se realizará la redireccion
     * @return Redireccion
     *
    */
    public static function mensajes($mensajes, $tipo = 'success', $redireccion = ""){
	    $redirectPath = $redirectPath == null ? back() : redirect( $redirectPath );
	     return $redirectPath->with([
	         'message'   =>  $message,
	         'status'    =>  $status,
	    ]);
    }

    /**
     * Generador de mascará de fecha (En caso de no desear usar Carbon)
     * @param  Datetime $date    Fecha a convertir
     * @param  string   $mascara Mascara para convertir fecha, por defecto es d/m/Y (ver php docs)
     * @return Datetime          Fecha convertida
     */
    public static function formatoFecha( $date, $mascara = "d-m-Y"){
        $date = new DateTime($date);
        $Newdate = date_format( $date , $mascara);
        return $Newdate;
    }

    /**
     * Estados civiles
     * @return Array $estado estados civiles
     */
    public static function getEstadoCivil(){
      $estado = array(
        array("id" => "X", "nombre" => trans('general.sin_definir') ),
        array("id" => "S", "nombre" => trans('general.soltero')),
        array("id" => "C", "nombre" => trans('general.casado')),
        array("id" => "U", "nombre" => trans('general.union_libre')),
        array("id" => "V", "nombre" => trans('general.viudo')),
        array("id" => "D", "nombre" => trans('general.divorciado'))
      );
      return $estado;
    }

    public static function getGenero(){
      $genero = array(
        array("value" => "M", "text" => trans('general.masculino') ),
        array("value" => "F", "text" => trans('general.femenino') )
      );
      return $genero;
    }

    public static function generar_token( $id ){
      $time = time();
      $token = sha1( sprintf("%'.07d", $id ) . str_random(20) . $time );
      return $token;
    }

  }


?>
