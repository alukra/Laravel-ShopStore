<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Auth;
use App\Models\Rol;
use App\Models\Modulo_seccion;
use App\Models\Permiso_rol;

class AsignarRolController extends Controller
{
  //Asignar Permisos de un modulo a un rol
  public function getAsignarRol(Request $request){
    $data['id'] = $request->id;
    $data['secciones'] = Modulo_seccion::orderBy('modulo_id', 'ASC')->get();
    $data['permisos'] = Permiso_rol::where('rol_id', '=', $request->id)->pluck('modulo_seccion_id');
    $data['permisos'] = collect($data['permisos'])->all();

    return view('backoffice.rol.asignar_rol')->with($data);
  }

  //Creación y eliminacion de permisos
  public function postAsignarRol(Request $request){
    parse_str($request->permiso, $datos);
    $id = array_shift($datos);
    $permisos = Rol::find($id)->permiso_rol->pluck('modulo_seccion_id');
    $permisos = collect($permisos)->all();
    //Valores Nuevos
    $nuevos = array_diff($datos, $permisos);
    //Valores a eliminar
    $eliminar = array_diff($permisos, $datos);

    foreach ($nuevos as $value) {
      $this->create_permiso_rol($id, $value);
    }
    $this->delete_permiso_rol($id, $eliminar);
    echo true;
  }

  //Creacion de los permisos
  protected function create_permiso_rol($rol, $modulo_seccion){
    return Permiso_rol::create([
        'modulo_seccion_id' => $modulo_seccion,
        'rol_id' => $rol,
        'ultimo_cambio_usuario_id' => Auth::user()->id
    ]);
  }

  // Rol es el id del rol a eliminar, y modulos_seccion es el conjuto de modulos a eliminar
  protected function delete_permiso_rol($rol, $modulos_seccion){
    return Permiso_rol::where('rol_id', $rol)
      ->whereIn('modulo_seccion_id', $modulos_seccion )
      ->delete();
  }
}
