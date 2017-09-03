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
                  <form action="{{ url('back/employee/' . $empleado->id ) }}" method="post">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" name="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </form>
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
