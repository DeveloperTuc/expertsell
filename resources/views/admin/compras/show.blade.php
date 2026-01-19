@extends('adminlte::page')

@section('content_header')
<h1><b>Detalle de la compra</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary col-md-12">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-md-12">
                <div class="row">
                    <table id="mi_tabla" class="table table-sm table-striped table-bordered table-hover col-md-6">
                        <thead class="table-dark">
                            <th scope="col">Nro</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre de producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Total</th>
                        </thead>
                        <tbody>
                            <?php $cont = 1; $cantidad = 0; $total = 0;?>
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
                                </tr>
                                @php
                                    $cantidad += $detalle->cantidad;
                                    $total += $costo;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfooter>
                            <td colspan="2" style="text-align: right"></td>
                            <td style="text-align: right"><b>Total Cantidad</b></td>
                            <td style="text-align: center"><b>{{ $cantidad }}</b></td>
                            <td style="text-align: right"><b>Total Compra</b></td>
                            <td style="text-align: center"><b>$ {{ $total }}</b></td>
                        </tfooter>
                    </table>
                    <div class="col-md-6 mt-5 ms-2 p-2">
                        <div class="row">
                            <label for="" class="form-control col-md-4">Fecha</label>
                            <input type="date" class="form-control col-md-6" value="{{ $compra->fecha }}" name="fecha" disabled>
                        </div>
                        <div class="row">
                            <label for="" class="form-control col-md-4">Comprobante</label>
                            <input type="text" class="form-control col-md-6" value="{{ $compra->comprobante }}" name="comprobante" disabled>
                        </div>
                        <div class="row">
                            <label for="" class="form-control col-md-4">Proveedor</label>
                            <input type="text" class="form-control col-md-6" value="{{ $compra->detalles->first()->proveedor->empresa }}" name="proveedor" disabled>
                        </div>
                    </div>
                    <hr>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a href="{{ url('/admin/compras') }}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.card-body -->

        </div><!-- /.card -->

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
    $('#mi_tabla').DataTable({
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