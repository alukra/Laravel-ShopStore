<div class="alert alert-error alert-dismissible" style="display:none;">
	<i class="icon fa fa-ban"></i> <b>Error</b>
	<ul>
		<li class="mensaje4"> Error al realizar la accion</li>
	</ul>
</div>


<form id="permiso_rol">
	<input type="hidden" name="id" value="{{ $id }}">
	<table class="table table-bordered">
		<tr>
			<th>Modulo</th>
			<th>Seccion</th>
			<th>Estado</th>
		</tr>
		@foreach ($secciones as $seccion)
		<tr>
			<td> {{ $seccion->modulo->nombre }}</td>
			<td> {{ $seccion->nombre }} </td>
			<td>
			@if( in_array($seccion->id, $permisos) )
					<input type="checkbox" name="{{ $seccion->id }}" value="{{ $seccion->id }}" checked>
			@else
				<input type="checkbox" name="{{ $seccion->id }}" value="{{ $seccion->id }}">
			@endif
			</td>
		</tr>
		@endforeach
	</table>
</form>
