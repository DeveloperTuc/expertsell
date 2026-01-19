@extends('adminlte::page')

@section('content_header')
<h1><b>Registro de una nueva categoría</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('/admin/categorias/create')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Nombre de la categoria</label>
                                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" autocomplete="off" required>
                                @error('nombre')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" autocomplete="off" required>
                                @error('descripcion')
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
                                <a href="{{ url('/admin/categorias') }}" class="btn btn-secondary">Volver</a>
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