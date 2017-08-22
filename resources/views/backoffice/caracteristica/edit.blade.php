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
        <form role="form" method="post" action="{{ url('back/detail/'. $caracteristica->id ) }}">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre" value="{{ $caracteristica->nombre }}"></div>
            <div>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection
