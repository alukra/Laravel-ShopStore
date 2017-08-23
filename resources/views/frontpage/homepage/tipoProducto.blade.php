<div class="row illustration-v2">
  @foreach ($tipos as $key => $tipo)
    <div class="col-md-3 col-sm-6 md-margin-bottom-30">
      <div class="product-img">
        <a href="{{ url('products/' . $tipo->id. '/0/0' ) }}"><img class="full-width img-responsive" src="{{ asset($tipo->url)}}" style="width: 370px; height:300px;"></a>
        <a class="product-review" href="{{ url('products/' . $tipo->id. '/0/0' ) }}">Vista rapida</a>
        <a class="add-to-cart" href="{{ url('products/' . $tipo->id. '/0/0' ) }}"><i class="fa fa-laptop"></i>{{ $tipo->nombre }}</a>
      </div>
    </div>
  @endforeach
</div>
<!--=== End Illustration v2 ===-->
