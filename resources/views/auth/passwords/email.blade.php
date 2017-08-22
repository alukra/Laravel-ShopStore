@extends('auth.sessionsLayout')

@section ('title') Recuperar contraseña @stop

@section('content')
<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox-content">
                <h2 class="font-bold">Recuperar contraseña</h2>
                <p>
                    Escribe tu correo, se te enviará un correo de reinicio.
                </p>
                  <div class="row">

                    <div class="col-lg-12">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar enlace
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <hr/>
  <div class="row">
      <div class="col-md-6">
          Valdez mobile
      </div>
      <div class="col-md-6 text-right">
         <small>2017</small>
      </div>
  </div>
</div>
@endsection
