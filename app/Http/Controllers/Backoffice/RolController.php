<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Rol;
use App\Models\Modulo_seccion;
use App\Models\Permiso_rol;

class RolController extends Controller{

    public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => 'index']);
    }

    public function index(){
      $data['user_perfil'] = Session()->get('perfil');
      $data['page_title'] = "Roles";

      $data['roles'] = Rol::all();
      return view('backoffice.rol.index')->with($data);
    }

    public function store(Request $request){
      $rol = new Rol();
      $rol->nombre = $request->nombre;
      $rol->descripcion = $request->descripcion;

      if( $rol->save() ){
        $mensaje['estado'] = true;
        $mensaje['rol'] = $rol;
      }else{
        $mensaje['estado'] = false;
      }
      return json_encode($mensaje);
    }

    public function show(request $request){
        $rol = Rol::find($request->input('id'));
        return json_encode($rol);
    }


    public function update(Request $request){
        $rol = Rol::find($request->id);

        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;

        if( $rol->save() ){
          $mensaje['estado'] = true;
          $mensaje['rol'] = $rol;
        }else{
          $mensaje['estado'] = false;
        }
        echo json_encode($mensaje);

    }

}
