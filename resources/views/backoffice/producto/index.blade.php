@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li class="active">
        <strong>{{ $page_title }}</strong>
    </li>
  @endsection

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="tblproducto" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>SKU</th>
              <th>Nombre</th>
              <td>Tipo producto</td>
              <td>Marca</td>
              <th>Precio</th>
              <th>Stock</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($productos as $key => $producto)
              <tr>
                <td>{{ $producto->sku }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->tipo }}</td>
                <td>{{ $producto->marca }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                  @if ($producto->venta == 1)
                    <span class="label label-primary">En venta</span>
                  @else
                    <span class="label label-default">No disponible</span>
                  @endif
                  @if ($producto->rated == 1)
                    <span class="label label-warning">Rated</span>
                  @endif
                  @if ($producto->liquidacion == 1)
                    <span class="label label-danger">Liquidacion</span>
                  @endif
                </td>
                <td>
                  <a class="btn btn-default" href="{{ url('back/product/' .  $producto->id . "/edit" ) }}"><i class="fa fa-pencil"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <a href="{{ url('back/product/create') }}" class="btn btn-default">Nuevo</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('cssExtras')
	<link rel="stylesheet" href="{{ asset('backoffice/css/dataTables/datatables.min.css')}}">
@endsection

@section('scriptsExtras')
	<script src="{{ asset('backoffice/js/dataTables/datatables.min.js')}}"></script>
	<script>
    //Datatable
    var tabla = $('#tblproducto').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
