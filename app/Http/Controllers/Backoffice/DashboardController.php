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

      $data['modulos'] = Modulo::select('Modulo.id', 'Modulo.nombre', 'Modulo.icono')
                ->join('Modulo_seccion', 'Modulo.id', '=', 'modulo_id')
                ->join('Permiso_rol', 'Modulo_seccion.id', '=', 'Permiso_rol.modulo_seccion_id')
                ->where('rol_id', '=', Auth::user()->rol_id)
                ->groupBy('Modulo.id', 'Modulo.nombre', 'Modulo.icono')
                ->orderBy('Modulo.orden', 'asc')
                ->get();
      $data['submodulos'] = Modulo_seccion::select('Modulo_seccion.nombre', 'Modulo_seccion.url', 'Modulo_seccion.icono', 'modulo_id')
                ->join('Permiso_rol', 'Modulo_seccion.id', '=', 'Permiso_rol.modulo_seccion_id')
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
