@extends('adminlte::page')

@section('content_header')
<h1><b>Detalle de la venta</b></h1>
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
                    <div class="col-md-6">
                    <table id="mi_tabla" class="table table-sm table-striped table-bordered table-hover">
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
                                </tr>
                                @php
                                    $cantidad += $detalle->cantidad;
                                    $total += $costo;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right"></td>
                                <td style="text-align: right"><b>Total Cantidad</b></td>
                                <td style="text-align: center"><b>{{ $cantidad }}</b></td>
                                <td style="text-align: right"><b>Total Venta</b></td>
                                <td style="text-align: center"><b>$ {{ $total }}</b></td>
                            </tr>    
                        </tfoot>
                    </table>
                    </div>
                    <div class="col-md-6 mt-5 ms-2 p-2">
                        <div class="row mb-2">
                            <label for="" class="form-control-label col-md-3" style="text-align:right">Fecha</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" value="{{ $venta->fecha }}" name="fecha" disabled>
                            </div>
                        </div>
                        {{-- 
                        <!--
                        <div class="row mb-2">
                            <label for="" class="form-control-label col-md-3" style="text-align:right;">Comprobante</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-6" value="{{ $compra->comprobante }}" name="comprobante" disabled>
                            </div>
                        </div>
                        -->
                        --}}
                        <div class="row mb-2">
                            <label for="" class="form-control-label col-md-3" style="text-align:right">Cliente</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $venta->cliente->nombre_cliente }}" name="cliente" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                                <label class="col-form-label col-md-3" for="identificacion_tributaria" style="text-align:right">CUIL/CUIT</label>
                                <div class="col-md-6">
                                    <input type="text" id="identificacion_tributaria_select" class="form-control" value="{{ $venta->cliente->identificacion_tributaria }}" readonly>
                                    @error('identificacion_tributaria')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>                                
                            </div>
                    </div>
                    <hr>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a href="{{ url('/admin/ventas') }}" class="btn btn-secondary">Volver</a>
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


    $('.btn-seleccionar-cliente').click(function () {
        var cliente = $(this).data('id');
        var empresa = $(this).data('empresa');

        $('#nombre_cliente').val(empresa);
        $('#id_cliente').val(id_cliente);
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

        if (id) {
            $.ajax({
                url: "{{ url('/admin/ventas/create/tmp') }}/" + id,
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

            if (codigo.length > 0 && cantidad > 0) {
                $.ajax({
                    url: "{{ route('admin.ventas.tmp_ventas') }}",
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

@stop