@extends ('backoffice/layout/app')

@section ('title') {{ $page_title }} @stop

@section ('content')

	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
				<div class="alert alert-success alert-dismissible" style="display:none;">
					<i class="icon fa fa-check"></i> <b>{{ trans('validation.success') }}</b>
					<ul>
						<li class="mensaje1"> Rol agregado </li>
						<li class="mensaje2"> Rol Actualizado </li>
						<li class="mensaje5"> Secciones asignadas </li>
					</ul>
				</div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table id="tblrol" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th> Rol</th>
								<th> Descripcion </th>
								<th> Acciones</th>
							</tr>
							</thead>
							<tbody>
								@foreach( $roles as $rol)
									<tr>
										<td> {{ $rol['nombre'] }} </td>
										<td> {{ $rol['descripcion'] }}</td>
										<td>
											<button id="modal-editar" value="{{ $rol['id'] }}" class="btn btn-default"><i class="fa fa-pencil"></i> </button>
											<button id="asignar" value="{{ $rol['id'] }}" class="btn btn-default"> <i class="fa fa-cog"></i></button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<button class="btn btn-default btn-lg" id="modal-crear"> Crear rol </button>

					<div class="modal rol-modal inmodal">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title"> Crear </h4>
					      </div>
					      <form class="form-horizontal" id="formRol">
					      <div class="modal-body">
					        	<input type="hidden" id="id">

					        	<div class="alert alert-error alert-dismissible">
											<i class="icon fa fa-ban"></i> <b>Error</b>
											<ul>
												<li class="mensaje3"> Debe completar los campos para realizar la acción </li>
												<li class="mensaje4"> Error al completar la acción </li>
											</ul>
										</div>

					        	<div class="form-group">
									    <label for="nombre" class="col-sm-2 control-label"> Nombre </label>
									    <div class="col-sm-10">
									      <input type="text" class="form-control no-vacio" name="txtNombre" id="txtNombre" placeholder="Nombre">
									    </div>
									  </div>

									  <div class="form-group">
									    <label for="nombre" class="col-sm-2 control-label">Descripción</label>
									    <div class="col-sm-10">
									      <textarea id="txtDescripcion" name="txtDescripcion" class="form-control no-vacio"></textarea>
									    </div>
									  </div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					        <button type="button" id="btnCrear" class="btn btn-primary">Guardar</button>
					        <button type="button" id="btnEditar" class="btn btn-primary">Guardar</button>
					      </div>
								</form>
					    </div>
					  </div>
					</div>

					<div class="modal modulo-modal">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title"> Asignar permisos</h4>
					      </div>
					      <div class="modal-body modulo-modal-body">

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
					        <button type="button" id="asignarRoles" class="btn btn-primary">Asignar</button>
					      </div>
								</form>
					    </div>
					  </div>
					</div>
			</div>
		</div>
</div>

@endsection

@section('cssExtras')
	<link rel="stylesheet" href="{{ asset('backoffice/css/dataTables/datatables.min.css')}}">
@endsection

@section('scriptsExtras')
	<script src="{{ asset('backoffice/js/dataTables/datatables.min.js')}}"></script>
	<script src="{{ asset('backoffice/js/rol.js') }} " ></script>
@endsection
