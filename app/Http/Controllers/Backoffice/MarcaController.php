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

use App\Models\Marca;
use App\Models\Imagen;

class MarcaController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Marca";
    $data['marcas'] = Marca::select('Marca.*', 'Imagen.url')
              ->join('Imagen', 'Imagen.id', '=', 'imagen_id')->get();
    return view('backoffice.marca.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar marca";

    return view('backoffice.marca.create', $data);
  }

  public function store(Request $request){

    $this->validate($request, [
      'nombre' => 'max:64|required',
      'imagen' => 'image|required',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->imagen_id = 1;
        $marca->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      $url = 'images/marca/marca'. $marca->id;
      $imageName = $marca->id . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
      if ($request->hasFile('imagen')) {
        if ($request->file('imagen')->isValid()) {
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $marca->imagen_id = $imagen->id;
          $marca->save();
        }
      }
     DB::commit();
     return redirect('back/brand');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar Marca";
    $data['marca'] =  Marca::find($id);
    $data['imagen'] = Imagen::find( $data['marca']->imagen_id );
    if ($data['marca']  == null) { return redirect('back/brand'); } //Verificación para evitar errores
    return view('backoffice.marca.edit', $data);
  }

  public function update($id, Request $request){    //Tablas a actualizar

    $marca = Marca::find($id);
    $this->validate($request, [
      'nombre' => 'max:32|required|regex:/^[A-Za-z ñáéíóú\s]+$/',
      'imagen' => 'image',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado
        $marca->nombre = $request->nombre;
        $marca->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      if ($request->hasFile('imagen')) {
        if ($request->file('imagen')->isValid()) {
          $url = 'images/marca/marca'. $marca->id;
          $imageName = $marca->id . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $marca->imagen_id = $imagen->id;
          $marca->save();
        }
      }
     DB::commit();
     return redirect('back/brand/'. $id . "/edit");
  }

}
