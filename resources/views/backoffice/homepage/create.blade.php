@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li><a href="{{ url('back/homepage') }}">Homepage List</a></li>
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
        <form role="form" method="post" action="{{ url('back/homepage') }}" enctype="multipart/form-data">
             {{ csrf_field() }}

             <legend>Sliders</legend>
              <div class="form-group">
                <label>Slide 1</label>
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
              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ts1"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ss1"></div>

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
              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ts2"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ss2"></div>


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
              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ts3"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_ss3"></div>

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
              <div class="form-group"><label>Texto Principal</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_bt"></div>
              <div class="form-group"><label>Texto subtitulo</label> <input type="text" placeholder="Texto principal" class="form-control" name="txt_bs"></div>

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
