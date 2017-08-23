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
        <table id="tbltipo" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tipos as $key => $tipo)
              <tr>
                <td><img src="{{ asset($tipo->url) }}" style="height:50px; width: 50px;"></td>
                <td>{{ $tipo->nombre }}</td>
                <td>
                  <a class="btn btn-default" href="{{ url('back/type-product/' .  $tipo->id . "/edit" ) }}"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-danger" href="#"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <a href="{{ url('back/type-product/create') }}" class="btn btn-default">Nuevo</a>
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
    var tabla = $('#tbltipo').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
