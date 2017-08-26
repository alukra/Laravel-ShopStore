<?php

namespace App\Http\Controllers\Frontpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Landing;
use App\Models\Imagen;

class LandingController extends Controller
{
  public function getIndex(){
    $data['landing'] = Landing::select('Landing.*', 'Imagen.url as img2')
      ->join('Imagen', 'Imagen.id', 'img2_id')
      ->where('Landing.estado', '=', 1)->first();
    $data['celimg'] = Imagen::find( $data['landing']->celimg_id );
    $data['tabimg'] = Imagen::find( $data['landing']->tabimg_id );
    $data['coming'] = Imagen::find( $data['landing']->comimg_id );

    return view('frontpage.landing.index', $data);
  }
}
