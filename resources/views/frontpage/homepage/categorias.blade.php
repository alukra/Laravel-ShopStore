<div class="heading heading-v1 margin-bottom-20">
  <h2>Dispositivos mobiles utiles para:</h2>
  <p>Gaming, Social Media, Homework, Diseño Grafico, Edición Multimedia, Usos Basico, Etc.</p>
</div>
<br><br>

<!--=== Illustration v3 ===-->
<div class="row margin-bottom-50">
  @foreach ($categorias as $key => $categoria)
    <div class="col-md-4 md-margin-bottom-30">
      <div class="overflow-h">
        <a class="illustration-v3" href="{{ url('products/0/'. $categoria->id. '/0' ) }}" style="background-image: url({{ $categoria->url }});" >
          <span class="illustration-bg">
            <span class="illustration-ads">
              <span class="illustration-v3-category">
                <span class="product-category" style="color:yellow;">{{ $categoria->nombre }}</span>
                <span class="product-amount" style="color:yellow;">{{ $categoria->productos }} Items</span>
              </span>
            </span>
          </span>
        </a>
      </div>
    </div>
  @endforeach

</div>
<!--=== End Illustration v3 ===-->
