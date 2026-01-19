@extends('adminlte::page')

@section('content_header')
<h1><b>Registro de un nuevo producto</b></h1>
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
                <form action="{{url('/admin/productos/create')}}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="row">
                        <!--imagen-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" id="file" name="imagen" accept=".png, .jpg, .jpeg" class="form-control" >
                                @error('imagen')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <br>
                                <center><output id="list"></output></center>
                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files; //FileList object
                                        //Obtenemos la imagen del campo "file"
                                        for (var i = 0, f; f = files[i]; i++) {
                                            //Solo admitimos imagenes
                                            if (!f.type.match('image.*')) {
                                                continue;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = (function (theFile) {
                                                return function (e) {
                                                    //Insertamos la imagen
                                                    document.getElementById("list").innerHTML = `<img class="thumb thumbnail" src="${e.target.result}" width="70%" title="${escape(theFile.name)}"/>`;

                                                }
                                            })(f);
                                            reader.readAsDataURL(f);
                                        }
                                    }
                                    document.getElementById('file').addEventListener('change', archivo, false);
                                </script>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <!--categoria-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoria_id">Categoría</label>
                                        <select name="categoria_id" id="" class="form-control">
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--codigo-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}"
                                            autocomplete="off" required>
                                            @error('codigo')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <!--nombre-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del producto</label>
                                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                                            required>
                                            @error('nombre')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--precio de compra-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precio_compra">Precio de compra</label>
                                        <input type="text" class="form-control" name="precio_compra" value="{{ old('precio_compra') }}"
                                            required>
                                            @error('precio_compra')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <!--precio de venta-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio de venta</label>
                                        <input type="text" class="form-control" name="precio_venta" value="{{ old('precio_venta') }}"
                                            required>
                                            @error('precio_venta')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <!--stock-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" name="stock" value="{{ old('stock') }}"
                                            required>
                                            @error('stock')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <!--stock minimo-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock_minimo">Stock mínimo</label>
                                        <input type="number" class="form-control" name="stock_minimo" value="{{ old('stock_minimo') }}"
                                            required>
                                            @error('stock_minimo')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <!--stock maximo-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="stock_maximo">Stock máximo</label>
                                        <input type="number" class="form-control" name="stock_maximo" value="{{ old('stock_maximo') }}"
                                            required>
                                            @error('stock_maximo')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--descripcion-->
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion"
                                            value="{{ old('descripcion') }}" autocomplete="off" required>
                                            @error('descripcion')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
                                <!--fechad de ingreso-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha_ingreso">Fecha de ingreso</label>
                                        <input type="date" class="form-control" name="fecha_ingreso"
                                            value="{{ old('fecha_ingreso') }}" autocomplete="off" required>
                                            @error('fecha_ingreso')
                                                <small style="...">{{$message}}</small>
                                            @enderror
                                    </div>
                                </div>
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
                                <a href="{{ url('/admin/productos') }}" class="btn btn-secondary">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')


@stop