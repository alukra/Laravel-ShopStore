<!--=== Illustration v4 ===-->
<div class="row illustration-v4 margin-bottom-40">
  <div class="col-md-4">
    <div class="heading heading-v1 margin-bottom-20">
      <h2>Top Rated</h2>
    </div>
    @foreach ($rated as $key => $rpd)
      <div class="thumb-product">
        <img class="thumb-product-img" src="{{ asset($rpd->url)}}">
        <div class="thumb-product-in">
          <h4><a href="{{ url('product-detail/' . $rpd->id ) }}"> {{ $rpd->nombre }} </a></h4>
          <span class="thumb-product-type">{{ $rpd->tipo }}</span>
        </div>
        <ul class="list-inline overflow-h">
          @if ($rpd->liquidacion == 1)
            <li class="thumb-product-price line-through">${{ $rpd->precio }}</li>
            <li class="thumb-product-price">${{ $rpd->precio_promocion}}</li>
          @else
            <li class="thumb-product-price">${{$rpd->precio}}</li>
          @endif
          <li class="thumb-product-purchase"><a href="#"><i class="fa fa-shopping-cart"></i></a> | <a href="#"><i class="fa fa-heart"></i></a></li>
        </ul>
      </div>
    @endforeach

  </div>
  <div class="col-md-4">
    <div class="heading heading-v1 margin-bottom-20">
      <h2>Best Sellers</h2>
    </div>
    @foreach ($mostSale as $key => $msp)
      <div class="thumb-product">
        <img class="thumb-product-img" src="{{ asset($msp->url)}}">
        <div class="thumb-product-in">
          <h4><a href="{{ url('product-detail/' . $msp->id ) }}"> {{ $msp->nombre }} </a></h4>
          <span class="thumb-product-type">{{ $msp->tipo }}</span>
        </div>
        <ul class="list-inline overflow-h">
          @if ($msp->liquidacion == 1)
            <li class="thumb-product-price line-through">${{ $msp->precio }}</li>
            <li class="thumb-product-price">${{ $msp->precio_promocion}}</li>
          @else
            <li class="thumb-product-price">${{$msp->precio}}</li>
          @endif
          <li class="thumb-product-purchase"><a href="#"><i class="fa fa-shopping-cart"></i></a> | <a href="#"><i class="fa fa-heart"></i></a></li>
        </ul>
      </div>
    @endforeach
  </div>
  <div class="col-md-4 padding">
    <div class="heading heading-v1 margin-bottom-20">
      <h2>Sale Items</h2>
    </div>
    @foreach ($liquidacion as $key => $lqp)
      <div class="thumb-product">
        <img class="thumb-product-img" src="{{ asset($lqp->url)}}">
        <div class="thumb-product-in">
          <h4><a href="{{ url('product-detail/' . $lqp->id ) }}"> {{ $lqp->nombre }} </a></h4>
          <span class="thumb-product-type">{{ $lqp->tipo }}</span>
        </div>
        <ul class="list-inline overflow-h">
          @if ($lqp->liquidacion == 1)
            <li class="thumb-product-price line-through">${{ $lqp->precio }}</li>
            <li class="thumb-product-price">${{ $lqp->precio_promocion}}</li>
          @else
            <li class="thumb-product-price">${{$lqp->precio}}</li>
          @endif
          <li class="thumb-product-purchase"><a href="#"><i class="fa fa-shopping-cart"></i></a> | <a href="#"><i class="fa fa-heart"></i></a></li>
        </ul>
      </div>
    @endforeach
  </div>
</div><!--/end row-->
<!--=== End Illustration v4 ===-->
