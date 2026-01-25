@extends('adminlte::page')

@section('content_header')
<h1><b>Registro de un nuevo cliente</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('/admin/clientes/create')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_cliente">Nombre y apellido</label>
                                <input type="text" class="form-control" name="nombre_cliente" value="{{ old('nombre_cliente') }}" autocomplete="off" required>
                                @error('nombre_cliente')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="identificacion_tributaria">CUIL/CUIT</label>
                                <input type="text" class="form-control" name="identificacion_tributaria" value="{{ old('identificacion_tributaria') }}" autocomplete="off" required>
                                @error('identificacion_tributaria')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
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
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" required>
                                @error('email')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                Registrar
                            </button>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary">Volver</a>
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


@stop