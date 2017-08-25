<?php use Illuminate\Support\Facades\Auth; ?>
<div class="header-v5 header-static">
	<!-- Topbar v3 -->
	<div class="topbar-v3">
		<div class="search-open">
			<div class="container">
				<input type="text" class="form-control" placeholder="Buscar">
				<div class="search-close"><i class="icon-close"></i></div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<!-- Topbar Navigation -->
					<ul class="left-topbar">
						{{-- <li>
							<a>MONEDA (USD)</a>
							<ul class="currency">
								<li class="active">
									<a href="#">USD <i class="fa fa-check"></i></a>
								</li>
								<li><a href="#">Cordobas</a></li>
								<li><a href="#">Lempiras</a></li>
							</ul>
						</li>
						<li>
							<a>Idioma (ES)</a>
							<ul class="language">
								<li>
									<a href="#">English (EN)</a>
								</li>
								<li class="active"><a href="#">Spanish (SPN)<i class="fa fa-check"></i></a></li>
								<li><a href="#">German (GRM)</a></li>
							</ul>
						</li> --}}
						<li><a href="{{ url('location/1')}}">Merliot</a></li>
						<li><a href="{{ url('location/2')}}">Escalón</a></li>
						<li><a href="{{ url('location/3')}}">San Miguel</a></li>
					</ul><!--/end left-topbar-->
				</div>
				<div class="col-sm-6">
					<ul class="list-inline right-topbar pull-right">
            {{-- <li><a href="shop-ui-add-to-cart.html">Cotizaciones (0)</a></li> --}}
            @if (Auth::check() )
              <li><a href="{{ url('profile') }}">Cuenta</a></li>
              <li><a href="#" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">Logout</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 {{ csrf_field() }}
              </form>
            @else
              <li><a href="{{ url('login') }}">Login</a></li>
            @endif
					</ul>
				</div>
			</div>
		</div><!--/container-->
	</div>
	<!-- End Topbar v3 -->

	<!-- Navbar -->
	<div class="navbar navbar-default mega-menu" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">
					<img id="logo-header" src="{{ asset('frontpage/img/valdezMobileLogo.svg')}}" alt="Logo">
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-responsive-collapse">
				<!-- Nav Menu -->
				<ul class="nav navbar-nav">
					<!-- Pages -->
					<li class="dropdown active">
						<a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
							Inicio
						</a>
						<ul class="dropdown-menu">
							<li class="active"><a href="{{ url('/') }}">Inicio</a></li>
							<li><a href="{{ url('/#teAsesoramos') }}">Te Asesoramos</a></li>
							<li><a href="{{ url('/#destacados')}}">Productos Destacados</a></li>
							<li><a href="{{ url('/#mejorCalificacion')}}">Mejor Calificación</a></li>
						</ul>
					</li>
					<!-- End Pages -->

					<!-- Gifts -->
					<li class="dropdown mega-menu-fullwidth">
						<a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
							Promociones
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="mega-menu-content">
									<div class="container">
										<div class="row">
											<div class="col-md-3 col-sm-12 col-xs-12 md-margin-bottom-30">
												<h3 class="mega-menu-heading text-center">Participa y Gana</h3>
												<p class="text-justify">Sigue nuestros #TRENDING Topics en nuestras redes sociales, participa en increibles descuentos y rifas de equipos, semana tras semana, liquidación tras liquidación.</p>
												<button type="button" class="btn-u btn-u-dark">Leer Más</button>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 md-margin-bottom-30">
												<a href="{{ url('/news') }}" target="_blank"><img class="product-offers img-responsive" src="{{ asset('frontpage/img/blog/01.jpg') }}" alt=""></a>
											</div>
										</div><!--/end row-->
									</div><!--/end container-->
								</div><!--/end mega menu content-->
							</li>
						</ul><!--/end dropdown-menu-->
					</li>
					<!-- End Gifts -->

					<!-- Books -->
					<li class="dropdown mega-menu-fullwidth">
						<a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
							Productos
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="mega-menu-content">
									<div class="container">
										<div class="row">

											<?php use App\Services\NavbarMarcas; ?>
					            {!! NavbarMarcas::create() !!}

											<div class="col-md-4 col-sm-6">
												<h3 class="mega-menu-heading"><i class="fa fa-wrench fa-fw"></i> Servicios</h3>
												<ul class="list-unstyled style-list">
													<li><a href="http://www.laptopsvaldez.com/reparacion-de-laptops" target="_blank">Reparación de Laptops</a></li>
													<li><a href="http://www.laptopsvaldez.com/recuperacion-de-datos" target="_blank">Recuperación de Datos</a></li>
													<li><a href="http://www.laptopsvaldez.com/reparacion-iPhone-galaxy" target="_blank">Reparación de Celulares</a></li>
												</ul>
												<!-- <h3 class="mega-menu-heading">Accessorios</h3>
												<ul class="list-unstyled style-list">
													<li><a href="">Bagpack</a></li>
													<li><a href="">Cell Phone Accessories</a></li>
													<li><a href="">Tablet Accessories</a></li>
													<li><a href="">Kit de Limpieza</a></li>
												</ul> -->
											</div>

										</div><!--/end row-->
									</div><!--/end container-->
								</div><!--/end mega menu content-->
							</li>
						</ul><!--/end dropdown-menu-->
					</li>
					<!-- End Books -->

					<!-- Promotion -->
					<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
							Ubicaciones
						</a>
						<ul class="dropdown-menu">
									<li><a href="{{ url('location/1')}}">Merliot</a></li>
									<li><a href="{{ url('location/2')}}">Escalón</a></li>
									<li><a href="{{ url('location/3')}}">San Miguel</a></li>
						</ul>
					</li>
					<!-- End Promotion -->

				</ul>
				<!-- End Nav Menu -->
			</div>
		</div>
	</div>
	<!-- End Navbar -->
</div>
