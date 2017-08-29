<?php

namespace App\Http\Controllers\Backoffice;

//Helper
use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\General;

//BD
use App\User;
use App\Models\Empleado;
use App\Models\Rol;


class EmpleadoController extends Controller{

  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  /**
   * Muestra los empleados del sistema:
   * se permite editar los roles e ir a la pantalla de edicion de los afiliados
   *
   * @return \Illuminate\Http\Response
   */
  public function index(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Empleados";
    $data['empleados'] = Empleado::select('Empleado.id', 'Users.nombre', 'apellido', 'Empleado.usuario_id', 'Rol.nombre as rol', 'telefono', 'email')
                          ->join('Users', 'Users.id', '=', 'Empleado.usuario_id')
                          ->join('Rol', 'Rol.id', '=', 'Users.rol_id')
                          ->get();
    return view('backoffice.empleado.index')->with($data);
  }


  /**
   * Creación de un nuevo empleado
   * @return [type] [description]
   */
  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar empleado";

    $data['roles'] = Rol::all();
    return view('backoffice.empleado.create', $data);
  }

  /**
     * Guardar empleado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      $this->validate($request, [
        'nombre' => 'max:32|required|regex:/^[A-Za-z ñáéíóú\s]+$/',
        'apellido' => 'required|max:64|regex:/^[A-Za-z ñáéíóú\s]+$/',
        'email'    => 'required|email|max:64',
        'direccion' => 'required|max:250',
        'genero' => 'required',
        'fecha_nacimiento' => 'required',
        'rol' => 'required'
      ]);

      //Inicio de las inserciones en la base de datos
      DB::beginTransaction();
        try {
          //Guardado de la cuenta del usuario
          $usuario = new User();
          $usuario->email = $request->email;
          $usuario->password = bcrypt("empleadovaldez");
          $usuario->nombre = $request->nombre;
          $usuario->apellido = $request->apellido;
          $usuario->rol_id = $request->rol;
          $usuario->tipo = 1;
          $usuario->save();

          //Creación del empleado
          $empleado = new Empleado();
          $empleado->usuario_id = $usuario->id;
          $empleado->direccion = $request->direccion;
          $empleado->genero = $request->genero;
          $empleado->fecha_nacimiento = Carbon::createFromFormat('d-m-Y', $request->fecha_nacimiento);
          $empleado->telefono = $request->telefono;
          $empleado->celular = $request->celular;
          $empleado->dui = $request->dui;
          $empleado->nit = $request->nit;
          $empleado->afp = $request->afp;
          $empleado->save();

        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }
       DB::commit();
       return redirect('back/employee');
    }

    /**
    * muestra el formulario de edición del empleado desde la administración del empleado.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit( $id ){
      $data['user_perfil'] = Session()->get('perfil');
      $data['empleado'] =  Empleado::select('Empleado.*', 'rol_id', 'email', 'nombre', 'apellido')
                            ->join('Users', 'Users.id', '=' , 'Empleado.usuario_id')
                            ->where('Empleado.id', '=', $id)
                            ->first();
      $data['page_title']  = "Editar perfil de " . $data['empleado']['nombre'] . ' ' . $data['empleado']['apellido'];
      if ($data['empleado']  == null) { return redirect('back/employee'); } //Verificación para evitar errores
      $data['empleado']->fecha_nacimiento = General::formatoFecha( $data['empleado']->fecha_nacimiento );
      $data['roles'] = Rol::all();
      return view('backoffice.empleado.edit', $data);
    }

    /**
     * muestra el formulario de edición del empleado desde la administración del empleado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){    //Tablas a actualizar

      $empleado = Empleado::find( $id );
      $usuario = User::find( $empleado->usuario_id );

      $this->validate($request, [
        'nombre' => 'max:32|required|regex:/^[A-Za-z ñáéíóú\s]+$/',
        'apellido' => 'required|max:64|regex:/^[A-Za-z ñáéíóú\s]+$/',
        'email'    => 'required|email|max:64',
        'direccion' => 'required|max:250',
        'genero' => 'required',
        'fecha_nacimiento' => 'required',
        'rol' => 'required'
      ]);

      //Inicio de las inserciones en la base de datos
      DB::beginTransaction();
        try {
          //Guardado de la cuenta del usuario
          $usuario->email = $request->email;
          $usuario->nombre = $request->nombre;
          $usuario->apellido = $request->apellido;
          $usuario->rol_id = $request->rol;
          $usuario->save();

          //Creación del empleado
          $empleado->direccion = $request->direccion;
          $empleado->genero = $request->genero;
          $empleado->fecha_nacimiento =  Carbon::createFromFormat('d-m-Y', $request->fecha_nacimiento);
          $empleado->telefono = $request->telefono;
          $empleado->celular = $request->celular;
          $empleado->dui = $request->dui;
          $empleado->nit = $request->nit;
          $empleado->afp = $request->afp;
          $empleado->save();

        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }
       DB::commit();
       return redirect('back/employee/' . $id  . "/edit");

    }

}
