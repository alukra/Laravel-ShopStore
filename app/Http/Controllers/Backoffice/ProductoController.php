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
use App\Models\Marca;
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
    $data['productos'] = Producto::select('Producto.*', 'Tipo.nombre as tipo', 'Marca.nombre as marca')
              ->join('Tipo', 'Tipo.id', '=', 'Producto.tipo_id')
              ->join('Marca', 'Marca.id', '=', 'Producto.marca_id')->get();
    return view('backoffice.producto.index')->with($data);
  }

  public function create(){
    $data['user_perfil'] = Session()->get('perfil');
    $data['page_title'] = "Registrar producto";
    $data['tipos'] = Tipo::all();
    $data['marcas'] = Marca::all();
    return view('backoffice.producto.create', $data);
  }

  public function store(Request $request){
    $this->validate($request, [
      'nombre' => 'max:64|required',
      'sku' => 'max:32|alpha_num|required',
      'precio' => 'numeric|required',
      'precio_promocion' => 'numeric',
      'tipo' => 'required',
      'marca' => 'required',
      'descripcion' => 'required'
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
        $producto->marca_id = $request->marca;
        $producto->descripcion = $request->descripcion;
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
    $data['producto'] = Producto::select('Producto.*', 'Tipo.nombre as tipo')
              ->join('Tipo', 'Tipo.id', '=', 'Producto.tipo_id')
              ->join('Marca', 'Marca.id', '=', 'Producto.marca_id')
              ->where('Producto.id', '=', $id)
              ->first();

    if ($data['producto']  == null) { return redirect('back/product'); } //Verificación para evitar errores

    //Datos del producto
    $data['imagenes'] = Imagen::select('Imagen.*', 'Producto_imagen.principal')
      ->join('Producto_imagen', 'imagen_id', '=', 'Imagen.id')
      ->where([
        ['producto_id', '=', $id],
        ['Producto_imagen.deleted_at', '=', null],
      ])->get();
    $data['categorias_producto'] = Categoria::select('Categoria.*')
      ->join('Producto_categoria', 'categoria_id', '=', 'Categoria.id')
      ->where([
        ['producto_id', '=', $id],
        ['Producto_categoria.deleted_at', '=', null],
      ])->get();
    $data['caracteristicas_producto'] = Caracteristica::select('Caracteristica.*', 'Producto_caracteristica.descripcion')
      ->join('Producto_caracteristica', 'caracteristica_id', '=', 'Caracteristica.id')
      ->where([
        ['producto_id', '=', $id],
        ['Producto_caracteristica.deleted_at', '=', null],
      ])->get();

    //Datos generales
    $data['tipos'] =  Tipo::all();
    $data['marcas'] = Marca::all();
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
      'marca' => 'required',
      'descripcion' => 'required'
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
        $producto->marca_id = $request->marca;
        $producto->descripcion = $request->descripcion;
        $producto->save();
      } catch (\Exception $e) {
        DB::rollback();
        throw $e;
      }

     DB::commit();
     return redirect('back/product/'. $id . "/edit");
  }


}
