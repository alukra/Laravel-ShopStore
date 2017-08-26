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

use App\Models\Categoria;
use App\Models\Imagen;

class CategoriaController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Categorias de Productos";
    $data['categorias'] = Categoria::select('Categoria.*', 'Imagen.url')
              ->join('Imagen', 'Imagen.id', '=', 'imagen_id')->get();
    return view('backoffice.categoria.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar categoria de producto";

    return view('backoffice.categoria.create', $data);
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
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->imagen_id = 1;
        $categoria->estado = 1;
        $categoria->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      $url = 'images/categoria/categoria'. $categoria->id;
      $imageName = $categoria->id . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
      if ($request->hasFile('imagen')) {
        if ($request->file('imagen')->isValid()) {
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $categoria->imagen_id = $imagen->id;
          $categoria->save();
        }
      }
     DB::commit();
     return redirect('back/category');
  }

  public function show($id){

    $categoria = Categoria::find($id);
    if ( $categoria->estado == 1  ) {
      $categoria->estado = 0;
    }else{
      $categoria->estado =1;
    }
    $categoria->save();
    return redirect('back/category');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar Categoria";
    $data['categoria'] =  Categoria::find($id);
    $data['imagen'] = Imagen::find( $data['categoria']->imagen_id );
    if ($data['categoria']  == null) { return redirect('back/category'); } //Verificación para evitar errores
    return view('backoffice.categoria.edit', $data);
  }

  public function update($id, Request $request){    //Tablas a actualizar

    $categoria = Categoria::find($id);
    $this->validate($request, [
      'nombre' => 'max:32|required|regex:/^[A-Za-z ñáéíóú\s]+$/',
      'imagen' => 'image',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado
        $categoria->nombre = $request->nombre;
        $categoria->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      if ($request->hasFile('imagen')) {
        if ($request->file('imagen')->isValid()) {
          $url = 'images/categoria/categoria'. $categoria->id;
          $imageName = $categoria->id . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $categoria->imagen_id = $imagen->id;
          $categoria->save();
        }
      }
     DB::commit();
     return redirect('back/category/'. $id . "/edit");
  }

}
