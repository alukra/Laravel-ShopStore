@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li><a href="{{ url('back/location') }}">Ubicaciones</a></li>
    <li class="active">
        <strong>{{ $page_title }}</strong>
    </li>
  @endsection

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
        <form role="form" method="post" action="{{ url('back/location') }}" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre"></div>
            <div class="form-group"><label>Latitud</label> <input type="text" placeholder="Latitud" class="form-control" name="coordx"></div>
            <div class="form-group"><label>Longitud</label> <input type="text" placeholder="Longitud" class="form-control" name="coordy"></div>
            <div class="form-group"><label>Latitud Mapa</label> <input type="text" placeholder="Latitud mapa" class="form-control" name="coordx_m"></div>
            <div class="form-group"><label>Longitud Mapa</label> <input type="text" placeholder="Longitud mapa" class="form-control" name="coordy_m"></div>
            <div class="form-group"><label>Dirección</label> <textarea name="direccion" rows="8" cols="80" class="form-control"></textarea></div>
            <div class="form-group"><label>Télefono</label>
              <input type="text" placeholder="Télefono"  class="form-control" data-mask="(999)-9999-9999" name="telefono">
            </div>
            <div class="form-group"><label>Horario: Lunes - Viernes</label>
              <input type="text" placeholder="horario"  class="form-control" data-mask="99:99-99:99" name="horario1">
            </div>
            <div class="form-group"><label>Horario: Sábado</label>
              <input type="text" placeholder="horario"  class="form-control" data-mask="99:99-99:99" name="horario2">
            </div>
            <div class="form-group"><label>Horario: Domingo</label>
              <input type="text" placeholder="horario"  class="form-control" data-mask="99:99-99:99" name="horario3">
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

@endsection

@section('scriptsExtras')

@endsection
