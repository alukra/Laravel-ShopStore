<?php

namespace App\Http\Controllers\Backoffice;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\General;

use App\Models\Tipo;
use App\Models\Imagen;

class TipoController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Tipos de Productos";
    $data['tipos'] = Tipo::select('Tipo.*', 'Imagen.url')
              ->join('Imagen', 'Imagen.id', '=', 'imagen_id')->get();
    return view('backoffice.tipo.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar Tipo de producto";

    return view('backoffice.tipo.create', $data);
  }

  public function store(Request $request){

    $this->validate($request, [
      'nombre' => 'max:32|required|regex:/^[A-Za-z ñáéíóú\s]+$/',
      'imagen' => 'image|required',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $tipo = new Tipo();
        $tipo->nombre = $request->nombre;
        $tipo->imagen_id = 1;
        $tipo->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      $url = 'images/tipo/tipo'. $tipo->id;
      $imageName = $tipo->id . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
      if ($request->hasFile('imagen')) {
        if ($request->file('imagen')->isValid()) {
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $tipo->imagen_id = $imagen->id;
          $tipo->save();
        }
      }
     DB::commit();
     return redirect('back/type-product');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar Tipo";
    $data['tipo'] =  Tipo::find($id);
    $data['imagen'] = Imagen::find( $data['tipo']->imagen_id );
    if ($data['tipo']  == null) { return redirect('back/type-product'); } //Verificación para evitar errores
    return view('backoffice.tipo.edit', $data);
  }

  public function update($id, Request $request){    //Tablas a actualizar

    $tipo = Tipo::find($id);
    $this->validate($request, [
      'nombre' => 'max:32|required|regex:/^[A-Za-z ñáéíóú\s]+$/',
      'imagen' => 'image',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado
        $tipo->nombre = $request->nombre;
        $tipo->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      if ($request->hasFile('imagen')) {
        if ($request->file('imagen')->isValid()) {
          $url = 'images/tipo/tipo'. $tipo->id;
          $imageName = $tipo->id . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $tipo->imagen_id = $imagen->id;
          $tipo->save();
        }
      }
     DB::commit();
     return redirect('back/type-product/'. $id . "/edit");
  }

}
