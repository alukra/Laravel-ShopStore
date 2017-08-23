@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section('breadcrumb')
  <li><a href="{{ url('back/detail') }}">Caracteristicas</a></li>
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
        <form role="form" method="post" action="{{ url('back/detail') }}">
             {{ csrf_field() }}
            <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre"></div>
            <div class="form-group"><label class="control-label">Caracteristica marcada</label>
              <br>
              <label class="checkbox-inline i-checks">Principal <input type="checkbox" name="principal"></label>
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
@endsection

@section('scriptsExtras')
  <script src="{{ asset('backoffice/js/iCheck/icheck.min.js')}}"></script>
  <script>
      $(document).ready(function () {
          $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
          });
      });
  </script>
@endsection
