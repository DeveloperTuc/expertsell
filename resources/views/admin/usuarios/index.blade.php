@extends('adminlte::page')

@section('content_header')
<h1><b>Listado de usuarios</b></h1>
<hr>
@stop

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">Usuarios registrados</h3>
				<div class="card-tools">
					<a href="{{url('/admin/usuarios/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear
						nuevo</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="mitabla" class="table table-striped table-bordered table-hover"><!--caption-top-->
					<thead class="table-dark">
						<tr>
							<th scope="col" style="text-align: center">Nro</th>
							<th scope="col">Nombre del usuario</th>
                            <th scope="col">Rol del usuario</th>
                            <th scope="col">Correo</th>
							<th scope="col" style="text-align: center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php $contador = 1;?>
						@foreach ($usuarios as $usuario)
							<tr>
								<td style="text-align	: center">{{ $contador++ }}</td>
								<td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $usuario->email }}</td>
								<td style="text-align: center;">
									<div class="btn-group" role="group" aria-label="Basic example">
										<a href="{{ url('/admin/usuarios', $usuario->id) }}" class="btn btn-info"><i
												class="fas fa-eye"></i></a>
										<a href="{{ url('/admin/usuarios/' . $usuario->id . '/edit') }}" type="button"
											class="btn btn-warning"><i class="fas fa-pencil"></i></a>
										<form action="{{ url('/admin/usuarios',$usuario->id) }}" method="post" onclick="preguntar{{ $usuario->id }}(event)" id="miFormulario{{ $usuario->id }}">
											@csrf	
											@method('DELETE')
											<button type="submit" class="btn btn-danger" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
										</form>
										<script>
											function preguntar{{ $usuario->id }}(event){
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
														var form = $('#miFormulario{{ $usuario->id }}');
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
				"info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
				"infoEmpty": "Mostrando de 0 a 0 de 0 usuarios",
				"infoFiltered": "(Filtrado de _MAX_ total usuarios)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ usuarios",
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