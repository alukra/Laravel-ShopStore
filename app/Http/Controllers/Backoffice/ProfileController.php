<?php

namespace App\Http\Controllers\Backoffice\Empleado;

//Helper
use DB;
use Auth;
use Session;
use Validator;
use JsValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\PrestaShopWebservice;
use App\Helpers\SarpShop;
use App\Helpers\Locacion;
use App\Helpers\General;
use App\Helpers\Session_usuario;

//BD
use App\User;
use App\Models\Empleado;
use App\Models\Idioma;
use App\Models\Imagen_usuario;
use App\Models\Pais;
use App\Models\Codigo_usuario;
use App\Models\Rol;

class ProfileController extends Controller
{
    
    /**
     * Perfil del empleado.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
      $data['user_perfil'] = Session()->get('perfil');
      $data['page_title'] =  trans('titles.editar_perfil') . $data['user_perfil']['nombre'] . ' ' . $data['user_perfil']['apellido'];

      //Datos
      $perfil = Empleado::find($data['user_perfil']['id']);
      $data['perfil'] = $perfil;
      $data['perfil']->fecha_nacimiento = General::formatoFecha( $data['perfil']->fecha_nacimiento );
      $data['idiomas'] = Idioma::orderBy('nombre', 'asc')->get();
      $data['paises'] = Locacion::getPais();
      $data['departamentos'] = Locacion::getDepartamentosByPais($perfil->pais_id);
      $data['ciudades'] = Locacion::getCiudadesByDepartamento($perfil->departamento_id);
      
      $data['validator'] = $this->validator();
      return view('backoffice.empleado.profile', $data);
    }

    /**
     * Guardar el perfil.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request){
      
      $validator = Validator::make($request->all(), [ 
        'password'     => 'required_with:new_password',
        'new_password' => 'confirmed|min:6',          
        'nombre' => 'max:32|required',
        'apellido' => 'max:64|required',
        'direccion' => 'max:250|required',
        'genero' => 'required',
        'fecha_nacimiento' => 'date_format:d/m/Y|before:today|required',
        'idioma_id' => 'required',
        'pais_id' => 'required',
        'departamento_id' => 'required',
        'ciudad_id' => 'required'
      ]);
      if ($validator->fails()) { $this->throwValidationException( $request, $validator); }

      $usuario = User::find( Auth::user()->id );
      if ($request->has('new_password')){
        $usuario->password = bcrypt($request->input('new_password'));
        $usuario->ultimo_cambio_usuario_id = Auth::user()->id;
        $usuario->save();
      }  

      $empleado = Empleado::where('usuario_id' , $usuario->id )->first();
      $empleado->nombre = $request->input('nombre');
      $empleado->apellido = $request->input('apellido');
      $empleado->fecha_nacimiento = $request->input('fecha_nacimiento');
      $empleado->idioma_id = $request->input('idioma_id');
      $empleado->genero = $request->input('genero');
      $empleado->pais_id = $request->input('pais_id');
      $empleado->departamento_id = $request->input('departamento_id');
      $empleado->ciudad_id = $request->input('ciudad_id');
      $empleado->direccion = $request->input('direccion');
      $empleado->notificaciones_activas = $request->input('notificaciones_activas', 'N');
      $empleado->ultimo_cambio_usuario_id = Auth::user()->id;  
      $empleado->save();

      /*
      //modificar datos del empleado en el panel de administracion de la u-shop
      $datosIdiomaSarp = Idioma::find($empleado->idioma_id); //Obtener datos del idioma de SARP
      $datosIdiomaPS = SarpShop::getIdiomaId($datosIdiomaSarp->codigo); //Obtener datos del idioma de PS
       
      //actualizar datos del perfil empleado en prestashop
      $datosEmployee = array(   
        'id_profile'=>'',
        'id_lang'=>$datosIdiomaPS->language->id, 
        'lastname'=>$empleado->apellido,
        'firstname'=>$empleado->nombre,
        'email'=>$usuario->email,
        'passwd'=>$usuario->password,
        'usuario_id'=>$empleado->id,
        'tipo_empleado'=>'E'
      );             
      SarpShop::UpdateEmployee($empleado->id, $empleado->codigo, 'E', $datosEmployee);
      */


      Session_usuario::session_usuario();
      $messages[] = "success_info";
      $request->session()->flash('messages', $messages);
      $request->session()->flash('status', 'success');

      return redirect('back/profile');
    }


    /**
     * Subir imagen de perfil
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUpdateImage(Request $request){
      $validator = Validator::make($request->all(), [ 'imagen' => 'required|mimes:jpeg,png|image']);
      //Verificar imagen
      if ($validator->fails()) { $this->throwValidationException( $request, $validator); }

      $empleado = Empleado::where('usuario_id' , Auth::user()->id )->first();

      $url = 'img/profile/'. $empleado->codigo; 
      $imageName = $empleado->codigo . time() . '.' . $request->file('imagen')->getClientOriginalExtension();

      try {

        DB::beginTransaction();
        //Upload de imagen
        $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );

        Imagen_usuario::where('usuario_id' , Auth::user()->id )
          ->update([
            'estado' => 0,
            'ultimo_cambio_usuario_id' => Auth::user()->id,
          ]);
        $imagen_usuario = new Imagen_usuario();
        $imagen_usuario->usuario_id = Auth::user()->id;
        $imagen_usuario->nombre = $imageName;
        $imagen_usuario->url = $url . '/' . $imageName;
        $imagen_usuario->extension = $request->file('imagen')->getClientOriginalExtension(); 
        $imagen_usuario->estado = 1;
        $imagen_usuario->ultimo_cambio_usuario_id = Auth::user()->id;
        $imagen_usuario->save();

      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }
      DB::commit();

  

      Session_usuario::session_usuario();
      $messages[] = "success_image";
      $request->session()->flash('messages', $messages);
      $request->session()->flash('status', 'success');
      return redirect('back/profile');
    }

    //----------------------------------------------------------------------------
    //Funciones internas

    //validacion de las opciones del empleado
    protected function validator(){
      return JsValidator::make([
        'password'     => 'required_with:new_password',
        'new_password' => 'confirmed|min:6',          
        'nombre' => 'max:32|required',
        'apellido' => 'max:64|required',
        'direccion' => 'max:250|required',
        'genero' => 'required',
        'fecha_nacimiento' => 'date_format:d/m/Y|before:today|required',
        'idioma_id' => 'required',
        'pais_id' => 'required',
        'departamento_id' => 'required',
        'ciudad_id' => 'required'
      ]);
    }

}
