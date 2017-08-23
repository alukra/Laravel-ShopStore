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

use App\Models\Producto;
use App\Models\Caracteristica;
use App\Models\Tipo;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Suscripcion;
use App\Models\Marca;


class HomepageController extends Controller
{
    public function getIndex(){
      $data['tipos'] = Tipo::select('tipo.*', 'url')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->limit(4)->get();
      $data['categorias'] = Categoria::select(DB::raw('categoria.*, url,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON producto.id = producto_id
              WHERE (categoria_id = categoria.id) AND (producto_categoria.deleted_at IS NULL) ) as productos ')
        )->join('imagen', 'imagen.id', 'imagen_id')
        ->limit(3)->get();

      return view('frontpage.index', $data);
    }


    public function getProducts($tipo, $categoria, $marca, Request $request ){

      $data['page_title'] = "Filtrado";

      $data['grid']['tipo'] = $tipo;
      $data['grid']['marca'] = $marca;
      $data['grid']['categoria'] = $categoria;

      $where[] = ['venta', '=', 1];
      $where[] = ['producto_imagen.principal', '=', 1];
      if ($tipo != 0) {
        $where[] = ['tipo_id', '=', $tipo];
      }
      if ($categoria != 0) {
        $where[] = ['categoria_id', '=', $categoria];
      }
      if ($marca != 0) {
        $where[] = ['marca_id', '=', $marca];
      }


      if ($categoria != 0) {
        $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo' , 'marca.nombre as marca')
        ->join('producto_imagen', 'producto.id', 'producto_imagen.producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('producto_categoria', 'producto.id', 'producto_categoria.producto_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->join('categoria', 'categoria_id', 'categoria.id')
        ->join('marca', 'marca.id', '=', 'producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('producto.id', 'DESC')
        ->paginate(15);
      }else {
        $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo' , 'marca.nombre as marca')
        ->join('producto_imagen', 'producto.id', 'producto_imagen.producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('producto_categoria', 'producto.id', 'producto_categoria.producto_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->join('marca', 'marca.id', '=', 'producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('producto.id', 'DESC')
        ->paginate(15);
      }

      $data['grid']['productos'] = $data['productos']->count();

      //Datos del Filtrado
      $data['marcas'] = Marca::select(DB::raw('marca.id, marca.nombre,
            (SELECT count(producto.id) FROM Producto
              WHERE marca_id = marca.id ) AS productos'))->get();
      $data['tipos'] = Tipo::select(DB::raw('tipo.id, tipo.nombre,
            (SELECT count(producto.id) FROM Producto
              WHERE tipo_id = tipo.id ) AS productos'))->get();
      $data['categorias'] = Categoria::select(DB::raw('categoria.id, categoria.nombre,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON producto.id = producto_id
              WHERE (categoria_id = categoria.id) AND (producto_categoria.deleted_at IS NULL) ) as productos '))->get();

      return view('frontpage.grid.index', $data);

    }

    public function getProductsList($tipo, $categoria, $marca, Request $request ){

      $data['page_title'] = "Filtrado";

      $data['grid']['tipo'] = $tipo;
      $data['grid']['marca'] = $marca;
      $data['grid']['categoria'] = $categoria;

      $where[] = ['venta', '=', 1];
      $where[] = ['producto_imagen.principal', '=', 1];
      if ($tipo != 0) {
        $where[] = ['tipo_id', '=', $tipo];
      }
      if ($categoria != 0) {
        $where[] = ['categoria_id', '=', $categoria];
      }
      if ($marca != 0) {
        $where[] = ['marca_id', '=', $marca];
      }


      if ($categoria != 0) {
        $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo' , 'marca.nombre as marca')
        ->join('producto_imagen', 'producto.id', 'producto_imagen.producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('producto_categoria', 'producto.id', 'producto_categoria.producto_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->join('categoria', 'categoria_id', 'categoria.id')
        ->join('marca', 'marca.id', '=', 'producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('producto.id', 'DESC')
        ->paginate(15);
      }else {
        $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo' , 'marca.nombre as marca')
        ->join('producto_imagen', 'producto.id', 'producto_imagen.producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('producto_categoria', 'producto.id', 'producto_categoria.producto_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->join('marca', 'marca.id', '=', 'producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('producto.id', 'DESC')
        ->paginate(15);
      }
      $data['grid']['productos'] = $data['productos']->count();

      //Datos del Filtrado
      $data['marcas'] = Marca::select(DB::raw('marca.id, marca.nombre,
            (SELECT count(producto.id) FROM Producto
              WHERE marca_id = marca.id ) AS productos'))->get();
      $data['tipos'] = Tipo::select(DB::raw('tipo.id, tipo.nombre,
            (SELECT count(producto.id) FROM Producto
              WHERE tipo_id = tipo.id ) AS productos'))->get();
      $data['categorias'] = Categoria::select(DB::raw('categoria.id, categoria.nombre,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON producto.id = producto_id
              WHERE (categoria_id = categoria.id) AND (producto_categoria.deleted_at IS NULL) ) as productos '))->get();


      return view('frontpage.lista.index', $data);
    }

    public function postFilter(Request $request){
      if ($request->has('tipo')) {
        $tipo = $request->tipo;
      }else{
        $tipo = 0;
      }
      if ($request->has('marca')) {
        $marca = $request->marca;
      }else{
        $marca = 0;
      }
      if ($request->has('categoria')) {
        $categoria = $request->categoria;
      }else{
        $categoria = 0;
      }
      return redirect('products/' . $tipo . '/' . $categoria. '/' . $marca);
    }

    public function getProduct($id, Request $request){

      $data['producto'] = Producto::select('producto.*', 'tipo.nombre as tipo')
                ->join('tipo', 'tipo.id', '=', 'producto.tipo_id')
                ->where('producto.id', '=', $id)
                ->first();

      if ($data['producto']  == null) { return redirect('/'); }

      //Datos del producto
      $data['imagenes'] = Imagen::select('imagen.*', 'producto_imagen.principal')
        ->join('producto_imagen', 'imagen_id', '=', 'imagen.id')
        ->where([
          ['producto_id', '=', $id],
          ['producto_imagen.deleted_at', '=', null],
        ])->orderBy('principal', 'DESC')->get();
      $data['marca'] = Marca::select('marca.nombre', 'imagen.url')->where('marca.id', '=',  $data['producto']->marca_id  )
        ->join('imagen', 'imagen.id', 'marca.imagen_id')->first();
      $data['categorias'] = Categoria::select('categoria.*')
        ->join('producto_categoria', 'categoria_id', '=', 'categoria.id')
        ->where([
          ['producto_id', '=', $id],
          ['producto_categoria.deleted_at', '=', null],
        ])->get();
      $data['caracteristicas'] = Caracteristica::select('caracteristica.*', 'producto_caracteristica.descripcion')
        ->join('producto_caracteristica', 'caracteristica_id', '=', 'caracteristica.id')
        ->where([
          ['producto_id', '=', $id],
          ['producto_caracteristica.deleted_at', '=', null],
        ])->orderBy('orden', 'ASC')->get();
      $data['caracteristicas_p'] = Caracteristica::select('caracteristica.*', 'producto_caracteristica.descripcion')
        ->join('producto_caracteristica', 'caracteristica_id', '=', 'caracteristica.id')
        ->where([
          ['producto_id', '=', $id],
          ['producto_caracteristica.deleted_at', '=', null],
          ['principal', '=', 1],
        ])->orderBy('orden', 'ASC')->get();

      //Productos parecidos
      $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo')
        ->join('producto_imagen', 'producto.id', 'producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->where([
          ['venta', '=', 1],
          ['producto_id', '!=', $id],
        ])
        ->orderBy('producto.precio', 'DESC')->limit(8)->get();

      $data['page_title'] = $data['producto']->nombre;
      return view('frontpage.productos.producto', $data);
    }

    public function postSuscribe(Request $request){

      $this->validate($request, [
        'email'    => 'required|email|max:64',
      ]);

      $suscribe = new Suscripcion();
      $suscribe->email = $request->email;
      $suscribe->save();

      return back();
    }

}
