@extends('adminlte::page')

@section('content_header')
<h1><b>Producto registrado</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                    <div class="row">
                        <!--imagen-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <img src="{{ asset('storage/'.$producto->imagen) }}" class="img-fluid" alt="imagen de producto">
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <!--categoria-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoria_id">Categoría</label>
                                        <p class="form-control">{{ $producto->categoria->nombre }}</p>
                                    </div>
                                </div>
                                <!--codigo-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <p class="form-control">{{ $producto->codigo }}</p>
                                    </div>
                                </div>
                                <!--nombre-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del producto</label>
                                        <p class="form-control">{{ $producto->nombre }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--precio de compra-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precio_compra">Precio de compra</label>
                                        <p class="form-control">{{ $producto->precio_compra }}</p>
                                    </div>
                                </div>
                                <!--precio de venta-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio de venta</label>
                                        <p class="form-control">{{ $producto->precio_venta }}</p>
                                    </div>
                                </div>
                                <!--stock-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <p class="form-control">{{ $producto->stock }}</p>
                                    </div>
                                </div>
                                <!--stock minimo-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock_minimo">Stock mínimo</label>
                                        <p class="form-control">{{ $producto->stock_minimo }}</p>
                                    </div>
                                </div>
                                <!--stock maximo-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock_maximo">Stock máximo</label>
                                        <p class="form-control">{{ $producto->stock_maximo }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--descripcion-->
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <p class="form-control">{{ $producto->descripcion }}</p>
                                    </div>
                                </div>
                                <!--fechad de ingreso-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha de ingreso</label>
                                        <p class="form-contrll">{{ $producto->fecha_ingreso }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop