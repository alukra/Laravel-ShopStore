<?php

namespace App\Http\Controllers\Frontpage;

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
    public function getLocation($id, Request $request){
      $data['ubicacion'] = Ubicacion::find($id);
      $data['ubicaciones'] = Ubicacion::all();
      $data['page_title'] = $data['ubicacion']->nombre;

      return view('frontpage.ubicacion')->with($data);
    }
}
