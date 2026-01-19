@extends('adminlte::page')

@section('content_header')
<h1><b>Bienvenido {{$empresa->nombre_empresa}}</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url('/admin/roles') }}" class="info-box-icon bg-info">
                <span><i class="fas fa-user-check"></i></span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Roles registrados</span>
                <span class="info-box-number">{{ $total_roles }} roles</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url('/admin/usuarios') }}" class="info-box-icon bg-primary">
                <span><i class="fas fa-users"></i></span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Usuarios registrados</span>
                <span class="info-box-number">{{ $total_usuarios }} usuarios</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url('/admin/categorias') }}" class="info-box-icon bg-success">
                <span><i class="fas fa-tags"></i></span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Categorías registradas</span>
                <span class="info-box-number">{{ $total_categorias }} categorias</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url('/admin/productos') }}" class="info-box-icon bg-warning">
                <span><i class="fas fa-list"></i></span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Productos registrados</span>
                <span class="info-box-number">{{ $total_productos }} productos</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>


</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box zoomP">
            <a href="{{ url('/admin/proveedores') }}" class="info-box-icon bg-secondary">
                <span><i class="fas fa-user-tie"></i></span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Proveedores registrados</span>
                <span class="info-box-number">{{ $total_proveedores }} proveedores</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
@stop

@section('css')

@stop

@section('js')


@stop