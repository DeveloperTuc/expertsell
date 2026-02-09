@extends('adminlte::page')

@section('content_header')
<h1><b>Modificar datos de la venta</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('/admin/ventas',$venta->id)}}" id="form_venta" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="text" value="{{ $venta->id }}" id="id_venta" name="id_venta" hidden>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" type="number" class="form-control" name="cantidad"
                                    value="{{ old('cantidad') ?? 1 }}" autocomplete="off" required>
                                @error('cantidad')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="codigo">Código</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                </div>
                                <input id="codigo" type="text" name="codigo" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ url('/admin/productos/create') }}" type="button"
                                        class="btn btn-success"><i class="fas fa-plus"></i></a>
                                </div>
                                @error('codigo')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div style="height: 32px"></div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de productos
                                                </h1>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="mitabla"
                                                    class="table table-striped table-bordered table-hover table-responsive">
                                                    <!--caption-top-->
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th scope="col" style="text-align: center">Nro</th>
                                                            <th scope="col" style="text-align: center">Acción</th>
                                                            <th scope="col">Código</th>
                                                            <th scope="col">Nombre del producto</th>
                                                            <th scope="col">Categoría</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Stock</th>
                                                            <th scope="col">Precio</th>
                                                            <th scope="col">Imagen</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $contador = 1;?>
                                                        @foreach ($productos as $producto)
                                                            <tr>
                                                                <td style="text-align: rigth">{{ $contador++ }}</td>
                                                                <td style="text-align: center;">
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-seleccionar"
                                                                            data-id="{{ $producto->codigo }}">
                                                                            Seleccionar
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $producto->codigo }}</td>
                                                                <td>{{ $producto->nombre }}</td>
                                                                <td>{{ $producto->categoria->nombre }}</td>
                                                                <td>{{ $producto->descripcion }}</td>
                                                                <td style="text-align: rigth">{{ $producto->stock }}</td>
                                                                <td style="text-align: rigth">$
                                                                    {{ $producto->precio_venta }}
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <!--<img src="{{ asset('storage/' . $producto->imagen) }}"
                                                                        width="100px" height="50px"
                                                                        alt="imagen de producto">-->
                                                                    @if(!empty($producto->imagen))
                                                                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                                            width="100px" height="50px"
                                                                            alt="imagen de producto">
                                                                    @else
                                                                        <!-- Imagen por defecto o placeholder si no hay imagen -->
                                                                        <!--<img src="{{ asset('img/no-image.png') }}" 
                                                                            width="100px" height="50px" 
                                                                            alt="sin imagen">-->
                                                                        <span class="badge badge-secondary">Sin imagen</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_cliente" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de clientes
                                            </h1>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table id="mitabla2"
                                                class="table table-striped table-bordered table-hover table-responsive">
                                                <!--caption-top-->
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col" style="text-align: center">Nro</th>
                                                        <th scope="col" style="text-align: center">Acción</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col">CUIL/CUIT</th>
                                                        <th scope="col">Teléfono</th>
                                                        <th scope="col">Correo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $contador = 1;?>
                                                    @foreach ($clientes as $cliente)
                                                        <tr>
                                                            <td style="text-align: rigth">{{ $contador++ }}</td>
                                                            <td style="text-align: center;">
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-seleccionar-cliente"
                                                                        data-id="{{ $cliente->id }}" data-nombre="{{ $cliente->nombre_cliente }}"
                                                                        data-identificacion-tributaria="{{ $cliente->identificacion_tributaria }}"
                                                                        >
                                                                        Seleccionar
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td>{{ $cliente->nombre_cliente }}</td>
                                                            <td>{{ $cliente->identificacion_tributaria }}</td>
                                                            <td>{{ $cliente->telefono }}</td>
                                                            <td>{{ $cliente->email }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Crear Cliente-->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_crear_cliente" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="exampleModalLabel">Ingrese los datos
                                            </h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nombre_cliente">Nombre y apellido</label>
                                                        <input type="text" class="form-control" id="nombre_cliente"
                                                            value="{{ old('nombre_cliente') }}" autocomplete="off">
                                                        @error('nombre_cliente')
                                                            <small style="...">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="identificacion_tributaria">CUIL/CUIT</label>
                                                        <input type="text" class="form-control"
                                                            id="identificacion_tributaria"
                                                            value="{{ old('identificacion_tributaria') }}"
                                                            autocomplete="off">
                                                        @error('identificacion_tributaria')
                                                            <small style="...">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="telefono">Teléfono</label>
                                                        <input type="text" class="form-control" id="telefono"
                                                            value="{{ old('telefono') }}">
                                                        @error('telefono')
                                                            <small style="...">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Correo</label>
                                                        <input type="email" class="form-control" id="email"
                                                            value="{{ old('email') }}" autocomplete="off">
                                                        @error('email')
                                                            <small style="...">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <divv class="row">
                                                <div class="col-md-4">
                                                    <button type="button" onclick="guardar_cliente()"
                                                        class="btn btn-primary"><i class="fas fa-save"></i>
                                                        Registrar
                                                    </button>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <table class="table table-sm table-striped table-bordered table-hover col-md-6">
                            <thead class="table-dark">
                                <th scope="col">Nro</th>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre de producto</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Total</th>
                                <th>Acción</th>
                            </thead>
                            <tbody>
                                <?php $cont = 1; $total_cantidad = 0; $total_venta = 0;?>
                                @foreach ($venta->detalles as $detalle)
                                    <tr>
                                        <td style="text-align: center">{{ $cont++ }}</td>
                                        <td style="text-align: center">{{ $detalle->producto->codigo }}</td>
                                        <td style="text-align: center">{{ $detalle->producto->nombre }}</td>
                                        <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                        <td style="text-align: center">$ {{ $detalle->producto->precio_venta }}</td>
                                        <td style="text-align: center">$
                                            {{ $costo = $detalle->producto->precio_venta * $detalle->cantidad }}
                                        </td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-danger delete-btn"
                                                data-id="{{ $detalle->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @php
                                        $total_cantidad += $detalle->cantidad;
                                        $total_venta += $costo;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfooter>
                                <td colspan="3" style="text-align: right"><b>Total Cantidad</b></td>
                                <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>
                                <td style="text-align: right"><b>Total Venta</b></td>
                                <td style="text-align: center"><b>$ {{ $total_venta }}</b></td>
                                <td></td>
                            </tfooter>
                        </table>
                        <hr>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <label class="col-form-label col-md-4" for="fecha" style="text-align:right">Fecha</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control" name="fecha" value="{{ $venta->fecha }}"
                                    autocomplete="off">
                                @error('fecha')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal_cliente">
                                        <i class="fas fa-search"></i> Buscar Cliente
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal_crear_cliente">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-6 ml-0">
                                    <input id="nombre_cliente_select" type="text" class="form-control" value="{{ $venta->cliente->nombre_cliente }}" readonly>
                                    @error('nombre_cliente')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="id_cliente" name="id_cliente" hidden>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-form-label col-md-4" for="identificacion_tributaria" style="text-align:right">CUIL/CUIT</label>
                                <div class="col-md-6">
                                    <input type="text" id="identificacion_tributaria_select" class="form-control" value="{{ $venta->cliente->identificacion_tributaria }}" readonly>
                                    @error('identificacion_tributaria')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>                                
                            </div>
                            <div class="row mb-2">
                                <label for="precio_total" class="col-form-label col-md-4" style="text-align:right">
                                    <b>Total de la Venta</b>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control font-weight-bold" value="$ {{ $total_venta }}"
                                        name="precio_total" readonly>
                                        @error('precio_total')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>      
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                                Actualizar Venta
                            </button>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{ url('/admin/ventas') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
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
    
    function guardar_cliente() {
        const data = {
            nombre_cliente: $('#nombre_cliente').val(),
            identificacion_tributaria: $('#identificacion_tributaria').val(),
            telefono: $('#telefono').val(),
            email: $('#email').val(),
            _token: '{{ csrf_token() }}'
        };
        $.ajax({
            url: '{{ route("admin.ventas.cliente.store") }}',
            type: 'POST',
            data: data,
            success: function (response) {
                Swal.fire({
                    position: "top-end",
                    text: response.mensaje,
                    icon: response.icono,
                    confirmButtonText: 'Aceptar',
                    timer: 1500
                });
                location.reload();
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    position: "top-end",
                    text: 'Error, no se pudo registrar al cliente',
                    icon: 'error'
                });
            }
        });
    }

    $('.btn-seleccionar-cliente').click(function () {
        var id_cliente = $(this).data('id');
        var nombre_cliente = $(this).data('nombre');
        var identificacion_tributaria = $(this).data('identificacion-tributaria');
        
        $('#nombre_cliente_select').val(nombre_cliente);
        $('#id_cliente').val(id_cliente);
        $('#identificacion_tributaria_select').val(identificacion_tributaria);
        $('#exampleModal_cliente').modal('hide');
        $('#exampleModal_cliente').on('hidden.bs.modal', function () {
            $('#codigo').focus();
        });
    });

    $('.btn-seleccionar').click(function () {
        var codigo = $(this).data('id');
        $('#codigo').val(codigo);
        $('#exampleModal').modal('hide');
        $('#exampleModal').on('hidden.bs.modal', function () {
            $('#codigo').focus();
        });
    });

    $('.delete-btn').click(function () {
        var id = $(this).data('id');
        console.log(id);
        if (id) {
            $.ajax({
                url: "{{ url('/admin/ventas/detalle') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE',
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Producto eliminado",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    } else {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Producto no eliminado",
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }
                },
                error: function (error) {
                    console.log(error.responseText);
                    alert('Error en el servidor');
                }
            });
        }
    });

    $('#codigo').focus();

    $('#form_venta').on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });

    $('#codigo').on('keyup', function (e) {

        if (e.which === 13) {
            var codigo = $(this).val();
            var cantidad = $('#cantidad').val();
            var id_venta = $('#id_venta').val();
            var id_cliente = $('#id_cliente').val();

            if (codigo.length > 0 && cantidad > 0) {
                $.ajax({
                    url: "{{ route('admin.ventas.detalle.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: codigo,
                        cantidad: cantidad,
                        id_venta: id_venta,
                        id_cliente: id_cliente
                    },
                    beforeSend: function () {
                        $('#codigo').prop('disabled', true);
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Producto agregado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Producto no encontrado",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                        alert('Error en el servidor');
                    },
                    complete: function () {
                        $('#codigo').prop('disabled', false);
                    }
                });
            }
        }
    });
</script>

<script>
    $('#mitabla').DataTable({
        "pageLength": 3,
        "language": {
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

<script>
    $('#mitabla2').DataTable({
        "pageLength": 3,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
            "infoEmpty": "Mostrando de 0 a 0 de 0 Clientes",
            "infoFiltered": "(Filtrado de _MAX_ total clientes)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ clientes",
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