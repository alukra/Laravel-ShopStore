<!--=== Shop Suvbscribe ===-->
<div class="shop-subscribe">
  <div class="container">
    <div class="row">
      <div class="col-md-8 md-margin-bottom-20">
        <h2>Suscribete a las mejores <strong>Ofertas</strong></h2>
      </div>
      <div class="col-md-4">
        <form action="{{ url('suscribe') }}" method="post">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="email" class="form-control" name="email"  placeholder="Escribe tu correo...">
            <span class="input-group-btn">
              <button class="btn" type="submit"><i class="fa fa-envelope-o"></i></button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div><!--/end container-->
</div>
<!--=== End Shop Suvbscribe ===-->
