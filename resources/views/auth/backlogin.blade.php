@extends('auth.sessionsLayout')

@section ('title') Login @stop

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
          <h1 class="logo-name">V</h1>
          </div>
          <h3>Bienvenido</h3>
          <p>Inicie sesion con sus credenciales.</p>
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <input type="email" class="form-control" placeholder="Correo" name="email" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>

          <div class="form-group">
              <div class="col-md-12">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                      </label>
                  </div>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-12">
                  <button type="submit" class="btn btn-block btn-flat btn-primary">
                      Iniciar sesión
                  </button>
              </div>
              <div class="col-md-12">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    <small>Recuperar contraseña</small>
                </a>
              </div>
          </div>
      </form>
      <p class="m-t"> <small>Valdez Mobile </small> </p>
    </div>
    </div>
@endsection
