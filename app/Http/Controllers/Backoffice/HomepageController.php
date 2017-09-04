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

use App\Models\Homepage;
use App\Models\Imagen;

class HomepageController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Homepage";
    $data['homes'] = Homepage::all();
    return view('backoffice.homepage.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Crear nueva version de homepage";

    return view('backoffice.homepage.create', $data);
  }

  public function store(Request $request){

    $this->validate($request, [
      'slide1_img' => 'image|required',
      'slide2_img' => 'image|required',
      'slide3_img' => 'image|required',
      'banner_img' => 'image|required',
      'txt_ts1' => 'required',
      'txt_ss1' => 'required',
      'txt_ts2' => 'required',
      'txt_ss2' => 'required',
      'txt_ts3' => 'required',
      'txt_ss3' => 'required',
      'txt_bt' => 'required',
      'txt_bs' => 'required',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $homepage = new Homepage();
        $homepage->estado = 0;
        $homepage->txt_ts1 = $request->txt_ts1;
        $homepage->txt_ss1 = $request->txt_ss1;
        $homepage->txt_ts2 = $request->txt_ts2;
        $homepage->txt_ss2 = $request->txt_ss2;
        $homepage->txt_ts3 = $request->txt_ts3;
        $homepage->txt_ss3 = $request->txt_ss3;
        $homepage->txt_bt = $request->txt_bt;
        $homepage->txt_bs = $request->txt_bs;
        $homepage->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

      $url = 'images/homepage/homepage'. $homepage->id;

      //Nombres para imagenes a subir
      $slide1_img = $homepage->id . time() . 'sl1.' . $request->file('slide1_img')->getClientOriginalExtension();
      $slide2_img = $homepage->id . time() . 'sl2.' . $request->file('slide2_img')->getClientOriginalExtension();
      $slide3_img = $homepage->id . time() . 'sl3.' . $request->file('slide3_img')->getClientOriginalExtension();
      $banner_img = $homepage->id . time() . 'ban.' . $request->file('banner_img')->getClientOriginalExtension();

      if ($request->hasFile('slide1_img')) {
        if ($request->file('slide1_img')->isValid()) {
          $request->file('slide1_img')->move( base_path() . '/public/' . $url , $slide1_img );
          $slide1_img_f = new Imagen();
          $slide1_img_f->url = $url . '/' . $slide1_img;
          $slide1_img_f->save();

          $homepage->slide1_img_id = $slide1_img_f->id;
          $homepage->save();
        }
      }

      if ($request->hasFile('slide2_img')) {
        if ($request->file('slide2_img')->isValid()) {
          $request->file('slide2_img')->move( base_path() . '/public/' . $url , $slide2_img );
          $slide2_img_f = new Imagen();
          $slide2_img_f->url = $url . '/' . $slide2_img;
          $slide2_img_f->save();

          $homepage->slide2_img_id = $slide2_img_f->id;
          $homepage->save();
        }
      }

      if ($request->hasFile('slide3_img')) {
        if ($request->file('slide3_img')->isValid()) {
          $request->file('slide3_img')->move( base_path() . '/public/' . $url , $slide3_img );
          $slide3_img_f = new Imagen();
          $slide3_img_f->url = $url . '/' . $slide3_img;
          $slide3_img_f->save();

          $homepage->slide3_img_id = $slide3_img_f->id;
          $homepage->save();
        }
      }

      if ($request->hasFile('banner_img')) {
        if ($request->file('banner_img')->isValid()) {
          $request->file('banner_img')->move( base_path() . '/public/' . $url , $banner_img );
          $banner_img_f = new Imagen();
          $banner_img_f->url = $url . '/' . $banner_img;
          $banner_img_f->save();

          $homepage->banner_img_id = $banner_img_f->id;
          $homepage->save();
        }
      }


     DB::commit();
     return redirect('back/homepage');
  }


  public function show($id){
    Homepage::where('estado', '=', 1)->update(['estado' => 0]);
    $homepage = Homepage::find($id);
    if ( $homepage->estado == 1  ) {
      $homepage->estado = 0;
    }else{
      $homepage->estado =1;
    }
    $homepage->save();
    return redirect('back/homepage');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar homepage";
    $data['homepage'] =  Homepage::find($id);
    $data['slide1_img'] = Imagen::find( $data['homepage']->slide1_img_id );
    $data['slide2_img'] = Imagen::find( $data['homepage']->slide2_img_id );
    $data['slide3_img'] = Imagen::find( $data['homepage']->slide3_img_id );
    $data['banner_img'] = Imagen::find( $data['homepage']->banner_img_id );
    if ($data['homepage']  == null) { return redirect('back/homepage'); } //Verificación para evitar errores
    return view('backoffice.homepage.edit', $data);
  }

    public function update($id, Request $request){    //Tablas a actualizar
      $this->validate($request, [
        'txt_ts1' => 'required',
        'txt_ss1' => 'required',
        'txt_ts2' => 'required',
        'txt_ss2' => 'required',
        'txt_ts3' => 'required',
        'txt_ss3' => 'required',
        'txt_bt' => 'required',
        'txt_bs' => 'required',
      ]);

      //Inicio de las inserciones en la base de datos
      DB::beginTransaction();
        try {
          //Guardado de la cuenta del usuario
          $homepage = Homepage::find( $id );
          $homepage->txt_ts1 = $request->txt_ts1;
          $homepage->txt_ss1 = $request->txt_ss1;
          $homepage->txt_ts2 = $request->txt_ts2;
          $homepage->txt_ss2 = $request->txt_ss2;
          $homepage->txt_ts3 = $request->txt_ts3;
          $homepage->txt_ss3 = $request->txt_ss3;
          $homepage->txt_bt = $request->txt_bt;
          $homepage->txt_bs = $request->txt_bs;
          $homepage->save();
        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }

        $url = 'images/homepage/homepage'. $homepage->id;


        if ($request->hasFile('slide1_img')) {
          $slide1_img = $homepage->id . time() . 'sl1.' . $request->file('slide1_img')->getClientOriginalExtension();
          if ($request->file('slide1_img')->isValid()) {
            $request->file('slide1_img')->move( base_path() . '/public/' . $url , $slide1_img );
            $slide1_img_f = new Imagen();
            $slide1_img_f->url = $url . '/' . $slide1_img;
            $slide1_img_f->save();

            $homepage->slide1_img_id = $slide1_img_f->id;
            $homepage->save();
          }
        }

        if ($request->hasFile('slide2_img')) {
          $slide2_img = $homepage->id . time() . 'sl2.' . $request->file('slide2_img')->getClientOriginalExtension();
          if ($request->file('slide2_img')->isValid()) {
            $request->file('slide2_img')->move( base_path() . '/public/' . $url , $slide2_img );
            $slide2_img_f = new Imagen();
            $slide2_img_f->url = $url . '/' . $slide2_img;
            $slide2_img_f->save();

            $homepage->slide2_img_id = $slide2_img_f->id;
            $homepage->save();
          }
        }

        if ($request->hasFile('slide3_img')) {
          $slide3_img = $homepage->id . time() . 'sl3.' . $request->file('slide3_img')->getClientOriginalExtension();
          if ($request->file('slide3_img')->isValid()) {
            $request->file('slide3_img')->move( base_path() . '/public/' . $url , $slide3_img );
            $slide3_img_f = new Imagen();
            $slide3_img_f->url = $url . '/' . $slide3_img;
            $slide3_img_f->save();

            $homepage->slide3_img_id = $slide3_img_f->id;
            $homepage->save();
          }
        }

        if ($request->hasFile('banner_img')) {
          $banner_img = $homepage->id . time() . 'ban.' . $request->file('banner_img')->getClientOriginalExtension();
          if ($request->file('banner_img')->isValid()) {
            $request->file('banner_img')->move( base_path() . '/public/' . $url , $banner_img );
            $banner_img_f = new Imagen();
            $banner_img_f->url = $url . '/' . $banner_img;
            $banner_img_f->save();

            $homepage->banner_img_id = $banner_img_f->id;
            $homepage->save();
          }
        }
       DB::commit();
       return redirect('back/homepage/'. $id . "/edit");
    }

}
