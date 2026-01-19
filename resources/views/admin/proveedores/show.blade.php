@extends('adminlte::page')

@section('content_header')
<h1><b>Datos registrados </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Nombre del proveedor</label>
                                <p class="form-control">{{ $proveedor->nombre }}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <p class="form-control">{{ $proveedor->celular }}</p>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="empresa">Empresa</label>
                                <p class="form-control">{{ $proveedor->empresa }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <p class="form-control">{{ $proveedor->direccion }}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <p class="form-control">{{ $proveedor->telefono }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <p class="form-control">{{ $proveedor->correo }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{ url('/admin/proveedores') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </div>
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


@stop