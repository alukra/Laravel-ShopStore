@extends('frontpage.layout')

@section ('title') Registrar @stop

@section('content')
  <!--=== Breadcrumbs v4 ===-->
  <div class="breadcrumbs-v4">
    <div class="container">
      <span class="page-name">Registro</span>
      <ul class="breadcrumb-v4-in">
        <li><a href="{{ url('/')}}">Inicio</a></li>
        <li class="active">Registro</li>
      </ul>
    </div><!--/end container-->
  </div>
  <!--=== End Breadcrumbs v4 ===-->


  <div class="log-reg-v3 content-md margin-bottom-30">
    <div class="container">
      <div class="row">
        <div class="col-md-7 md-margin-bottom-50">
          <h2 class="welcome-title">Welcome to Unify</h2>
          <p>Suspendisse et tincidunt ipsum, et dignissim urna. Vestibulum nisl tortor, gravida at magna et, suscipit vehicula massa.</p><br>
          <div class="row margin-bottom-50">
            <div class="col-sm-4 md-margin-bottom-20">
              <div class="site-statistics">
                <span>20,039</span>
                <small>Products</small>
              </div>
            </div>
            <div class="col-sm-4 md-margin-bottom-20">
              <div class="site-statistics">
                <span>54,283</span>
                <small>Reviews</small>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="site-statistics">
                <span>376k</span>
                <small>Sale</small>
              </div>
            </div>
          </div>
          <div class="members-number">
            <h3>Join more than <span class="shop-green">13,000</span> members worldwide</h3>
            <img class="img-responsive" src="assets/img/map.png" alt="">
          </div>
        </div>

        <div class="col-md-5">
          <form id="sky-form4" class="log-reg-block sky-form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <h2>Crear nueva cuenta</h2>
            <div class="login-input reg-input">
              <div class="row">
                <div class="col-sm-6">
                  <section class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label class="input">
                      <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autofocus>
                    </label>
                    @if ($errors->has('nombre'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                      </span>
                    @endif
                  </section>
                </div>
                <div class="col-sm-6">
                  <section class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                    <label class="input">
                      <input id="apellido" placeholder="Apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required>
                    </label>
                    @if ($errors->has('apellido'))
                      <span class="help-block">
                        <strong>{{ $errors->first('apellido') }}</strong>
                      </span>
                    @endif
                  </section>
                </div>
              </div>

              <section class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="input">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required>
                </label>
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </section>
              <section class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="input">
                  <input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
                </label>
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </section>
              <section>
                <label class="input">
                  <input id="password-confirm" type="password" class="form-control" placeholder="Repetir contraseña" name="password_confirmation" required>
                </label>
              </section>
            </div>

            <label class="checkbox margin-bottom-10">
              <input type="checkbox" name="checkbox"/>
              <i></i>
              Suscribirse a boletines
            </label>
            <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Crear cuenta</button>
          </form>

          <div class="margin-bottom-20"></div>
          <p class="text-center">¿Posees una cuenta? <a href="{{ url('/login') }}">Iniciar sesión</a></p>
        </div>
      </div><!--/end row-->
    </div><!--/end container-->
  </div>
  <!--=== End Registre ===-->

@endsection
