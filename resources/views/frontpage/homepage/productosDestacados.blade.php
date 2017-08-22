<div class="heading heading-v1 margin-bottom-20">
  <h2>PRODUCTOS DESTACADOS</h2>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed odio elit, ultrices vel cursus sed, placerat ut leo. Phasellus in magna erat. Etiam gravida convallis augue non tincidunt. Nunc lobortis dapibus neque quis lacinia. Nam dapibus tellus sit amet odio venenatis</p>
</div>

<!--=== Illustration v2 ===-->
<div class="illustration-v2 margin-bottom-60">
  <div class="customNavigation margin-bottom-25">
    <a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
    <a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
  </div>

  <ul class="list-inline owl-slider">
    @foreach ($quickproductosDestacados as $key => $qpd)
      <li class="item">
        <div class="product-img">
          <a href="{{ url('product-detail/' . $qpd->id ) }}"><img class="full-width img-responsive" src="{{ asset($qpd->url)}}" style="width: 370px; height:300px;"></a>
          <a class="product-review" href="{{ url('product-detail/' . $qpd->id ) }}">Vista rapida</a>
          <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>Agregar a cotización</a>
        </div>
        <div class="product-description product-description-brd">
          <div class="overflow-h margin-bottom-5">
            <div class="pull-left">
              <h4 class="title-price"><a href="{{ url('product-detail/' . $qpd->id ) }}"> {{$qpd->nombre}} </a></h4>
              <span class="gender text-uppercase">{{ $qpd->tipo}}</span>
            </div>
            <div class="product-price">
              <span class="title-price">
                @if ($qpd->liquidacion == 1)
                  <del class="text-danger">$ {{ $qpd->precio }}</del>
                  $ {{ $qpd->precio_promocion }}
                @else
                  $ {{ $qpd->precio }}
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
<!--=== End Illustration v2 ===-->
