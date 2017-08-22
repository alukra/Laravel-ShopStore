@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section ('content')
  <div class="wrapper wrapper-content animated fadeInRight ecommerce">

      <div class="row">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="col-lg-12">
              <div class="tabs-container">
                      <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#tab-1"> Información del producto</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-2"> Categoria</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-3"> Caracteristicas</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-4"> Imágenes</a></li>
                      </ul>
                      <div class="tab-content">
                          <div id="tab-1" class="tab-pane active">
                              <div class="panel-body">

                                  <fieldset class="form-horizontal">
                                    <form role="form" method="post" action="{{ url('back/product/'. $producto->id ) }}">
                                         {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="form-group"><label>Nombre</label> <input type="text" placeholder="Nombre" class="form-control" name="nombre" value="{{ $producto->nombre }}"></div>
                                        <div class="form-group"><label>SKU</label> <input type="text" placeholder="SKU" class="form-control" name="sku" value="{{ $producto->sku }}"></div>
                                        <div class="form-group">
                                          <label>Precio</label>
                                          <div class="input-group m-b">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" placeholder="Precio" class="form-control" step="0.01" min="0.01" name="precio" value="{{ $producto->precio }}">
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label>Precio promoción</label>
                                          <div class="input-group m-b">
                                            <span class="input-group-addon">$</span>
                                            <input type="number" placeholder="Precio promoción" class="form-control" step="0.01" min="0.01" name="precio_promocion" value="{{ $producto->precio_promocion }}">
                                          </div>
                                        </div>
                                        <div class="form-group"><label>Stock</label><input type="number" placeholder="Stock" class="form-control" step="1" min="0" name="stock" value="{{ $producto->stock }}"></div>
                                        <div class="form-group">
                                          <label class="control-label">Tipo de producto</label>
                                          <select class="form-control m-b" name="tipo">
                                            <option>Seleccione tipo de producto</option>
                                            @foreach ($tipos as $key => $tipo)
                                              @if ($tipo->id == $producto->tipo_id)
                                                <option value="{{ $tipo->id }}" selected> {{  $tipo->nombre }} </option>
                                              @else
                                                <option value="{{ $tipo->id }}"> {{  $tipo->nombre }} </option>
                                              @endif
                                            @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label class="checkbox-inline">Liquidación</label>
                                          @if ($producto->liquidacion == 1)
                                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="liquidacion" checked="checked"></label>
                                          @else
                                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="liquidacion"></label>
                                          @endif
                                        </div>
                                        <div class="form-group">
                                          <label class="checkbox-inline">Rated</label>
                                          @if ($producto->rated == 1)
                                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="rated" checked="checked"></label>
                                          @else
                                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="rated"></label>
                                          @endif
                                        </div>
                                        <div>
                                            <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
                                        </div>
                                    </form>
                                  </fieldset>
                              </div>
                          </div>
                          <div id="tab-2" class="tab-pane">
                              <div class="panel-body">

                                <fieldset>
                                  <legend>Categoria</legend>
                                  <form action="{{ url('back/product-more/store-category/'. $producto->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <label class="control-label">Categoria</label>
                                      <select class="form-control m-b" name="categoria">
                                        <option>Seleccione categoria de producto</option>
                                        @foreach ($categorias as $key => $categoria)
                                          <option value="{{ $categoria->id }}"> {{  $categoria->nombre }} </option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
                                    </div>
                                  </form>
                                </fieldset>
                                <br><br>
                                <div class="table-responsive">
                                  <table class="table table-bordered table-striped">
                                    <thead>
                                      <th>Categoria</th>
                                      <th>Eliminar</th>
                                    </thead>
                                    <tbody>
                                      @foreach ($categorias_producto as $key => $catpr)
                                        <tr>
                                          <td>{{ $catpr->nombre }}</td>
                                          <td>
                                            <a class="btn btn-danger" href="{{ url('back/product-more/destroy-category/' .  $producto->id. "/". $catpr->id ) }}"><i class="fa fa-times"></i></a>
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                          </div>
                          <div id="tab-3" class="tab-pane">
                              <div class="panel-body">

                                <fieldset>
                                  <legend>Caracteristicas</legend>
                                  <form action="{{ url('back/product-more/store-detail/'. $producto->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <label class="control-label">Caracteristica</label>
                                      <select class="form-control m-b" name="caracteristica">
                                        <option>Seleccione caracteristica de producto</option>
                                        @foreach ($caracteristicas as $key => $caracteristica)
                                          <option value="{{ $caracteristica->id }}"> {{  $caracteristica->nombre }} </option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group"><label>Descripción</label> <input type="text" placeholder="Descripción" class="form-control" name="descripcion"></div>
                                    <div>
                                        <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
                                    </div>
                                  </form>
                                </fieldset>
                                <br><br>
                                <div class="table-responsive">
                                  <table class="table table-bordered table-striped">
                                    <thead>
                                      <th>Caracteristica</th>
                                      <th>Descripción</th>
                                      <th>Eliminar</th>
                                    </thead>
                                    <tbody>
                                      @foreach ($caracteristicas_producto as $key => $carpr)
                                        <tr>
                                          <td>{{ $carpr->nombre }}</td>
                                          <td>{{ $carpr->descripcion }}</td>
                                          <td>
                                            <a class="btn btn-danger" href="{{ url('back/product-more/destroy-detail/' .  $producto->id. "/". $carpr->id ) }}"><i class="fa fa-times"></i></a>
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>

                              </div>
                          </div>
                          <div id="tab-4" class="tab-pane">
                              <div class="panel-body">

                                <fieldset>
                                  <legend>Imágenes</legend>
                                  <form action="{{ url('back/product-more/store-image/'. $producto->id) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <label>Imagen</label>
                                      <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                          <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                          <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                          <span class="fileinput-new">Select file</span>
                                          <span class="fileinput-exists">Change</span>
                                          <input type="file" name="imagen"/>
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                      </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary m-t-n-xs" type="submit"><strong>Guardar</strong></button>
                                    </div>
                                  </form>
                                </fieldset>
                                <br><br>

                                  <div class="table-responsive">
                                      <table class="table table-bordered table-stripped">
                                          <thead>
                                            <tr>
                                                <th>Previsualización</th>
                                                <th>Enlace</th>
                                                <th>Principal</th>
                                                <th>Acciones</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach ($imagenes as $key => $imagen)
                                              <tr>
                                                <td><img src="{{ asset($imagen->url) }}" style="width:200px; height:200px;"></td>
                                                <td><input type="text" class="form-control" disabled value="{{ $imagen->url }}"></td>
                                                <td>
                                                  @if ($imagen->principal == 1)
                                                    <span class="label label-info">Principal</span>
                                                  @else
                                                    <span class="label label-default">Secundarias</span>
                                                  @endif
                                                </td>
                                                <td>
                                                  @if ($imagen->principal == 1)
                                                    <a class="btn btn-primary" href="#"><i class="fa fa-circle-o-notch"></i></a>
                                                  @else
                                                    <a class="btn btn-default" href="{{ url('back/product-more/update-image/' .  $producto->id. "/". $imagen->id ) }}"><i class="fa fa-circle-o-notch"></i></a>
                                                  @endif
                                                  <a class="btn btn-danger" href="{{ url('back/product-more/destroy-image/' .  $producto->id. "/". $imagen->id ) }}"><i class="fa fa-times"></i></a>
                                                </td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                      </table>
                                  </div>

                              </div>
                          </div>
                      </div>
              </div>
          </div>
      </div>

  </div>

@endsection

@section('cssExtras')
  <link href="{{ asset('backoffice/css/iCheck/custom.css')}}" rel="stylesheet">
  <link href="{{ asset('backoffice/css/datepicker/datepicker3.css')}}" rel="stylesheet">
  <link href="{{ asset('backoffice/css/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('scriptsExtras')
  <script src="{{ asset('backoffice/js/datepicker/bootstrap-datepicker.js')}}"></script>
  <script src="{{ asset('backoffice/js/iCheck/icheck.min.js')}}"></script>
  <script src="{{ asset('backoffice/js/jasny/jasny-bootstrap.min.js')}}"></script>
  <script>
      $(document).ready(function () {
          $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
          });
      });
  </script>
@endsection
