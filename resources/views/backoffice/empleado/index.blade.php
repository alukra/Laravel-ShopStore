@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="tblempleado" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Rol</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($empleados as $key => $empleado)
              <tr>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->rol }}</td>
                <td>{{ $empleado->telefono }}</td>
                <td>{{ $empleado->email }}</td>
                <td>
                  <a class="btn btn-default" href="{{ url('back/employee/' .  $empleado->id . "/edit" ) }}"><i class="fa fa-pencil"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <a href="{{ url('back/employee/create') }}" class="btn btn-default">Nuevo</a>
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
    var tabla = $('#tblempleado').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
