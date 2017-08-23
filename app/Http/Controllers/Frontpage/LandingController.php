<?php

namespace App\Http\Controllers\Frontpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Landing;
use App\Models\Imagen;

class LandingController extends Controller
{
  public function getIndex(){
    $data['landing'] = Landing::select('landing.*', 'imagen.url as img2')
      ->join('imagen', 'imagen.id', 'img2_id')
      ->where('landing.estado', '=', 1)->first();
    $data['celimg'] = Imagen::find( $data['landing']->celimg_id );
    $data['tabimg'] = Imagen::find( $data['landing']->celimg_id );
    $data['coming'] = Imagen::find( $data['landing']->celimg_id );

    return view('frontpage.landing.index', $data);
  }
}
