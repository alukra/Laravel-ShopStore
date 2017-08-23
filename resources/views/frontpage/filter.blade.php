<div class="col-md-3 hidden-xs filter-by-block md-margin-bottom-60">
  <h1>Filtrar por</h1>
  <form action="{{ url('filter') }}" method="post">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            Categoria
            <i class="fa fa-angle-down"></i>
          </a>
        </h2>
      </div>
      <div id="collapseOne" class="panel-collapse collapse in">
        <div class="panel-body">
          <ul class="list-unstyled checkbox-list">
            @foreach ($categorias as $key => $categoria)
              <li>
                <label class="checkbox">
                  <input type="radio" value="{{ $categoria->id }}" name="categoria"/>
                  <i></i>
                  {{ $categoria->nombre }}
                  <small><a href="#">({{ $categoria->productos}})</a></small>
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div><!--/end panel group-->

  <div class="panel-group" id="accordion-v2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseTwo">
            Tipo de producto
            <i class="fa fa-angle-down"></i>
          </a>
        </h2>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse in">
        <div class="panel-body">
          <ul class="list-unstyled checkbox-list">
            @foreach ($tipos as $key => $tipo)
              <li>
                <label class="checkbox">
                  <input type="radio" value="{{ $tipo->id }}" name="tipo"/>
                  <i></i>
                  {{ $tipo->nombre }}
                  <small><a href="#">({{ $tipo->productos}})</a></small>
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div><!--/end panel group-->


  <div class="panel-group" id="accordion-v3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion-v3" href="#collapseThree">
            Marca
            <i class="fa fa-angle-down"></i>
          </a>
        </h2>
      </div>
      <div id="collapseThree" class="panel-collapse collapse in">
        <div class="panel-body">
          <ul class="list-unstyled checkbox-list">
            @foreach ($marcas as $key => $marca)
              <li>
                <label class="checkbox">
                  <input type="radio" value="{{ $marca->id }}" name="marca"/>
                  <i></i>
                  {{ $marca->nombre }}
                  <small><a href="#">({{ $marca->productos}})</a></small>
                </label>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div><!--/end panel group-->
  {{ csrf_field() }}
  <button type="reset" class="btn-u btn-brd btn-brd-hover btn-u-lg btn-u-sea-shop btn-block">Reset</button>
  <button type="submit" class="btn-u btn-brd btn-brd-hover btn-u-lg btn-u-sea-shop btn-block">Filtrar</button>
  </form>
</div>
