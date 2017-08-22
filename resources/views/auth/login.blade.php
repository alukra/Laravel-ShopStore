@extends('frontpage.layout')

@section ('title') Login @stop

@section('content')

  <!--=== Breadcrumbs v4 ===-->
  <div class="breadcrumbs-v4">
    <div class="container">
      <span class="page-name">Login</span>
      <ul class="breadcrumb-v4-in">
        <li><a href="{{ url('/')}}">Inicio</a></li>
        <li class="active">Log In</li>
      </ul>
    </div><!--/end container-->
  </div>
  <!--=== End Breadcrumbs v4 ===-->

  <!--=== Login ===-->
  <div class="log-reg-v3 content-md">
    <div class="container">
      <div class="row">
        <div class="col-md-7 md-margin-bottom-50">
          <h2 class="welcome-title">Welcome to Unify</h2>
          <p>Suspendisse et tincidunt ipsum, et dignissim urna. Vestibulum nisl tortor, gravida at magna et, suscipit vehicula massa.</p><br>
          <div class="info-block-v2">
            <i class="icon icon-layers"></i>
            <div class="info-block-in">
              <h3>Pellentesque vulputate</h3>
              <p>Vestibulum non ex volutpat, sodales diam sit amet, semper nunc. Integer sed nibh commodo, tincidunt nisi.</p>
            </div>
          </div>
          <div class="info-block-v2">
            <i class="icon icon-settings"></i>
            <div class="info-block-in">
              <h3>Curabitur tincidunt</h3>
              <p>Vestibulum non ex volutpat, sodales diam sit amet, semper nunc. Integer sed nibh commodo, tincidunt nisi.</p>
            </div>
          </div>
          <div class="info-block-v2">
            <i class="icon icon-paper-plane"></i>
            <div class="info-block-in">
              <h3>Aenean condimentum</h3>
              <p>Vestibulum non ex volutpat, sodales diam sit amet, semper nunc. Integer sed nibh commodo, tincidunt nisi.</p>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <form class="form-horizontal" method="POST" action="{{ route('login') }}" id="sky-form1" class="log-reg-block sky-form">
            {{ csrf_field() }}
            <h2>Iniciar sesión con su cuenta</h2>

            <section class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="input login-input">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="email" class="form-control" placeholder="Correo" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </label>
            </section>
            <section class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="input login-input no-border-top">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </label>
            </section>
            <div class="row margin-bottom-5">
              <div class="col-xs-6">
                <label class="checkbox">
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                  <i></i>
                  Remember me
                </label>
              </div>
              <div class="col-xs-6 text-right">
                <a href="{{ route('password.request') }}">Recordar contraseña</a>
              </div>
            </div>
            <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Iniciar sesión</button>

          </form>

          <div class="margin-bottom-20"></div>
          <p class="text-center">No tienes cuenta <a href="{{ url('/register') }}">Registrarse</a></p>
        </div>
      </div><!--/end row-->
    </div><!--/end container-->
  </div>
  <!--=== End Login ===-->
@endsection
