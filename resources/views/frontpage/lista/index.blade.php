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
            <small class="shop-bg-red badge-results">{{ $grid->productos }} filtrados</small>
          </div>
          <div class="col-sm-8">
            <ul class="list-inline clear-both">
              <li class="grid-list-icons">
                <a href="{{ url($pagina. '/list/'. $grid->id) }}"><i class="fa fa-th-list"></i></a>
                <a href="{{ url($pagina. '/'. $grid->id) }}"><i class="fa fa-th"></i></a>
              </li>
              <li class="sort-list-btn">
                <h3>Ordenado por :</h3>
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Mejores Ventas <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Todo</a></li>
                    <li><a href="#">Más Vendidas</a></li>
                    <li><a href="#">Ultimas Ventas Semanales</a></li>
                    <li><a href="#">Nuevas Llegadas</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div><!--/end result category-->

        <div class="filter-results">


          @foreach ($productos as $key => $producto)
          <div class="list-product-description product-description-brd margin-bottom-30">
            <div class="row">
              <div class="col-sm-4">
                <a href="{{ url('product-detail/' . $producto->id ) }}"><img class="img-responsive sm-margin-bottom-20" src="{{ asset($producto->url)}}"></a>
                </div>
              <div class="col-sm-8 product-description">
                <div class="overflow-h margin-bottom-5">
                  <ul class="list-inline overflow-h">
                    <li><h4 class="title-price"><a href="{{ url('product-detail/' . $producto->id ) }}"> {{ $producto->nombre }}</a></h4></li>

                    <li class="pull-right">
                      <ul class="list-inline product-ratings">
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating-selected fa fa-star"></i></li>
                        </ul>
                      </li>
                    </ul>
                  <div class="margin-bottom-10">
                    @if ($producto->liquidacion == 1)
                    <span class="title-price">${{ $producto->precio_promocion }}</span>
                    <span class="title-price line-through">${{ $producto->precio }}</span>
                    @else
                      <span class="title-price">${{ $producto->precio }}</span>
                      <span class="title-price line-through">-</span>
                    @endif
                  </div>
                  <p class="margin-bottom-20">
                    <a href="{{ url('product-detail/' . $producto->id ) }}">
                      <span class="gender text-uppercase"><b>Tipo:</b> {{ $producto->tipo }}</span>
                    </a>
                  </p>
                  <br><br><br>
                  </div>
                </div>
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
