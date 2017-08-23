@extends('frontpage.layout')

@section ('title') {{ $page_title }} @stop

@section('content')
  <!--=== Breadcrumbs v4 ===-->
  <div class="breadcrumbs-v4">
    <div class="container">
      <span class="page-name">{{ $page_title }}</span>
      <h1>Pioneros en brindar tecnología</h1>
      <ul class="breadcrumb-v4-in">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('products/0/0/0') }}">Productos</a></li>
        <li class="active">{{ $page_title }}</li>
      </ul>
    </div><!--/end container-->
  </div>
  <!--=== End Breadcrumbs v4 ===-->

  <!--=== Content Part ===-->
  <div class="content container">
    <div class="row">

      @include('frontpage/filter')

      <div class="col-md-9">
        <div class="row margin-bottom-5">
          <div class="col-sm-4 result-category">
            <h2>Items</h2>
            <small class="shop-bg-red badge-results">{{ $grid['productos'] }} filtrados</small>
          </div>
          <div class="col-sm-8">
            <ul class="list-inline clear-both">
              <li class="grid-list-icons">
                <a href="{{ url('products/list/'. $grid['tipo'] . '/' . $grid['categoria']. '/' . $grid['marca']) }}"><i class="fa fa-th-list"></i></a>
                <a href="{{ url('products/'. $grid['tipo'] . '/' . $grid['categoria']. '/' . $grid['marca']) }}"><i class="fa fa-th"></i></a>
              </li>
            </ul>
          </div>
        </div><!--/end result category-->

        <div class="filter-results">
          <div class="row illustration-v2">
            @foreach ($productos as $key => $producto)
              <div class="col-md-4">
                <div class="product-img product-img-brd">
                  <a href="{{ url('product-detail/' . $producto->id ) }}"><img class="full-width img-responsive" style="height: 300px;" src="{{ asset($producto->url)}}"></a>
                  <a class="product-review" href="{{ url('product-detail/' . $producto->id ) }}" title="Vista Rapida">{{ $producto->nombre }}</a>
                  <a class="add-to-cart" href="#"><i class="fa fa-money fa-fw"></i>Agregar a Cotización</a>
                </div>
                <div class="product-description product-description-brd margin-bottom-30">
                  <div class="overflow-h margin-bottom-5">
                    <div class="pull-left">
                      <a href="{{ url('product-detail/' . $producto->id ) }}">
                        <span class="gender text-uppercase"><b>Tipo:</b> {{ $producto->tipo }}</span>
                      </a>
                      <span class="gender text-uppercase"><b>Marca:</b> {{ $producto->marca }}</span>
                    </div>
                    <div class="product-price">
                      @if ($producto->liquidacion == 1)
                      <span class="title-price">${{ $producto->precio_promocion }}</span>
                      <span class="title-price line-through">${{ $producto->precio }}</span>
                      @else
                        <span class="title-price">${{ $producto->precio }}</span>
                        <span class="title-price line-through">-</span>
                      @endif
                    </div>
                  </div>
                  <ul class="list-inline product-ratings">
                    <li><i class="rating-selected fa fa-star"></i></li>
                    <li><i class="rating-selected fa fa-star"></i></li>
                    <li><i class="rating-selected fa fa-star"></i></li>
                    <li><i class="rating fa fa-star"></i></li>
                    <li><i class="rating fa fa-star"></i></li>
                    <li class="like-icon"><a data-original-title="Agregar a Lista de Deseos" data-toggle="tooltip" data-placement="left" class="tooltips" href="#"><i class="fa fa-heart"></i></a></li>
                  </ul>
                </div>
              </div>
            @endforeach
          </div>
        </div><!--/end filter resilts-->

        <div class="text-center">
          {{ $productos->links() }}
        </div><!--/end pagination-->
      </div>
    </div><!--/end row-->
  </div><!--/end container-->
  <!--=== End Content Part ===-->
@endsection
