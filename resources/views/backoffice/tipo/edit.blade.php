@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li><a href="{{ url('back/type-product') }}">Tipo de producto</a></li>
    <li class="active">
        <strong>{{ $page_title }}</strong>
    </li>
  @endsection

@section ('content')

  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <form role="form" method="post" action="{{ url('back/type-product/'. $tipo->id ) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

      <div class="col-md-4">
        <div class="ibox-title">
          <h5>Imagen actual</h5>
        </div>
        <div class="ibox-content">
          <img src="{{ asset($imagen->url) }}" class="img-responsive">

          <br>

          <div class="form-group">
            <label>Cambiar imagen</label>
            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
              <div class="form-control" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                <span class="fileinput-filename"></span>
              </div>
              <span class="input-group-addon btn btn-default btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="imagen"/>
              </span>
              <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8">
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
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre" value="{{ $tipo->nombre }}"></div>
            <div>
              <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </div>

      </div>
    </form>
  </div>
</div>
@endsection
