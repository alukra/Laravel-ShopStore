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

use App\Models\Producto_categoria;
use App\Models\Producto_caracteristica;
use App\Models\Producto_imagen;
use App\Models\Imagen;


class ProductoDetallesController extends Controller
{
    public function storeCategory($id, Request $request){

        $this->validate($request, [
          'categoria' => 'required',
        ]);

        $revision = Producto_categoria::where([
            ['producto_id','=', $id],
            ['categoria_id', '=', $request->categoria],
        ])->first();

        if ( $revision == null ) {
          $prcat = new Producto_categoria();
          $prcat->producto_id = $id;
          $prcat->categoria_id = $request->categoria;
          $prcat->save();
        }

        return redirect('back/product/'. $id . "/edit");
    }

    public function destroyCategory($id, $categoria, Request $request ){
      $prcat = Producto_categoria::where([
          ['producto_id','=', $id],
          ['categoria_id', '=', $categoria],
      ])->first();
      $prcat->delete();

      return redirect('back/product/'. $id . "/edit");
    }

    public function storeDetail($id, Request $request){

        $this->validate($request, [
          'caracteristica' => 'required',
          'descripcion' => 'max:200|required',
        ]);

        $revision = Producto_caracteristica::where([
            ['producto_id','=', $id],
            ['caracteristica_id', '=', $request->caracteristica],
        ])->first();

        if ( $revision == null ) {
          $prcat = new Producto_caracteristica();
          $prcat->producto_id = $id;
          $prcat->descripcion = $request->descripcion;
          $prcat->caracteristica_id = $request->caracteristica;
          $prcat->save();
        }

        return redirect('back/product/'. $id . "/edit");
    }

    public function destroyDetail($id, $caracteristica, Request $request ){
      $prcat = Producto_caracteristica::where([
          ['producto_id','=', $id],
          ['caracteristica_id', '=', $caracteristica],
      ])->first();
      $prcat->delete();

      return redirect('back/product/'. $id . "/edit");
    }

    public function storeImage($id, Request $request){

        $this->validate($request, [
          'imagen' => 'image|required',
        ]);

        //Inicio de las inserciones en la base de datos
        DB::beginTransaction();
          try {
          $url = 'images/producto/'. $id;
          $imageName = $id. 'img' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
          $request->file('imagen')->move( base_path() . '/public/' . $url , $imageName );
          $imagen = new imagen();
          $imagen->url = $url . '/' . $imageName;
          $imagen->save();

          $primg = new Producto_imagen();
          $primg->producto_id = $id;
          $primg->imagen_id = $imagen->id;
          $primg->principal = 0;
          $primg->save();

        } catch (\Exception $e) {
          DB::rollback();
          throw $e;
        }
        DB::commit();
        return redirect('back/product/'. $id . "/edit");
    }

    public function destroyImage($id, $imagen, Request $request ){
      $primg = Producto_imagen::where([
          ['producto_id','=', $id],
          ['imagen_id', '=', $imagen],
      ])->first();
      $primg->delete();

      return redirect('back/product/'. $id . "/edit");
    }

    public function updateImage($id, $imagen, Request $request){
      Producto_imagen::where('producto_id', '=', $id)->update(['principal' => 0]);

      $primg = Producto_imagen::where([
          ['producto_id','=', $id],
          ['imagen_id', '=', $imagen],
      ])->first();
      $primg->principal = 1;
      $primg->save();

      return redirect('back/product/'. $id . "/edit");
    }

}
