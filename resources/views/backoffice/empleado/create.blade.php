@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section ('content')

  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="ibox-content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" method="post" action="{{ url('back/employee') }}">
             {{ csrf_field() }}
            <div class="form-group"><label>Email</label> <input type="email" placeholder="Correo" class="form-control" name="email"></div>
            <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre"></div>
            <div class="form-group"><label>Apellido</label> <input type="text" placeholder="Apellido" class="form-control" name="apellido"></div>
            <div class="form-group"><label>Télefono</label>
              <input type="text" placeholder="Télefono"  class="form-control" data-mask="(999)-9999-9999" name="telefono">
            </div>
            <div class="form-group"><label>Celular</label> <input type="text" placeholder="Celular" data-mask="(999)-9999-9999" class="form-control" name="celular"></div>
            <div class="form-group"><label>DUI</label> <input type="text" placeholder="DUI" data-mask="99999999-9" class="form-control" name="dui"></div>
            <div class="form-group"><label>NIT</label> <input type="text" placeholder="NIT" data-mask="9999-999999-999-9" class="form-control" name="nit"></div>
            <div class="form-group"><label>AFP</label> <input type="text" placeholder="AFP" data-mask="999999999999" class="form-control" name="afp"></div>
            <div class="form-group"><label class="control-label">Género</label>
              <br>
              <label class="checkbox-inline i-checks"> <input type="radio" value="1" name="genero">Masculino</label>
              <label class="checkbox-inline i-checks"> <input type="radio" value="2" name="genero">Femenino</label>
            </div>
            <div class="form-group">
              <label class="control-label">Rol</label>
              <select class="form-control m-b" name="rol">
                <option>Seleccione rol</option>
                @foreach ($roles as $key => $rol)
                  <option value="{{ $rol->id }}"> {{  $rol->nombre }} </option>
                @endforeach
              </select>
            </div>
            <div class="form-group" id="fecha_nacimiento">
                <label class="font-normal">Fecha nacimiento</label>
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="fecha_nacimiento" class="form-control" value="01-01-2000">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Dirección</label>
                  <textarea class="form-control" name="direccion"></textarea>
            </div>
            <div>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection

@section('cssExtras')
  <link href="{{ asset('backoffice/css/iCheck/custom.css')}}" rel="stylesheet">
  <link href="{{ asset('backoffice/css/datepicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('scriptsExtras')
  <script src="{{ asset('backoffice/js/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{ asset('backoffice/js/iCheck/icheck.min.js')}}"></script>
  <script>
      $(document).ready(function () {
          $('.i-checks').iCheck({
              radioClass: 'iradio_square-green',
          });
      });

    $('#fecha_nacimiento .input-group.date').datepicker({
        startView: 1,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
  </script>
@endsection
