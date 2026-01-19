@extends('adminlte::page')

@section('content_header')
<h1><b>Listado de productos</b></h1>
<hr>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<h3 class="card-title">Productos registrados</h3>
				<div class="card-tools">
					<a href="{{url('/admin/productos/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>
						Crear
						nuevo</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="mitabla" class="table table-striped table-bordered table-hover"><!--caption-top-->
					<thead class="table-dark">
						<tr>
							<th scope="col" style="text-align: center">Nro</th>
							<th scope="col">Código</th>
							<th scope="col">Nombre del producto</th>
							<th scope="col">Categoría</th>
							<th scope="col">Descripción</th>
							<th scope="col">Stock</th>
							<th scope="col">Precio</th>
							<th scope="col">Imagen</th>
							<th scope="col" style="text-align: center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php $contador = 1;?>
						@foreach ($productos as $producto)
							<tr>
								<td style="text-align: rigth">{{ $contador++ }}</td>
								<td>{{ $producto->codigo }}</td>
								<td>{{ $producto->nombre }}</td>
								<td>{{ $producto->categoria->nombre }}</td>
								<td>{{ $producto->descripcion }}</td>
								<td style="text-align: rigth">{{ $producto->stock }}</td>
								<td style="text-align: rigth">$ {{ $producto->precio_venta }}</td>
								<td style="text-align: center">
									<img src="{{ asset('storage/'.$producto->imagen) }}" width="100px" height="50px" alt="imagen de producto">
								</td>
								<td style="text-align: center;">
									<div class="btn-group" role="group" aria-label="Basic example">
										<a href="{{ url('/admin/productos', $producto->id) }}" class="btn btn-info"><i
												class="fas fa-eye"></i></a>
										<a href="{{ url('/admin/productos/' . $producto->id . '/edit') }}" type="button"
											class="btn btn-warning"><i class="fas fa-pencil"></i></a>
										<form action="{{ url('/admin/productos', $producto->id) }}" method="post"
											onclick="preguntar{{ $producto->id }}(event)"
											id="miFormulario{{ $producto->id }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger"
												style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
										</form>
										<script>
											function preguntar{{ $producto->id }}(event) {
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
												}).then((result) => {
													if (result.isConfirmed) {
														var form = $('#miFormulario{{ $producto->id }}');
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
				"info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
				"infoEmpty": "Mostrando de 0 a 0 de 0 Productos",
				"infoFiltered": "(Filtrado de _MAX_ total productos)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ productos",
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