@extends('frontpage.layout')

@section ('title') Inicio @stop

@section('content')

  <!--=== Slider ===-->
  <div class="tp-banner-container">
    <div class="tp-banner">
      <ul>
        <!-- SLIDE -->
        <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 1">
          <!-- MAIN IMAGE -->
          <img src="{{ asset($slide1_img->url)}}"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

          <div class="tp-caption revolution-ch3 sft start"
          data-x="left"
          data-hoffset="0"
          data-y="100"
          data-speed="1500"
          data-start="500"
          data-easing="Back.easeInOut"
          data-endeasing="Power1.easeIn"
          data-endspeed="300">
           <span class="tituloUno">{{ $homepage->txt_ss1 }}</span><br>
          <strong style="color: yellow">{{ $homepage->txt_ts1 }}</strong>
        </div>

        <!-- LAYER -->
        <div class="tp-caption revolution-ch4 sft"
        data-x="left"
        data-hoffset="0"
        data-y="380"
        data-speed="1600"
        data-start="1800"
        data-easing="Power4.easeOut"
        data-endspeed="300"
        data-endeasing="Power1.easeIn"
        data-captionhidden="off"
        style="z-index: 6">
        <h3 style="color: white;"><i class="fa fa-credit-card fa-rotate-270"></i> Paga en cuotas &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-truck"></i> Envíos a todo el país</h3>
      </div>
    </li>
    <!-- END SLIDE -->

    <!-- SLIDE -->
    <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">
      <!-- MAIN IMAGE -->
      <img src="{{ asset($slide2_img->url)}}"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

      <div class="tp-caption revolution-ch3 sft start"
    	data-x="center"
    	data-hoffset="5"
    	data-y="130"
    	data-speed="1500"
    	data-start="500"
    	data-easing="Back.easeInOut"
    	data-endeasing="Power1.easeIn"
    	data-endspeed="300">
    	<span class="tituloDos">{{ $homepage->txt_ts2 }}</span><br>
    	<span class="subtituloUno">{{$homepage->txt_ss2}}</span>
    </div>

  </li>
  <!-- END SLIDE -->

  <!-- SLIDE -->
  <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 3">
  <!-- MAIN IMAGE -->
  <img src="{{ asset($slide3_img->url)}}"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

  <div class="tp-caption revolution-ch1 sft start"
	data-x="right"
	data-hoffset="5"
	data-y="130"
	data-speed="1500"
	data-start="500"
	data-easing="Back.easeInOut"
	data-endeasing="Power1.easeIn"
	data-endspeed="300">
	<strong>{{ $homepage->txt_ts3 }}</strong>
	</div>

	<!-- LAYER -->
	<div class="tp-caption revolution-ch3 sft"
	data-x="right"
	data-hoffset="0"
	data-y="250"
	data-speed="1400"
	data-start="2000"
	data-easing="Power4.easeOut"
	data-endspeed="300"
	data-endeasing="Power1.easeIn"
	data-captionhidden="off"
	style="z-index: 6">
	<span class="tituloTres">{{ $homepage->txt_ss3 }}</span>
	</div>

	<!-- LAYER -->
	<div class="tp-caption sft"
	data-x="right"
	data-hoffset="0"
	data-y="320"
	data-speed="1600"
	data-start="2800"
	data-easing="Power4.easeOut"
	data-endspeed="300"
	data-endeasing="Power1.easeIn"
	data-captionhidden="off"
	style="z-index: 6">
	<a href="{{ url('products/0/0/0') }}" class="btn-u btn-brd btn-brd-hover btn-u-light">Escoge la tuya</a>
	</div>
  </li>
  <!-- END SLIDE -->

  <!-- SLIDE -->
  <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 4">
  <!-- MAIN IMAGE -->
  <img src="{{ asset('frontpage/img/slider/servicio-de-reparacion.png')}}"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

  <div class="tp-caption revolution-ch3 sft start"
	data-x="left"
	data-hoffset="5"
	data-y="50"
	data-speed="1500"
	data-start="500"
	data-easing="Back.easeInOut"
	data-endeasing="Power1.easeIn"
	data-endspeed="300">
	<span class="tituloCuatro text-right">¿PROBLEMAS CON TU LAPTOP?</span>
</div>

<!-- LAYER -->
<div class="tp-caption revolution-ch1 sft fondoTrans"
data-x="left"
data-hoffset="-14"
data-y="110"
data-speed="1400"
data-start="2000"
data-easing="Power4.easeOut"
data-endspeed="300"
data-endeasing="Power1.easeIn"
data-captionhidden="off"
style="z-index: 6">
<span class="subtituloCuatro">—VISITA NUESTRO CENTRO<br>
TECNICO ESPECIALISTA—</span>
</div>

<!-- LAYER -->
<div class="tp-caption sft"
data-x="left"
data-hoffset="0"
data-y="390"
data-speed="1600"
data-start="2800"
data-easing="Power4.easeOut"
data-endspeed="300"
data-endeasing="Power1.easeIn"
data-captionhidden="off"
style="z-index: 6">
<a href="http://www.laptopsvaldez.com/" class="btn-u btn-brd btn-brd-hover btn-u-light" target="_blank">Reparaciones</a>
</div>
  </li>
  <!-- END SLIDE -->

  </ul>
  <div class="tp-bannertimer tp-bottom"></div>
  </div>
  </div>
  <!--=== End Slider ===-->

<!--=== Product Content ===-->
<div class="container content-md">
	<div class="heading heading-v1 margin-bottom-40">
		<h2>¿En qué te podemos asesorar?</h2>
	</div>

	<!--=== Illustration v2 ===-->
  @include('frontpage.homepage.tipoProducto')

  <br><br><br><br><br>

  @include('frontpage.homepage.categorias')


  </div>
  <!--=== End Product Content ===-->

  <div class="container">
    <!--=== Product Service ===-->
    <div class="row margin-bottom-60">
      <div class="col-md-4 product-service md-margin-bottom-30">
        <div class="product-service-heading">
          <i class="fa fa-wrench"></i>
        </div>
        <div class="product-service-in">
          <h3>Centró Técnico Especialista en Laptops</h3>
          <p class="text-justify">Nuestro Centro Técnico especialista es #1 en reparación de fallas a nivel de MICROELECTRÓNICA en El Salvador. Esos nos hace ÚNICOS.</p>
          <a href="http://www.laptopsvaldez.com/" target="_blank">+Leer más</a>
        </div>
      </div>
      <div class="col-md-4 product-service md-margin-bottom-30">
        <div class="product-service-heading">
          <i class="icon-earphones-alt"></i>
        </div>
        <div class="product-service-in">
          <h3>Servicio al CLiente</h3>
          <p class="text-justify">¿Necesitas cotizar ó más información de nuestros productos? Chatea con nosotros. Abajo a la derecha esta nuestro chat.</p>
          <a href="#">+Leer más</a>
        </div>
      </div>
      <div class="col-md-4 product-service">
        <div class="product-service-heading">
          <i class="icon-refresh"></i>
        </div>
        <div class="product-service-in">
          <h3>Garantia Extendida</h3>
          <p class="text-justify">Integer mattis lacinia felis vel molestie. Ut eu euismod erat, tincidunt pulvinar semper veliUt porta, leo...</p>
          <a href="#">+Leer más</a>
        </div>
      </div>
    </div><!--/end row-->
    <!--=== End Product Service ===-->

  </div><!--/end cotnainer-->

  <!--=== Collection Banner ===-->
  <div class="collection-banner" style="background-image: url({{ $banner_img->url }}) ">
    <div class="container">
      <div class="col-md-12 md-margin-bottom-50">
        <h2>{{ $homepage->txt_bt }}</h2>
        <p>{!! $homepage->txt_bs  !!}</p><br>
        <a href="#" class="btn-u btn-brd btn-brd-hover btn-u-light">Pidela Ya</a>
      </div>
    </div>
  </div>
  <!--=== End Collection Banner ===-->

  <!--=== Sponsors ===-->
	<div class="container content">
		<div class="heading heading-v1 margin-bottom-40">
			<h2>Nuestras Marcas</h2>
		</div>

		<ul class="list-inline owl-slider-v2">
			<li class="item first-child">
				<img src="{{ asset('frontpage/img/clients/07.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/11.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/03.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/01.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/08.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/09.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/10.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/12.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/04.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/05.png')}}" alt="">
			</li>
			<li class="item">
				<img src="{{ asset('frontpage/img/clients/06.png')}}" alt="">
			</li>
		</ul>
	</div>
	<!--=== End Sponsors ===-->

@endsection
