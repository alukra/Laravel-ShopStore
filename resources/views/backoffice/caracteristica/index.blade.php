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
        <table id="tblcaracteristica" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Principal</th>
              <th>Orden</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($caracteristicas as $key => $caracteristica)
              <tr>
                <td>{{ $caracteristica->nombre }}</td>
                <td>
                  @if ($caracteristica->principal == 1)
                    Caracteristica marcada
                  @else
                    -
                  @endif
                </td>
                <td>{{ $caracteristica->orden }}</td>
                <td>
                  <a class="btn btn-default" href="{{ url('back/detail/' .  $caracteristica->id . "/edit" ) }}"><i class="fa fa-pencil"></i></a>
                  @if ($caracteristica->estado == 1)
                    <a class="btn btn-primary" href="{{ url('back/detail/' .  $caracteristica->id ) }}"><i class="fa fa-circle-o-notch"></i></a>
                  @else
                    <a class="btn btn-default" href="{{ url('back/detail/' .  $caracteristica->id ) }}"><i class="fa fa-circle-o-notch"></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <a href="{{ url('back/detail/create') }}" class="btn btn-default">Nuevo</a>
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
    var tabla = $('#tblcaracteristica').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [[ 2, "asc" ]]
    });
  </script>
@endsection
