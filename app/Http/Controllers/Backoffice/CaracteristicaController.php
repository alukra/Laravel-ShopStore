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

use App\Models\Caracteristica;

class CaracteristicaController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Caracteristicas de Productos";
    $data['caracteristicas'] = Caracteristica::all();
    return view('backoffice.caracteristica.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar caracteristica";

    return view('backoffice.caracteristica.create', $data);
  }

  public function store(Request $request){

    $this->validate($request, [
      'nombre' => 'max:32|required',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $caracteristica = new Caracteristica();
        $caracteristica->nombre = $request->nombre;
        if ($request->has('principal') ) {
          $caracteristica->principal = 1;
        }else {
          $caracteristica->principal = 0;
        }
        $caracteristica->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }
     DB::commit();
     return redirect('back/detail');
  }

  public function show($id){

    $caracteristica = Caracteristica::find($id);
    if ( $caracteristica->estado == 1  ) {
      $caracteristica->estado = 0;
    }else{
      $caracteristica->estado =1;
    }
    $caracteristica->save();
    return redirect('back/detail');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar Caracteristica";
    $data['caracteristica'] =  Caracteristica::find($id);
    if ($data['caracteristica']  == null) { return redirect('back/detail'); } //Verificación para evitar errores
    return view('backoffice.caracteristica.edit', $data);
  }


  public function update($id, Request $request){    //Tablas a actualizar

    $caracteristica = Caracteristica::find($id);
    $this->validate($request, [
      'nombre' => 'max:32|required',
      'orden' => 'required'
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $caracteristica->nombre = $request->nombre;
        if ($request->has('principal') ) {
          $caracteristica->principal = 1;
        }else {
          $caracteristica->principal = 0;
        }
        $caracteristica->orden = $request->orden;
        $caracteristica->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }
     DB::commit();
     return redirect('back/detail/'. $id . "/edit");
  }

  public function delete($id, Request $request)
  {
       $article = Article::findOrFail($id);
       $article->delete();

       return redirect('back/detail');
   }

}
