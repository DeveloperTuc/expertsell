@extends('adminlte::page')

@section('content_header')
<h1><b>Modificar datos de la compra</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('/admin/compras',$compra->id)}}" id="" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
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
                                                            <th scope="col">Código</th>
                                                            <th scope="col">Nombre del producto</th>
                                                            <th scope="col">Categoría</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Stock</th>
                                                            <th scope="col">Precio</th>
                                                            <th scope="col">Imagen</th>
                                                            <th scope="col" style="text-align: center">Acción</th>
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
                                                                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                                        width="100px" height="50px"
                                                                        alt="imagen de producto">
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
                            <div class="modal fade" id="exampleModal_proveedor" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Listado de proveedores
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
                                                        <th scope="col">Empresa</th>
                                                        <th scope="col">Teléfono</th>
                                                        <th scope="col">Dirección</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $contador = 1;?>
                                                    @foreach ($proveedores as $proveedor)
                                                        <tr>
                                                            <td style="text-align: rigth">{{ $contador++ }}</td>
                                                            <td style="text-align: center;">
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">
                                                                    <button type="button"
                                                                        class="btn btn-info btn-seleccionar-proveedor"
                                                                        data-id="{{ $proveedor->id }}" data-empresa="{{ $proveedor->empresa }}">
                                                                        Seleccionar
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <td>{{ $proveedor->empresa }}</td>
                                                            <td>{{ $proveedor->telefono }}</td>
                                                            <td>{{ $proveedor->direccion }}</td>
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
                                <?php $cont = 1; $total_cantidad = 0; $total_compra = 0;?>
                                @foreach ($compra->detalles as $detalle)
                                    <tr>
                                        <td style="text-align: center">{{ $cont++ }}</td>
                                        <td style="text-align: center">{{ $detalle->producto->codigo }}</td>
                                        <td style="text-align: center">{{ $detalle->producto->nombre }}</td>
                                        <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                        <td style="text-align: center">$ {{ $detalle->precio_producto }}</td>
                                        <td style="text-align: center">$
                                            {{ $costo = $detalle->precio_producto * $detalle->cantidad }}
                                        </td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-danger delete-btn"
                                                data-id="{{ $detalle->id }}"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @php
                                        $total_cantidad += $compra->cantidad;
                                        $total_compra += $costo;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfooter>
                                <td colspan="3" style="text-align: right"><b>Total Cantidad</b></td>
                                <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>
                                <td style="text-align: right"><b>Total Compra</b></td>
                                <td colspan="2" style="text-align: center"><b>$ {{ $total_compra }}</b></td>
                            </tfooter>
                        </table>
                        <hr>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <label class="col-form-label col-md-4" for="fecha" style="text-align:right">Fecha</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control" name="fecha" value="{{ $compra->fecha }}"
                                    autocomplete="off">
                                @error('fecha')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-form-label col-md-4" for="comprobante" style="text-align:right">Comprobante</label>
                                <div class="col-md-6">
                                    <input type="text" name="comprobante" id="comprobante" class="form-control" value="{{ $compra->comprobante }}">
                                    @error('comprobante')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>                                
                            </div>
                            <div class="row mb-2">
                                <label class="col-md-1" for="" display="none"></label>
                                <button type="button" class="btn btn-primary col-md-3" data-toggle="modal" data-target="#exampleModal_proveedor">
                                    <i class="fas fa-search"></i> Buscar Proveedor
                                </button> 
                                <div class="col-md-6">
                                    <input id="nombre_proveedor" value="{{ $detalle->proveedor->empresa }}" type="text" class="form-control font-weight-bold"
                                        name="nombre_proveedor" required readonly>
                                    @error('nombre_proveedor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="text" class="form-control" id="id_proveedor" value="{{ $detalle->proveedor_id }}" name="id_proveedor" hidden>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="precio_total" class="col-form-label col-md-4" style="text-align:right">
                                    <b>Total de la Compra</b>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control font-weight-bold" value="$ {{ $total_compra }}"
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
                                Actualizar Compra
                            </button>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{ url('/admin/compras') }}" class="btn btn-secondary">Volver</a>
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
    

    $('.btn-seleccionar-proveedor').click(function () {
        var id_proveedor = $(this).data('id');
        var empresa = $(this).data('empresa');
        
        $('#nombre_proveedor').val(empresa);
        $('#id_proveedor').val(id_proveedor);
        $('#exampleModal_proveedor').modal('hide');
        $('#exampleModal_proveedor').on('hidden.bs.modal', function () {
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

        if (id) {
            $.ajax({
                url: "{{ url('/admin/compras/create/tmp') }}/" + id,
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

    $('#form_compra').on('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });

    $('#codigo').on('keyup', function (e) {

        if (e.which === 13) {
            var codigo = $(this).val();
            var cantidad = $('#cantidad').val();

            if (codigo.length > 0 && cantidad > 0) {
                $.ajax({
                    url: "{{ route('admin.compras.tmp_compras') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: codigo,
                        cantidad: cantidad
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ proveedores",
            "infoEmpty": "Mostrando de 0 a 0 de 0 Proveedores",
            "infoFiltered": "(Filtrado de _MAX_ total proveedores)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ proveedores",
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