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

use App\Models\Producto;
use App\Models\Caracteristica;
use App\Models\Tipo;
use App\Models\Categoria;
use App\Models\Imagen;

class ProductoController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
      $this->middleware('rol:1');
      $this->middleware('acceso', ['only' => ['index','create']] );
  }

  public function index() {
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Productos";
    $data['productos'] = Producto::select('producto.*', 'tipo.nombre as tipo')
              ->join('tipo', 'tipo.id', '=', 'producto.tipo_id')->get();
    return view('backoffice.producto.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar producto";
    $data['tipos'] = Tipo::all();
    return view('backoffice.producto.create', $data);
  }

  public function store(Request $request){
    $this->validate($request, [
      'nombre' => 'max:64|required',
      'sku' => 'max:32|alpha_num|required',
      'precio' => 'numeric|required',
      'precio_promocion' => 'numeric',
      'tipo' => 'required',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $producto = new Producto();
        $producto->garantia_id = 1;
        $producto->nombre = $request->nombre;
        $producto->sku = $request->sku;
        $producto->precio = $request->precio;
        if ($request->has('precio_promocion') ) {
          $producto->precio_promocion = $request->precio_promocion;
        }else{
          $producto->precio_promocion = 0;
        }
        $producto->stock =0;
        $producto->liquidacion = 0;
        $producto->venta = 0;
        $producto->rated = 0;
        $producto->tipo_id = $request->tipo;
        $producto->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

     DB::commit();
     return redirect('back/product');
  }

  public function edit($id){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title']  = "Editar Producto";
    $data['producto'] = Producto::select('producto.*', 'tipo.nombre as tipo')
              ->join('tipo', 'tipo.id', '=', 'producto.tipo_id')
              ->where('producto.id', '=', $id)
              ->first();

    if ($data['producto']  == null) { return redirect('back/product'); } //Verificación para evitar errores

    //Datos del producto
    $data['imagenes'] = Imagen::select('imagen.*', 'producto_imagen.principal')
      ->join('producto_imagen', 'imagen_id', '=', 'imagen.id')
      ->where([
        ['producto_id', '=', $id],
        ['producto_imagen.deleted_at', '=', null],
      ])->get();
    $data['categorias_producto'] = Categoria::select('categoria.*')
      ->join('producto_categoria', 'categoria_id', '=', 'categoria.id')
      ->where([
        ['producto_id', '=', $id],
        ['producto_categoria.deleted_at', '=', null],
      ])->get();
    $data['caracteristicas_producto'] = Caracteristica::select('caracteristica.*', 'producto_caracteristica.descripcion')
      ->join('producto_caracteristica', 'caracteristica_id', '=', 'caracteristica.id')
      ->where([
        ['producto_id', '=', $id],
        ['producto_caracteristica.deleted_at', '=', null],
      ])->get();

    //Datos generales
    $data['tipos'] =  Tipo::all();
    $data['categorias'] = Categoria::where('estado', '=', 1)->get();
    $data['caracteristicas'] = Caracteristica::where('estado', '=', 1)->get();
    return view('backoffice.producto.edit', $data);
  }

  public function update($id,Request $request){
    $producto = Producto::find($id);
    $this->validate($request, [
      'nombre' => 'max:64|required',
      'sku' => 'max:32|alpha_num|required',
      'precio' => 'numeric|required',
      'precio_promocion' => 'numeric',
      'stock' => 'numeric',
      'tipo' => 'required',
    ]);

    //Inicio de las inserciones en la base de datos
    DB::beginTransaction();
      try {
        //Guardado de la cuenta del usuario
        $producto->nombre = $request->nombre;
        $producto->sku = $request->sku;
        $producto->precio = $request->precio;
        if ($request->has('precio_promocion') ) {
          $producto->precio_promocion = $request->precio_promocion;
        }
        if ($request->has('stock')) {
          $producto->stock = $request->stock;
        }
        if ($request->has('liquidacion')) {
          $producto->liquidacion = 1;
        }else {
          $producto->liquidacion = 0;
        }
        if ($request->has('rated')) {
          $producto->rated = 1;
        }else {
          $producto->rated = 0;
        }
        if ($producto->stock > 0 ) {
          $producto->venta = 1;
        }else {
          $producto->venta = 0;
        }
        $producto->tipo_id = $request->tipo;
        $producto->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

     DB::commit();
     return redirect('back/product/'. $id . "/edit");
  }


}
