@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section ('content')

  @section('breadcrumb')
  @endsection
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="ibox-content">
          Bienvenido {{ Auth::user()->nombre . " " .  Auth::user()->apellido }}
      </div>
    </div>
  </div>


@endsection
