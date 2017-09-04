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
use App\Models\Homepage;


class HomepageController extends Controller
{
    public function getIndex(){
      $data['tipos'] = Tipo::select('Tipo.*', 'url')
        ->join('Imagen', 'Imagen.id', 'imagen_id')
        ->limit(4)->get();

      $data['homepage'] =  Homepage::where('estado', '=', 1)->first();
      $data['slide1_img'] = Imagen::find( $data['homepage']->slide1_img_id );
      $data['slide2_img'] = Imagen::find( $data['homepage']->slide2_img_id );
      $data['slide3_img'] = Imagen::find( $data['homepage']->slide3_img_id );
      $data['banner_img'] = Imagen::find( $data['homepage']->banner_img_id );
      $data['categorias'] = Categoria::select(DB::raw('Categoria.*, url,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON Producto.id = producto_id
              WHERE (categoria_id = Categoria.id) AND (Producto_categoria.deleted_at IS NULL) ) as productos ')
        )->join('Imagen', 'Imagen.id', 'imagen_id')
        ->limit(3)->get();

      return view('frontpage.index', $data);
    }


    public function getProducts($tipo, $categoria, $marca, Request $request ){

      $data['page_title'] = "Filtrado";

      $data['grid']['tipo'] = $tipo;
      $data['grid']['marca'] = $marca;
      $data['grid']['categoria'] = $categoria;

      $where[] = ['venta', '=', 1];
      $where[] = ['Producto_imagen.principal', '=', 1];
      $where[] = ['Producto_imagen.deleted_at', '=', null];
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
        $data['productos'] = Producto::select('Producto.*', 'Imagen.url', 'Tipo.nombre as tipo' , 'Marca.nombre as marca')
        ->join('Producto_imagen', 'Producto.id', 'Producto_imagen.producto_id')
        ->join('Imagen', 'Imagen.id', 'imagen_id')
        ->join('Producto_categoria', 'Producto.id', 'Producto_categoria.producto_id')
        ->join('Tipo', 'tipo_id', 'Tipo.id')
        ->join('Categoria', 'categoria_id', 'Categoria.id')
        ->join('Marca', 'Marca.id', '=', 'Producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('Producto.id', 'DESC')
        ->paginate(15);
      }else {
        $data['productos'] = Producto::select('Producto.*', 'Imagen.url', 'Tipo.nombre as tipo' , 'Marca.nombre as marca')
        ->join('Producto_imagen', 'Producto.id', 'Producto_imagen.producto_id')
        ->join('Imagen', 'Imagen.id', 'imagen_id')
        ->join('Producto_categoria', 'Producto.id', 'Producto_categoria.producto_id')
        ->join('Tipo', 'tipo_id', 'Tipo.id')
        ->join('Marca', 'Marca.id', '=', 'Producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('Producto.id', 'DESC')
        ->paginate(15);
      }

      $data['grid']['productos'] = $data['productos']->count();

      //Datos del Filtrado
      $data['marcas'] = Marca::select(DB::raw('Marca.id, Marca.nombre,
            (SELECT count(Producto.id) FROM Producto
              WHERE marca_id = Marca.id ) AS productos'))->get();
      $data['tipos'] = Tipo::select(DB::raw('Tipo.id, Tipo.nombre,
            (SELECT count(Producto.id) FROM Producto
              WHERE tipo_id = Tipo.id ) AS productos'))->get();
      $data['categorias'] = Categoria::select(DB::raw('Categoria.id, Categoria.nombre,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON Producto.id = producto_id
              WHERE (categoria_id = Categoria.id) AND (Producto_categoria.deleted_at IS NULL) ) as productos '))->get();

      return view('frontpage.grid.index', $data);

    }

    public function getProductsList($tipo, $categoria, $marca, Request $request ){

      $data['page_title'] = "Filtrado";

      $data['grid']['tipo'] = $tipo;
      $data['grid']['marca'] = $marca;
      $data['grid']['categoria'] = $categoria;

      $where[] = ['venta', '=', 1];
      $where[] = ['Producto_imagen.principal', '=', 1];
      $where[] = ['Producto_imagen.deleted_at', '=', null];
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
        $data['productos'] = Producto::select('Producto.*', 'Imagen.url', 'Tipo.nombre as tipo' , 'Marca.nombre as marca')
        ->join('Producto_imagen', 'Producto.id', 'Producto_imagen.producto_id')
        ->join('Imagen', 'Imagen.id', 'imagen_id')
        ->join('Producto_categoria', 'Producto.id', 'Producto_categoria.producto_id')
        ->join('Tipo', 'tipo_id', 'Tipo.id')
        ->join('Categoria', 'categoria_id', 'Categoria.id')
        ->join('Marca', 'Marca.id', '=', 'Producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('Producto.id', 'DESC')
        ->paginate(15);
      }else {
        $data['productos'] = Producto::select('Producto.*', 'Imagen.url', 'Tipo.nombre as tipo' , 'Marca.nombre as marca')
        ->join('Producto_imagen', 'Producto.id', 'Producto_imagen.producto_id')
        ->join('Imagen', 'Imagen.id', 'imagen_id')
        ->join('Producto_categoria', 'Producto.id', 'Producto_categoria.producto_id')
        ->join('Tipo', 'tipo_id', 'Tipo.id')
        ->join('Marca', 'Marca.id', '=', 'Producto.marca_id')
        ->where($where)
        ->distinct()
        ->orderBy('Producto.id', 'DESC')
        ->paginate(15);
      }

      $data['grid']['productos'] = $data['productos']->count();

      //Datos del Filtrado
      $data['marcas'] = Marca::select(DB::raw('Marca.id, Marca.nombre,
            (SELECT count(Producto.id) FROM Producto
              WHERE marca_id = Marca.id ) AS productos'))->get();
      $data['tipos'] = Tipo::select(DB::raw('Tipo.id, Tipo.nombre,
            (SELECT count(Producto.id) FROM Producto
              WHERE tipo_id = Tipo.id ) AS productos'))->get();
      $data['categorias'] = Categoria::select(DB::raw('Categoria.id, Categoria.nombre,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON Producto.id = producto_id
              WHERE (categoria_id = Categoria.id) AND (Producto_categoria.deleted_at IS NULL) ) as productos '))->get();

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

      $data['producto'] = Producto::select('Producto.*', 'Tipo.nombre as tipo')
                ->join('Tipo', 'Tipo.id', '=', 'Producto.tipo_id')
                ->where('Producto.id', '=', $id)
                ->first();

      if ($data['producto']  == null) { return redirect('/'); }

      //Datos del producto
      $data['imagenes'] = Imagen::select('Imagen.*', 'Producto_imagen.principal')
        ->join('Producto_imagen', 'imagen_id', '=', 'Imagen.id')
        ->where([
          ['producto_id', '=', $id],
          ['Producto_imagen.deleted_at', '=', null],
        ])->orderBy('principal', 'DESC')->get();
      $data['marca'] = Marca::select('Marca.nombre', 'Imagen.url')->where('Marca.id', '=',  $data['producto']->marca_id  )
        ->join('Imagen', 'Imagen.id', 'Marca.imagen_id')->first();
      $data['categorias'] = Categoria::select('Categoria.*')
        ->join('Producto_categoria', 'categoria_id', '=', 'Categoria.id')
        ->where([
          ['producto_id', '=', $id],
          ['Producto_categoria.deleted_at', '=', null],
        ])->get();
      $data['caracteristicas'] = Caracteristica::select('Caracteristica.*', 'Producto_caracteristica.descripcion')
        ->join('Producto_caracteristica', 'caracteristica_id', '=', 'Caracteristica.id')
        ->where([
          ['producto_id', '=', $id],
          ['Producto_caracteristica.deleted_at', '=', null],
        ])->orderBy('orden', 'ASC')->get();
      $data['caracteristicas_p'] = Caracteristica::select('Caracteristica.*', 'Producto_caracteristica.descripcion')
        ->join('Producto_caracteristica', 'caracteristica_id', '=', 'Caracteristica.id')
        ->where([
          ['producto_id', '=', $id],
          ['Producto_caracteristica.deleted_at', '=', null],
          ['principal', '=', 1],
        ])->orderBy('orden', 'ASC')->get();

      //Productos parecidos
      $data['productos'] = Producto::select('Producto.*', 'Imagen.url', 'Tipo.nombre as tipo')
        ->join('Producto_imagen', 'Producto.id', 'producto_id')
        ->join('Imagen', 'Imagen.id', 'imagen_id')
        ->join('Tipo', 'tipo_id', 'Tipo.id')
        ->where([
          ['venta', '=', 1],
          ['producto_id', '!=', $id],
          ['Producto_imagen.principal', '=', 1],
          ['Producto_imagen.deleted_at', '=', null]
        ])
        ->inRandomOrder()->limit(8)->get();

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
