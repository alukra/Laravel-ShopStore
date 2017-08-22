@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section ('content')

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="ibox-content">
      <div class="table-responsive">
        <table id="tblcategoria" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categorias as $key => $categoria)
              <tr>
                <td><img src="{{ asset($categoria->url) }}" style="height:50px; width: 50px;"></td>
                <td>{{ $categoria->nombre }}</td>
                <td>
                  <a class="btn btn-default" href="{{ url('back/category/' .  $categoria->id . "/edit" ) }}"><i class="fa fa-pencil"></i></a>
                  @if ($categoria->estado == 1)
                    <a class="btn btn-primary" href="{{ url('back/category/' .  $categoria->id ) }}"><i class="fa fa-circle-o-notch"></i></a>
                    <a class="btn btn-danger" href="#" disabled><i class="fa fa-times"></i></a>
                  @else
                    <a class="btn btn-default" href="{{ url('back/category/' .  $categoria->id ) }}"><i class="fa fa-circle-o-notch"></i></a>
                    <a class="btn btn-danger" href="#"><i class="fa fa-times"></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <a href="{{ url('back/category/create') }}" class="btn btn-default">Nuevo</a>
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
    var tabla = $('#tblcategoria').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  </script>
@endsection
