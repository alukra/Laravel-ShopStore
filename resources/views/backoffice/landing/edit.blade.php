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
        <form role="form" method="post" action="{{ url('back/landing/'. $landing->id ) }}" enctype="multipart/form-data">
          <input name="_method" type="hidden" value="PUT">
        <div class="col-md-4">
          <div class="ibox-title">
            <h5>Imagenes actuales</h5>
          </div>
          <div class="ibox-content">
            <img src="{{ asset($celimg->url) }}" class="img-responsive">
            <br>

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

            <img src="{{ asset($tabimg->url) }}" class="img-responsive">
            <br>

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

            <img src="{{ asset($comimg->url) }}" class="img-responsive">
            <br>

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

            <img src="{{ asset($img2->url) }}" class="img-responsive">
            <br>

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
          </div>
        </div>
        <div class="col-md-8">
             {{ csrf_field() }}
            <div class="form-group"><label>Nombre de promoción</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre" value="{{ $landing->nombre }}"></div>
              <legend>Primera parte</legend>

              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txtp1" value="{{ $landing->txtp1 }}"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txts1p1" value="{{ $landing->txts1p1 }}"></div>
              <div class="form-group"><label>Texto General</label> <textarea name="txts2p1" class="form-control" rows="4" cols="80">{{ $landing->txts2p1 }} </textarea></div>

              <legend>Parte 2</legend>

              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txtp2" value="{{ $landing->txtp2 }}"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txts1p2" value="{{ $landing->txts1p2 }}"></div>
              <div class="form-group"><label>Texto General</label> <textarea name="txts2p2" class="form-control" rows="4" cols="80"> {{ $landing->txts2p2 }} </textarea></div>
            <div>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
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
