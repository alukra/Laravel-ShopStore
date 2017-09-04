@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li><a href="{{ url('back/homepage') }}">homepage page</a></li>
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
        <form role="form" method="post" action="{{ url('back/homepage/'. $homepage->id ) }}" enctype="multipart/form-data">
          <input name="_method" type="hidden" value="PUT">
        <div class="col-md-4">
          <div class="ibox-title">
            <h5>Imagenes actuales</h5>
          </div>
          <div class="ibox-content">
            <img src="{{ asset($slide1_img->url) }}" class="img-responsive">
            <br>

            <div class="form-group">
              <label>Slide1</label>
              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                <div class="form-control" data-trigger="fileinput">
                  <i class="glyphicon glyphicon-file fileinput-exists"></i>
                  <span class="fileinput-filename"></span>
                </div>
                <span class="input-group-addon btn btn-default btn-file">
                  <span class="fileinput-new">Select file</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="slide1_img"/>
                </span>
                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>

            <img src="{{ asset($slide2_img->url) }}" class="img-responsive">
            <br>

            <div class="form-group">
              <label>Slide 2</label>
              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                <div class="form-control" data-trigger="fileinput">
                  <i class="glyphicon glyphicon-file fileinput-exists"></i>
                  <span class="fileinput-filename"></span>
                </div>
                <span class="input-group-addon btn btn-default btn-file">
                  <span class="fileinput-new">Select file</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="slide2_img"/>
                </span>
                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>

            <img src="{{ asset($slide3_img->url) }}" class="img-responsive">
            <br>

            <div class="form-group">
              <label>Slide 3</label>
              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                <div class="form-control" data-trigger="fileinput">
                  <i class="glyphicon glyphicon-file fileinput-exists"></i>
                  <span class="fileinput-filename"></span>
                </div>
                <span class="input-group-addon btn btn-default btn-file">
                  <span class="fileinput-new">Select file</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="slide3_img"/>
                </span>
                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>

            <img src="{{ asset($banner_img->url) }}" class="img-responsive">
            <br>

            <div class="form-group">
              <label>Banner</label>
              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                <div class="form-control" data-trigger="fileinput">
                  <i class="glyphicon glyphicon-file fileinput-exists"></i>
                  <span class="fileinput-filename"></span>
                </div>
                <span class="input-group-addon btn btn-default btn-file">
                  <span class="fileinput-new">Select file</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="banner_img"/>
                </span>
                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
             {{ csrf_field() }}
              <legend>Slide 1</legend>

              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ts1" value="{{ $homepage->txt_ts1 }}"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ss1" value="{{ $homepage->txt_ss1 }}"></div>

              <legend>Slide 1</legend>

              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ts2" value="{{ $homepage->txt_ts2 }}"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ss2" value="{{ $homepage->txt_ss2 }}"></div>
              <legend>Slide 1</legend>

              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ts3" value="{{ $homepage->txt_ts3 }}"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ss3" value="{{ $homepage->txt_ss3 }}"></div>
              <legend>Slide 1</legend>

              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_bt" value="{{ $homepage->txt_bt }}"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_bs" value="{{ $homepage->txt_bs }}"></div>
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
