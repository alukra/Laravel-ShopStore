@extends('frontpage.layout')

@section ('title') {{ $page_title }} @stop

@section('content')

  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1508198729191525',
        xfbml      : true,
        version    : 'v2.8'
      });
      FB.AppEvents.logPageView();
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>

  <div class="shop-product">
    <!-- Breadcrumbs v5 -->
    <div class="container">
      <ul class="breadcrumb-v5">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li>Productos</li>
        <li class="active">{{ $page_title }}</li>
      </ul>
    </div>
    <!-- End Breadcrumbs v5 -->

    <div class="container">
      <div class="row">

        <div class="col-md-6 md-margin-bottom-50">
          <div class="ms-showcase2-template">
            <!-- Master Slider -->
            <div class="master-slider ms-skin-default" id="masterslider">
              @foreach ($imagenes as $key => $imagen)
                <div class="ms-slide">
                  <img class="ms-brd" src="{{ asset( $imagen->url ) }}" data-src="{{ asset( $imagen->url ) }}" alt="Images">
                  <img class="ms-thumb" src="{{ asset( $imagen->url ) }}" alt="thumb">
                </div>
              @endforeach
            </div>
            <!-- End Master Slider -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="shop-product-heading">
            <img src="{{ asset($marca->url) }}" width="100px" align="left">
            <h2> {{ $producto->nombre }}</h2>
            {{-- <ul class="list-inline shop-product-social">
              <li><a href="#" title="Conmparte"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#" title="Conmparte"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#" title="Conmparte"><i class="fa fa-instagram"></i></a></li>
            </ul> --}}
          </div><!--/end shop product social-->

          <ul class="list-inline product-ratings margin-bottom-30">
            <li><i class="rating-selected fa fa-star"></i></li>
            <li><i class="rating-selected fa fa-star"></i></li>
            <li><i class="rating-selected fa fa-star"></i></li>
            <li><i class="rating-selected fa fa-star"></i></li>
            <li><i class="rating fa fa-star"></i></li>
            {{-- <li class="product-review-list">
              <span><a href="#comment">Comentarios</a> | <a href="#detail"> Datos</a></span>
            </li> --}}
          </ul><!--/end shop product ratings-->

          @foreach ($caracteristicas_p as $key => $cp)
            <p>
              <strong>{{ $cp->nombre }}:</strong> {{ $cp->descripcion }}
            </p>
          @endforeach

          <ul class="list-inline shop-product-prices margin-bottom-30">
            @if ($producto->liquidacion == 1)
              <li class="shop-red">${{ $producto->precio_promocion }}</li>
              <li class="line-through">${{ $producto->precio }}</li>
            @else
              <li class="shop-red">${{ $producto->precio }}</li>
            @endif
          </ul><!--/end shop product prices-->

          <h3 class="shop-product-title">Sucursal</h3>
          <ul class="list-inline product-size margin-bottom-30">
            <li>
              <input type="radio" id="size-1" name="size">
              <label for="size-1" title="Merliot">Me</label>
            </li>
            <li>
              <input type="radio" id="size-2" name="size">
              <label for="size-2" title="Escalón">Es</label>
            </li>
            <li>
              <input type="radio" id="size-3" name="size" checked>
              <label for="size-3" title="San Miguel">SM</label>
            </li>
            <li>
              <input type="radio" id="size-4" name="size">
              <label for="size-4" title="Santa Ana">SA</label>
            </li>
          </ul><!--/end product size-->

          {{-- <h3 class="shop-product-title">Cantidad</h3>
          <div class="margin-bottom-40">
            <form name="f1" class="product-quantity sm-margin-bottom-20">
              <button type='button' class="quantity-button" name='subtract' onclick='javascript: subtractQty();' value='-'>-</button>
              <input type='text' class="quantity-field" name='qty' value="1" id='qty'/>
              <button type='button' class="quantity-button" name='add' onclick='javascript: document.getElementById("qty").value++;' value='+'>+</button>
            </form>
            <button type="button" class="btn-u btn-u-sea-shop btn-u-lg">Agregar a Cotización</button>
          </div><!--/end product quantity-->

          <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
            <li class="wishlist-in">
              <i class="fa fa-heart"></i>
              <a href="#">Agregar a Lista de Deseos</a>
            </li>
            <li class="compare-in">
              <i class="fa fa-exchange"></i>
              <a href="#">Comparar</a>
            </li>
          </ul> --}}
          <p class="wishlist-category"><strong>Categorias:</strong>
            @foreach ($categorias as $key => $categoria)
              <a href="{{ url('products/0/'. $categoria->id . '/0' ) }}">{{ $categoria->nombre }} </a>
            @endforeach
          </p>
        </div>
      </div><!--/end row-->
    </div>
  </div>

  <!--=== Content Medium ===-->
  <div class="content-md container">
    <!--=== Product Service ===-->
  <div class="row margin-bottom-60">
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
        <p class="text-justify">Integer mattis lacinia felis vel molestie. Ut eu euismod erat, tincidunt pulvinar semper veliUt porta.</p>
        <a href="#">+Leer más</a>
      </div>
    </div>
  </div>
  </div><!--/end row-->
  <!--=== End Product Service ===-->

    <div class="tab-v6">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#description" role="tab" data-toggle="tab">Reseña</a></li>
        <li><a href="#reviews" role="tab" data-toggle="tab">(1)Comentarios</a></li>
      </ul>

      <div class="tab-content">
        <!-- Description -->
        <div class="tab-pane fade in active" id="description">
          <div class="row">
            <div class="col-md-12">
              <p>{{ $producto->descripcion }}</p><br>

              <h3 class="heading-md margin-bottom-20">ESPECIFICACIONES</h3>
              <div class="row">
                <div class="col-sm-12">
                  <ul class="list-unstyled specifies-list" style="ul {-webkit-column-count: 2;  -moz-column-count: 3;  column-count: 3;}">
                    @foreach ($caracteristicas as $key => $caracteristica)
                      <li><i class="fa fa-caret-right"></i>{{ $caracteristica->nombre }}: <span> {{ $caracteristica->descripcion }}</span></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Description -->

        <!-- Reviews -->
        <div class="tab-pane fade" id="reviews">
          <div class="fb-comments" data-href="http://www.tepla.org/single_post.php" data-width="100%" data-numposts="5"></div>
        </div>
        <!-- End Reviews -->
      </div>
    </div>
  </div><!--/end container-->
  <!--=== End Content Medium ===-->

  <!--=== Illustration v2 ===-->
  <div class="container">
    <div class="heading heading-v1 margin-bottom-20">
      <h2>Productos Recomendados</h2>
      <p>Los clientes que compraron este producto también compraron estos otros articulos:</p>
    </div>

    <div class="illustration-v2 margin-bottom-60">
      <div class="customNavigation margin-bottom-25">
        <a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
        <a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
      </div>

      <ul class="list-inline owl-slider">
        @foreach ($productos as $key => $prod)
          <li class="item">
            <div class="product-img">
              <a href="{{ url('product-detail/' . $prod->id ) }}"><img class="full-width img-responsive" src="{{ asset($prod->url)}}" style="width: 300px; height:250px;"></a>
              <a class="product-review" href="{{ url('product-detail/' . $prod->id ) }}">Vista rapida</a>
              <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>Agregar a cotización</a>
            </div>
            <div class="product-description product-description-brd">
              <div class="overflow-h margin-bottom-5">
                <div class="pull-left">
                  <h4 class="title-price"><a href="{{ url('product-detail/' . $prod->id ) }}"> {{$prod->nombre}} </a></h4>
                  <span class="gender text-uppercase">{{ $prod->tipo}}</span>
                </div>
                <div class="product-price">
                  <span class="title-price">
                    @if ($prod->liquidacion == 1)
                      <del class="text-danger">$ {{ $prod->precio }}</del>
                      $ {{ $prod->precio_promocion }}
                    @else
                      $ {{ $prod->precio }}
                    @endif
                  </span>
                </div>
              </div>
              <ul class="list-inline product-ratings">
                <li><i class="rating-selected fa fa-star"></i></li>
                <li><i class="rating-selected fa fa-star"></i></li>
                <li><i class="rating-selected fa fa-star"></i></li>
                <li><i class="rating-selected fa fa-star"></i></li>
                <li><i class="rating-selected fa fa-star"></i></li>
                <li class="like-icon"><a data-original-title="Add to wishlist" data-toggle="tooltip" data-placement="left" class="tooltips" href="#"><i class="fa fa-heart"></i></a></li>
              </ul>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!--=== End Illustration v2 ===-->

@endsection

@section('cssExtras')
	<link rel="stylesheet" href="{{ asset('frontpage/plugins/master-slider/masterslider/style/masterslider.css')}}">
	<link rel='stylesheet' href="{{ asset('frontpage/plugins/master-slider/masterslider/skins/default/style.css')}}">
@endsection

@section('scriptsExtras')
  <!-- Master Slider -->
  <script src="{{ asset('frontpage/plugins/master-slider/masterslider/masterslider.min.js')}}"></script>
  <script src="{{ asset('frontpage/plugins/master-slider/masterslider/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('frontpage/js/plugins/master-slider.js')}}"></script>
  <script src="{{ asset('frontpage/js/forms/product-quantity.js')}}"></script>
  <script>
  		jQuery(document).ready(function() {
  			App.init();
  			App.initScrollBar();
  			StyleSwitcher.initStyleSwitcher();
  			MasterSliderShowcase2.initMasterSliderShowcase2();
  		});
  </script>
@endsection
