@extends('adminlte::master')

@php
    $authType = $authType ?? 'login';
    $dashboardUrl = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home');

    if (config('adminlte.use_route_url', false)) {
        $dashboardUrl = $dashboardUrl ? route($dashboardUrl) : '';
    } else {
        $dashboardUrl = $dashboardUrl ? url($dashboardUrl) : '';
    }

    $bodyClasses = "{$authType}-page";

    if (!empty(config('adminlte.layout_dark_mode', null))) {
        $bodyClasses .= ' dark-mode';
    }
@endphp

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body'){{ $bodyClasses }}@stop

@section('body')
<div class="container"><!--{{ $authType }}-box-->

    <br>

    {{-- Logo --}}
    <center>
        <img src="{{asset('/images/logo_expert_sell.png')}}" width="250px" alt="">
    </center>
    <br>

    <div class="row">
        <div class="col-md-12">
            {{-- Card Box --}}
            <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}"
                style="box-shadow: 5px 5px 5px 5px #cccccc">

                {{-- Card Header --}}
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                        <b>Registro de una nueva empresa</b>
                    </h3>
                </div>

                {{-- Card Body --}}
                <div class="card-body {{ $authType }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    <form action="{{url('crear-empresa/create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        < class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="file" name="logo" accept=".png, .jpg, .jpeg"
                                        class="form-control" required>
                                    @error('logo')
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pais">País</label>
                                            <select name="pais" id="select_pais" class="form-control">
                                                @foreach($paises as $pais)
                                                    <option value="{{$pais->id}}">{{$pais->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('pais')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provincia">Provincia/Departamento</label>
                                        <div id="respuesta_pais">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="ciudad">Ciudad</label>
                                        <div id="respuesta_provincia">

                                        </div>
                                    </div>

                                </div>
                                <!--********************************************-->
                                <div class="row">

                                    <div class="col-md-5">
                                        <label for="nombre_empresa">Nombre de la empresa</label>
                                        <input type="text" name="nombre_empresa" value="{{old('nombre_empresa')}}"
                                            class="form-control" required>
                                        @error('nombre_empresa')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="tipo_empresa">Tipo de la empresa</label>
                                        <input type="text" name="tipo_empresa" value="{{old('tipo_empresa')}}"
                                            class="form-control" required>
                                        @error('tipo_empresa')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="identificacion_tributaria">Identificación tributaria</label>
                                            <input type="text" name="identificacion_tributaria"
                                                value="{{old('identificacion_tributaria')}}" class="form-control"
                                                required>
                                            @error('identificacion_tributaria')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <!--********************************************-->
                                <div class="row">

                                    <div class="col-md-6">
                                        <label for="nombre_impuesto">Nombre del impuesto</label>
                                        <input type="text" name="nombre_impuesto" value="{{old('nombre_impuesto')}}"
                                            class="form-control" required>
                                        @error('nombre_impuesto')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="porcentaje_impuesto">Porcentaje del impuesto</label>
                                            <input type="number" name="porcentaje_impuesto"
                                                value="{{old('porcentaje_impuesto')}}" step="0.01" class="form-control"
                                                required>
                                            @error('porcentaje_impuesto')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="moneda">Moneda</label>
                                        <div id="respuesta_moneda">

                                        </div>
                                    </div>
                                </div>
                                <!--********************************************-->
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="codigo_postal">Código país</label>
                                            <div id="respuesta_codigo">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" value="{{old('telefono')}}"
                                            class="form-control" required>
                                        @error('telefono')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-7">
                                        <label for="correo">Correo</label>
                                        <input type="email" name="correo" value="{{old('correo')}}" class="form-control"
                                            required>
                                        @error('correo')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>

                                </div>
                                <!--********************************************-->
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Dirección </label>
                                            <input type="text" name="direccion" value="{{old('direccion')}}"
                                                class="form-control" required>
                                            @error('direccion')
                                                <small style="color: red;">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-block fw-bold"
                                            style="font-weight: bold;">
                                            Crear Empresa
                                        </button>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <a href="{{ url('/admin') }}" class="btn btn-warning" style="font-weight: bold;">Volver</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                {{-- Card Footer --}}
                @hasSection('auth_footer')
                    <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                        @yield('auth_footer')
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')

<script>
    $('#select_pais').on('change', function () {

        var id_pais = $('#select_pais').val();

        if (id_pais) {

            $.ajax({
                url: "{{url('/crear-empresa/pais/')}}" + '/' + id_pais,
                type: "GET",
                success: function (data) {
                    //$('#respuesta_pais').html(data);

                    console.log(data);

                    $('#respuesta_pais').html(data.html_provincias);
                    $('#respuesta_moneda').html(data.html_monedas);
                    $('#respuesta_codigo').html(data.html_codigo);


                    // Esperar un poco a que se cargue el nuevo select_provincia
                    //setTimeout(function () {
                    $('#select_provincia').trigger('change');
                    //}, 100);
                }
            });

        } else {
            alert("Debe seleccionar un pais")
        }
    });
</script>

<script>

    $(document).on('change', '#select_provincia', function () {
        var id_provincia = $(this).val();
        //alert(id_provincia);

        if (id_provincia) {
            $.ajax({
                url: "{{url('/crear-empresa/provincia/')}}" + '/' + id_provincia,
                type: "GET",
                success: function (data) {
                    $('#respuesta_provincia').html(data);
                }
            });
        } else {
            alert('Debe seleccionar una provincia/estado');
        }

    });

</script>

<script>

    /*$(document).ready(function () {
        // Dispara el cambio del país automáticamente al cargar la página
        $('#select_pais').trigger('change');
    });*/

    window.onload = function () {
        $('#select_pais').trigger('change');
    };

</script>


@stop