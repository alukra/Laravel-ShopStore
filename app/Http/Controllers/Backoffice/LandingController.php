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

use App\Models\Landing;
use App\Models\Imagen;

class LandingController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Landing page";
    $data['landings'] = Landing::all();
    return view('backoffice.landing.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Crear nueva página de promoción";

    return view('backoffice.landing.create', $data);
  }

  public function store(Request $request){

    $this->validate($request, [
      'nombre' => 'max:32|required',
      'celimg' => 'image|required',
      'tabimg' => 'image|required',
      'comimg' => 'image|required',
      'img2' => 'image|required',
      'txtp1' => 'required',
      'txtp2' => 'required',
      'txts1p1' => 'required',
      'txts2p1' => 'required',
      'txts1p2' => 'required',
      'txts2p2' => 'required'
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $landing = new Landing();
        $landing->nombre = $request->nombre;
        $landing->estado = 0;
        $landing->txtp1 = $request->txtp1;
        $landing->txts1p1 = $request->txts1p1;
        $landing->txts2p1 = $request->txts2p1;
        $landing->txtp2 = $request->txtp2;
        $landing->txts1p2 = $request->txts1p2;
        $landing->txts2p2 = $request->txts2p2;
        $landing->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      $url = 'images/landing/landing'. $landing->id;

      //Nombres para imagenes a subir
      $celimg = $landing->id . time() . 'celimg.' . $request->file('celimg')->getClientOriginalExtension();
      $tabimg = $landing->id . time() . 'tabimg.' . $request->file('tabimg')->getClientOriginalExtension();
      $comimg = $landing->id . time() . 'comimg.' . $request->file('comimg')->getClientOriginalExtension();
      $img2 = $landing->id . time() . 'img2.' . $request->file('img2')->getClientOriginalExtension();

      if ($request->hasFile('celimg')) {
        if ($request->file('celimg')->isValid()) {
          $request->file('celimg')->move( base_path() . '/public/' . $url , $celimg );
          $celimg_f = new Imagen();
          $celimg_f->url = $url . '/' . $celimg;
          $celimg_f->save();

          $landing->celimg_id = $celimg_f->id;
          $landing->save();
        }
      }

      if ($request->hasFile('tabimg')) {
        if ($request->file('tabimg')->isValid()) {
          $request->file('tabimg')->move( base_path() . '/public/' . $url , $tabimg );
          $tabimg_f = new imagen();
          $tabimg_f->url = $url . '/' . $tabimg;
          $tabimg_f->save();

          $landing->tabimg_id = $tabimg_f->id;
          $landing->save();
        }
      }

      if ($request->hasFile('comimg')) {
        if ($request->file('coming')->isValid()) {
          $request->file('coming')->move( base_path() . '/public/' . $url , $coming );
          $coming_f = new imagen();
          $coming_f->url = $url . '/' . $coming;
          $coming_f->save();

          $landing->coming_id = $coming_f->id;
          $landing->save();
        }
      }

      if ($request->hasFile('img2')) {
        if ($request->file('img2')->isValid()) {
          $request->file('img2')->move( base_path() . '/public/' . $url , $img2 );
          $img2 = new imagen();
          $img2->url = $url . '/' . $img2;
          $img2->save();

          $landing->img2_id = $img2->id;
          $landing->save();
        }
      }
     DB::commit();
     return redirect('back/landing');
  }


  public function show($id){

    $landing = Landing::find($id);
    if ( $landing->estado == 1  ) {
      $landing->estado = 0;
    }else{
      $landing->estado =1;
    }
    $landing->save();
    return redirect('back/landing');
  }

  // public function edit($id){
  //   $data['user_perfil'] = Session()->get('perfil');
  //   $data['page_title']  = "Editar landing";
  //   $data['categoria'] =  Landing::find($id);
  //   $data['imagen'] = Imagen::find( $data['categoria']->imagen_id );
  //   if ($data['categoria']  == null) { return redirect('back/category'); } //Verificación para evitar errores
  //   return view('backoffice.categoria.edit', $data);
  // }

}
