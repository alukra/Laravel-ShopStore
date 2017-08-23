<?php

namespace App\Http\Controllers\backoffice;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\General;

use App\Models\Ubicacion;

class LocationController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Ubicación";
    $data['ubicaciones'] = Ubicacion::all();
    return view('backoffice.ubicacion.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar ubicación";

    return view('backoffice.ubicacion.create', $data);
  }

  public function store(Request $request){

    $this->validate($request, [
      'nombre' => 'max:64|required',
      'coordx' => 'required',
      'coordy' => 'required',
      'coordx_m' => 'required',
      'coordy_m' => 'required',
      'direccion' => 'required',
      'telefono' => 'required'
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $ubicacion = new Ubicacion();
        $ubicacion->nombre = $request->nombre;
        $ubicacion->coord_x = $request->coordx;
        $ubicacion->coord_y = $request->coordy;
        $ubicacion->latitud_mapa = $request->coordx_m;
        $ubicacion->longitud_mapa = $request->coordy_m;
        $ubicacion->direccion = $request->direccion;
        $ubicacion->telefono = $request->telefono;
        if ($request->has('horario1')) {
          $ubicacion->horario1 = $request->horario1;
        }
        if ($request->has('horario2')) {
          $ubicacion->horario2 = $request->horario2;
        }
        if ($request->has('horario3')) {
          $ubicacion->horario3 = $request->horario3;
        }
        $ubicacion->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }
     DB::commit();
     return redirect('back/location');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar ubicación";
    $data['ubicacion'] =  Ubicacion::find($id);
    if ($data['ubicacion']  == null) { return redirect('back/location'); } //Verificación para evitar errores
    return view('backoffice.ubicacion.edit', $data);
  }

  public function update($id, Request $request){

    $this->validate($request, [
      'nombre' => 'max:64|required',
      'coordx' => 'required',
      'coordy' => 'required',
      'coordx_m' => 'required',
      'coordy_m' => 'required',
      'direccion' => 'required',
      'telefono' => 'required'
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $ubicacion = Ubicacion::find( $id);
        $ubicacion->nombre = $request->nombre;
        $ubicacion->coord_x = $request->coordx;
        $ubicacion->coord_y = $request->coordy;
        $ubicacion->latitud_mapa = $request->coordx_m;
        $ubicacion->longitud_mapa = $request->coordy_m;
        $ubicacion->direccion = $request->direccion;
        $ubicacion->telefono = $request->telefono;
        if ($request->has('horario1')) {
          $ubicacion->horario1 = $request->horario1;
        }
        if ($request->has('horario2')) {
          $ubicacion->horario2 = $request->horario2;
        }
        if ($request->has('horario3')) {
          $ubicacion->horario3 = $request->horario3;
        }
        $ubicacion->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }
     DB::commit();
     return redirect('back/location/' . $id. '/edit');
  }
}
