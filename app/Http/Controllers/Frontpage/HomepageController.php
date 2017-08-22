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

    public function getTypeGrid($id, Request $request){

      $data['grid'] = Tipo::select(DB::raw('tipo.*, url,
            (SELECT count(producto.id) FROM Producto
              WHERE tipo_id = tipo.id ) AS productos'))
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->where('tipo.id', '=', $id)->first();
      $data['pagina'] = 'type';
      $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo')
        ->join('producto_imagen', 'producto.id', 'producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->where([
          ['venta', '=', 1],
          ['tipo_id', '=', $id]
        ])
        ->orderBy('producto.id', 'DESC')->paginate(15);
      $data['page_title'] = $data['grid']->nombre;

      return view('frontpage.grid.index', $data);

    }

    public function getTypeList($id, Request $request){

      $data['grid'] = Tipo::select(DB::raw('tipo.*, url,
            (SELECT count(producto.id) FROM Producto
              WHERE tipo_id = tipo.id ) AS productos'))
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->where('tipo.id', '=', $id)->first();
      $data['pagina'] = 'type';
      $data['productos'] = Producto::select('producto.*', 'imagen.url', 'tipo.nombre as tipo')
        ->join('producto_imagen', 'producto.id', 'producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->where([
          ['venta', '=', 1],
          ['tipo_id', '=', $id]
        ])
        ->orderBy('producto.id', 'DESC')->paginate(15);
      $data['page_title'] = $data['grid']->nombre;

      return view('frontpage.lista.index', $data);

    }

    public function getCategoryGrid($id, Request $request){

      $data['grid'] = Categoria::select(DB::raw('categoria.*, url,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON producto.id = producto_id
              WHERE (categoria_id = categoria.id) AND (producto_categoria.deleted_at IS NULL) ) as productos ')
        )->join('imagen', 'imagen.id', 'imagen_id')
        ->where('categoria.id', '=', $id)->first();
      $data['productos'] = Producto::select('producto.*', 'imagen.url', 'categoria.nombre as categoria', 'tipo.nombre as tipo')
        ->join('producto_imagen', 'producto.id', 'producto_imagen.producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('producto_categoria', 'producto.id', 'producto_categoria.producto_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->join('categoria', 'categoria_id', 'categoria.id')
        ->where([
          ['venta', '=', 1],
          ['categoria_id', '=', $id]
        ])
        ->orderBy('producto.id', 'DESC')->paginate(15);
      $data['pagina'] = 'category';
      $data['page_title'] = $data['grid']->nombre;

      return view('frontpage.grid.index', $data);

    }

    public function getCategoryList($id, Request $request){

      $data['grid'] = Categoria::select(DB::raw('categoria.*, url,
            (SELECT count(Producto_categoria.id) FROM Producto
              INNER JOIN Producto_categoria ON producto.id = producto_id
              WHERE (categoria_id = categoria.id) AND (producto_categoria.deleted_at IS NULL) ) as productos ')
        )->join('imagen', 'imagen.id', 'imagen_id')
        ->where('categoria.id', '=', $id)->first();
      $data['productos'] = Producto::select('producto.*', 'imagen.url', 'categoria.nombre as categoria', 'tipo.nombre as tipo')
        ->join('producto_imagen', 'producto.id', 'producto_imagen.producto_id')
        ->join('imagen', 'imagen.id', 'imagen_id')
        ->join('producto_categoria', 'producto.id', 'producto_categoria.producto_id')
        ->join('tipo', 'tipo_id', 'tipo.id')
        ->join('categoria', 'categoria_id', 'categoria.id')
        ->where([
          ['venta', '=', 1],
          ['categoria_id', '=', $id]
        ])
        ->orderBy('producto.id', 'DESC')->paginate(15);
      $data['pagina'] = 'category';
      $data['page_title'] = $data['grid']->nombre;

      return view('frontpage.lista.index', $data);

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
        ])->orderBy('principal', 'DESC')->limit(1)->get();
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
