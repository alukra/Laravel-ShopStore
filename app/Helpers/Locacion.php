<?php 

  namespace App\Helpers;

  //-----------------------------------------------------
  // Helper para el uso rápido de funciones
  // 
  use DB;
  use App\Models\Ciudad;
  use App\Models\Departamento;
  use App\Models\Pais;
  use App\Models\Region;

  class Locacion {
    
    public static function getPais($id = null){
      if ($id == null) {
        $pais = Pais::orderBy('nombre', 'asc')
                  ->get();
      }else{
        $pais = Pais::where('id', $id)
                  ->orderBy('nombre', 'asc')
                  ->get();
      }
      return $pais;
    }

    public static function getDepartamentosByPais($id){
      $departamentos = Departamento::where('pais_id', $id)
                          ->orWhere('id', 1)
                          ->orderByRaw("id= 1 DESC, nombre ASC")
                          ->get();
      return $departamentos;
    }

    public static function getCiudadesByDepartamento($id){
      $ciudad = Ciudad::where('departamento_id', $id)
                          ->orWhere('id', 1)
                          ->orderByRaw("id= 1 DESC, nombre ASC")
                          ->get();
      return $ciudad;
    }

    //Obsoleta debo cambiarla
    public static function getAllByCiudad($ciudad_id){
      return $datos = Ciudad::select(
              'ciudad.id as ciudad_id', 'ciudad.nombre as ciudad_nombre',
              'departamento.id as departamento_id', 'departamento.nombre as departamento_nombre',
              'pais.id as pais_id', 'pais.nombre as pais_nombre',
              'region.id as region_id', 'region.nombre as region_nombre' 
          )
          ->join('departamento', 'departamento.id', '=', 'ciudad.departamento_id')
          ->join('pais', 'pais.id', '=', 'departamento.pais_id')
          ->join('departamento_region', 'departamento_region.departamento_id', '=', 'departamento.id')
          ->join('region', 'departamento_region.region_id', '=', 'region.id')
          ->where('ciudad.id', $ciudad_id)
          ->first();
    }

    public static function getAllData($pais_id, $departamento_id, $ciudad_id){
      $datos = DB::select("SELECT nombre AS pais_nombre, 
        (SELECT nombre FROM departamento WHERE id = ? ) AS departamento_nombre,
        (SELECT nombre FROM ciudad WHERE id= ? ) AS ciudad_nombre,
        (SELECT region.nombre FROM region 
          INNER JOIN departamento_region ON region_id = region.id
          INNER JOIN departamento ON departamento_id = departamento.id
          WHERE departamento.id = ?) AS region_nombre
        FROM pais WHERE id = ?", [ $departamento_id, $ciudad_id, $departamento_id, $pais_id] );
      return $datos[0];
    }
    
  }
    

?>