@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

  @section('breadcrumb')
    <li><a href="{{ url('back/product') }}">Productos</a></li>
    <li class="active">
        <strong>{{ $page_title }}</strong>
    </li>
  @endsection

@section ('content')

  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="ibox-content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" method="post" action="{{ url('back/product') }}">
             {{ csrf_field() }}
            <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre"></div>
            <div class="form-group"><label>SKU</label> <input type="text" placeholder="SKU" class="form-control" name="sku"></div>
            <div class="form-group">
              <label>Precio</label>
              <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Precio" class="form-control" step="0.01" min="0.01" name="precio">
              </div>
            </div>
            <div class="form-group">
              <label>Precio promoción</label>
              <div class="input-group m-b">
                <span class="input-group-addon">$</span>
                <input type="number" placeholder="Precio promoción" class="form-control" step="0.01" min="0.01" name="precio_promocion">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Tipo de producto</label>
              <select class="form-control m-b" name="tipo">
                <option>Seleccione tipo de producto</option>
                @foreach ($tipos as $key => $tipo)
                  <option value="{{ $tipo->id }}"> {{  $tipo->nombre }} </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Marca</label>
              <select class="form-control m-b" name="marca">
                <option>Seleccione marca</option>
                @foreach ($marcas as $key => $marca)
                  <option value="{{ $marca->id }}"> {{  $marca->nombre }} </option>
                @endforeach
              </select>
            </div>
            <div class="form-group"><label>Descripción</label> <textarea name="descripcion" rows="4" cols="80" class="form-control"></textarea></div>
            <div>
                <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection
