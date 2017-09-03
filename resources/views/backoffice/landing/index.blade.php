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
        <table id="tbllanding" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Fecha Creación</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($landings as $key => $landing)
              <tr>
                <td>{{ $landing->nombre }}</td>
                <td>{{ $landing->created_at }}</td>
                <td>
                  @if ($landing->estado == 1)
                    <span class="label label-primary">Página Activa</span>
                  @else
                    <span class="label label-default">En edición</span>
                  @endif
                </td>
                <td>
                  <a class="btn btn-default" href="{{ url('back/landing/' .  $landing->id . "/edit" ) }}"><i class="fa fa-pencil"></i></a>
                  @if ($landing->estado == 1)
                    <a class="btn btn-primary btn-disable"><i class="fa fa-circle-o-notch"></i></a>
                  @else
                    <a class="btn btn-default" href="{{ url('back/landing/' .  $landing->id ) }}"><i class="fa fa-circle-o-notch"></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <a href="{{ url('back/landing/create') }}" class="btn btn-default">Nuevo</a>
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
    var tabla = $('#tbllanding').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
