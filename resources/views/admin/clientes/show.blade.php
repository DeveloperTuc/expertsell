@extends('adminlte::page')

@section('content_header')
<h1><b>Datos registrados</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombre_cliente">Nombre y apellido</label>
                            <p class="form-control">{{ $cliente->nombre_cliente }}</p>
                            @error('nombre_cliente')
                                <small style="...">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="identificacion_tributaria">CUIL/CUIT</label>
                            <p class="form-control">{{ $cliente->identificacion_tributaria }}</p>
                            @error('identificacion_tributaria')
                                <small style="...">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <p class="form-control">{{ $cliente->telefono }}</p>
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
                            <p class="form-control">{{ $cliente->email }}</p>
                            @error('email')
                                <small style="...">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Volver</a>
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