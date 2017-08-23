<?php

namespace App\Http\Controllers\Backoffice;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Modulo;
use App\Models\Modulo_seccion;
use App\Models\Suscripcion;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rol:1');
    }

    public function index(){
      $data['page_title'] = "Dashboard";
      $data['user_perfil'] = Session()->get('perfil');

      $data['modulos'] = Modulo::select('modulo.id', 'modulo.nombre', 'modulo.icono')
                ->join('modulo_seccion', 'modulo.id', '=', 'modulo_id')
                ->join('permiso_rol', 'modulo_seccion.id', '=', 'permiso_rol.modulo_seccion_id')
                ->where('rol_id', '=', Auth::user()->rol_id)
                ->groupBy('modulo.id', 'modulo.nombre', 'modulo.icono')
                ->orderBy('modulo.orden', 'asc')
                ->get();
      $data['submodulos'] = Modulo_seccion::select('modulo_seccion.nombre', 'modulo_seccion.url', 'modulo_seccion.icono', 'modulo_id')
                ->join('permiso_rol', 'modulo_seccion.id', '=', 'permiso_rol.modulo_seccion_id')
                ->where('rol_id', '=', Auth::user()->rol_id)
                ->orderBy('orden', 'asc')
                ->get();
      return view('backoffice.dashboard', $data);
    }

    public function getSuscribe(Request $request){
      $data['user_perfil'] = Session()->get('perfil');
      $data['page_title'] = "Suscriptores";
      $data['suscriptores'] = Suscripcion::all();
      return view('backoffice.clientes.suscripcion')->with($data);
    }
}
