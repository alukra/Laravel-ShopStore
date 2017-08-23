@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li><a href="{{ url('back/landing') }}">Landing page</a></li>
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
        <form role="form" method="post" action="{{ url('back/landing') }}" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="form-group"><label>Nombre de promoción</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre"></div>
              <legend>Primera parte</legend>
              <div class="form-group">
                <label>Imágen Celular</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                  <div class="form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <span class="fileinput-filename"></span>
                  </div>
                  <span class="input-group-addon btn btn-default btn-file">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="celimg"/>
                  </span>
                  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
              <div class="form-group">
                <label>Imágen Tablet</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                  <div class="form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <span class="fileinput-filename"></span>
                  </div>
                  <span class="input-group-addon btn btn-default btn-file">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="tabimg"/>
                  </span>
                  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
              <div class="form-group">
                <label>Imágen Computadora</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                  <div class="form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <span class="fileinput-filename"></span>
                  </div>
                  <span class="input-group-addon btn btn-default btn-file">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="comimg"/>
                  </span>
                  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txtp1"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txts1p1"></div>
              <div class="form-group"><label>Texto General</label> <textarea name="txts2p1" class="form-control" rows="4" cols="80"></textarea></div>

              <legend>Parte 2</legend>
              <div class="form-group">
                <label>Imágen Principal</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                  <div class="form-control" data-trigger="fileinput">
                    <i class="glyphicon glyphicon-file fileinput-exists"></i>
                    <span class="fileinput-filename"></span>
                  </div>
                  <span class="input-group-addon btn btn-default btn-file">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="img2"/>
                  </span>
                  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txtp2"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txts1p2"></div>
              <div class="form-group"><label>Texto General</label> <textarea name="txts2p2" class="form-control" rows="4" cols="80"></textarea></div>
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
