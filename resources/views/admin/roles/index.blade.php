@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><b>Listado de roles</b></h1>
<hr>
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">Roles registrados</h3>
				<div class="card-tools">
					<a href="{{url('/admin/roles/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear
						nuevo</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="mitabla" class="table table-striped table-bordered table-hover"><!--caption-top-->
					<thead class="table-dark">
						<tr>
							<th scope="col" style="text-align: center">Nro</th>
							<th scope="col">Nombre del rol</th>
							<th scope="col" style="text-align: center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php $contador = 1;?>
						@foreach ($roles as $role)
							<tr>
								<td style="text-align	: center">{{ $contador++ }}</td>
								<td>{{ $role->name }}</td>
								<td style="text-align: center;">
									<div class="btn-group" role="group" aria-label="Basic example">
										<a href="{{ url('/admin/roles', $role->id) }}" class="btn btn-info"><i
												class="fas fa-eye"></i></a>
										<a href="{{ url('/admin/roles/' . $role->id . '/edit') }}" type="button"
											class="btn btn-warning"><i class="fas fa-pencil"></i></a>
										<form action="{{ url('/admin/roles',$role->id) }}" method="post" onclick="preguntar{{ $role->id }}(event)" id="miFormulario{{ $role->id }}">
											@csrf	
											@method('DELETE')
											<button type="submit" class="btn btn-danger" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
										</form>
										<script>
											function preguntar{{ $role->id }}(event){
												event.preventDefault();
												swal.fire({
													title: '¿Desea eliminar este registro?',
													text: '',
													icon: 'question',
													showDenyButton: true,
													confirmButtonText: 'Eliminar',
													confirmButtonColor: '#a5161d',
													denyButtonColor: '#270a0a',
													denyButtonText: 'Cancelar',
												}).then((result)=>{
													if(result.isConfirmed){
														var form = $('#miFormulario{{ $role->id }}');
														form.submit();
													}
												});
											}
										</script>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
@stop

@section('css')
@stop

@section('js')
	
	<script>
		$('#mitabla').DataTable({
			//"pageLength": 25,
			"language":{
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ roles",
				"infoEmpty": "Mostrando de 0 a 0 de 0 roles",
				"infoFiltered": "(Filtrado de _MAX_ total roles)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ roles",
				"loadingRecords": "Cargando...",
				"processing": "Procesando... ",
				"search": "Filtrar:",
				"zeroRecords": "Sin resultados",
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": "Siguiente",
					"previous": "Anterior",
				}
			},
		});
	</script>

@stop