@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Configuraciones/Editar</h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- Card Box --}}
        <div class="card card-outline card-success" style="box-shadow: 5px 5px 5px 5px #cccccc">

            {{-- Card Header --}}
            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none">
                    <b>Datos Registrados</b>
                </h3>
            </div>

            {{-- Card Body --}}
            <div class="card-body {{ $authType }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                <form action="{{url('/admin/configuracion', $empresa->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" id="file" name="logo" accept=".png, .jpg, .jpeg"
                                    class="form-control"> <!--required-->
                                @error('logo')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <br>
                                <center><output id="list">
                                        <img src="{{asset('storage/' . $empresa->logo)}}" width="70%" alt="logo">
                                    </output></center>
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
                                                <option value="{{$pais->id}}" {{$empresa->pais == $pais->id ? 'selected' : ''}}>{{$pais->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('pais')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="provincia">Provincia/Departamento</label>
                                    <select name="provincia" id="select_provincia" class="form-control">
                                        @foreach($provincias2 as $provincia)
                                            <option value="{{$provincia->id}}" {{$empresa->provincia == $provincia->id ? 'selected' : ''}}>{{$provincia->name}}</option>
                                        @endforeach
                                    </select>
                                    <!--<div id="respuesta_pais">

                                            </div>-->
                                </div>
                                <div class="col-md-4">
                                    <label for="ciudad">Ciudad</label>
                                    <select name="ciudad" id="select_ciudad" class="form-control">
                                        @foreach($ciudades2 as $ciudad)
                                            <option value="{{$ciudad->id}}" {{$empresa->ciudad == $ciudad->id ? 'selected' : ''}}>{{$ciudad->name}}</option>
                                        @endforeach
                                    </select>
                                    <!--<div id="respuesta_provincia">

                                            </div>-->
                                </div>

                            </div>
                            <!--********************************************-->
                            <div class="row">

                                <div class="col-md-5">
                                    <label for="nombre_empresa">Nombre de la empresa</label>
                                    <input type="text" name="nombre_empresa" value="{{$empresa->nombre_empresa}}"
                                        class="form-control" required>
                                    @error('nombre_empresa')
                                        <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="tipo_empresa">Tipo de la empresa</label>
                                    <input type="text" name="tipo_empresa" value="{{$empresa->tipo_empresa}}"
                                        class="form-control" required>
                                    @error('tipo_empresa')
                                        <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="identificacion_tributaria">Identificación tributaria</label>
                                        <input type="text" name="identificacion_tributaria"
                                            value="{{$empresa->identificacion_tributaria}}" class="form-control"
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
                                    <input type="text" name="nombre_impuesto" value="{{$empresa->nombre_impuesto}}"
                                        class="form-control" required>
                                    @error('nombre_impuesto')
                                        <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="porcentaje_impuesto">Porcentaje del impuesto</label>
                                        <input type="number" name="porcentaje_impuesto"
                                            value="{{$empresa->porcentaje_impuesto}}" step="0.01" class="form-control"
                                            required>
                                        @error('porcentaje_impuesto')
                                            <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="moneda">Moneda</label>
                                    <select name="moneda" id="select_moneda" class="form-control">
                                        @foreach($monedas2 as $moneda)
                                            <option value="{{$moneda->id}}" {{$empresa->moneda == $moneda->id ? 'selected' : ''}}>{{$moneda->symbol}}</option>
                                        @endforeach
                                    </select>
                                    <!--<div id="respuesta_moneda">

                                            </div>-->
                                </div>
                            </div>
                            <!--********************************************-->
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="codigo_postal">Código país</label>
                                        <select name="codigo_postal" id="select_codigo" class="form-control">
                                            @foreach($codigos as $codigo)
                                                <option value="{{$codigo->phone_code}}" {{$empresa->pais == $codigo->id}}>
                                                    {{$codigo->phone_code}}</option>
                                            @endforeach
                                        </select>
                                        <!--<div id="respuesta_codigo">

                                                </div>-->
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" value="{{$empresa->telefono}}"
                                        class="form-control" required>
                                    @error('telefono')
                                        <small style="color: red;">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-7">
                                    <label for="correo">Correo</label>
                                    <input type="email" name="correo" value="{{$empresa->correo}}" class="form-control"
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
                                        <input type="text" name="direccion" value="{{$empresa->direccion}}"
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
                                    <button type="submit" class="btn btn-success btn-block fw-bold"
                                        style="font-weight: bold;">
                                        Actualizar Datos
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{ url('/admin') }}" class="btn btn-warning"
                                            style="font-weight: bold;">Volver</a>
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
@stop

@section('css')
@stop

@section('js')

<script>
    $('#select_pais').on('change', function () {

        var id_pais = $('#select_pais').val();

        if (id_pais) {

                /*$.ajax({
                    url:"{{url('/admin/configuracion/pais/')}}"+'/'+id_pais,
            type: "GET",
                success: function(data) {
                    //$('#respuesta_pais').html(data);

                    $('#respuesta_pais').html(data.html_provincias);
                    $('#respuesta_moneda').html(data.html_monedas);
                    $('#respuesta_codigo').html(data.html_codigo);

                    $('#select_provincia_2').css('display', 'none');
                    $('#select_ciudad_2').css('display', 'none');
                    $('#select_moneda_2').css('display', 'none');
                    $('#select_codigo_2').css('display', 'none');

                    // Esperar un poco a que se cargue el nuevo select_provincia
                    //setTimeout(function () {
                    $('#select_provincia').trigger('change');
                    //}, 100);
                }
        });*/

    $.ajax({
        url: "{{ url('/admin/configuracion/pais') }}/" + id_pais,
        type: "GET",
        success: function (data) {
            let provincias = data.provincias;
            let monedas = data.monedas;
            let codigos = data.codigos;

            // Provincias
            let provinciaSelect = $('#select_provincia');
            provinciaSelect.empty();
            provincias.forEach(p => {
                provinciaSelect.append(`<option value="${p.id}">${p.name}</option>`);
            });

            // Monedas
            let monedaSelect = $('#select_moneda');
            monedaSelect.empty();
            monedas.forEach(m => {
                monedaSelect.append(`<option value="${m.id}">${m.symbol}</option>`);
            });

            // Códigos
            let codigoSelect = $('#select_codigo');
            codigoSelect.empty();
            codigos.forEach(c => {
                codigoSelect.append(`<option value="${c.phone_code}">${c.phone_code}</option>`);
            });

            $('#select_provincia').trigger('change');

        },
        error: function (xhr) {
            alert('Ocurrió un error al obtener los datos');
            console.error(xhr.responseJSON);
        }
    });
            }else {
        alert("Debe seleccionar un pais")
    }
        });
</script>

<script>

    $(document).on('change', '#select_provincia', function () {
        var id_provincia = $('#select_provincia').val();

        if (id_provincia) {
            $.ajax({
                url: "{{url('/admin/configuracion/provincia/')}}" + '/' + id_provincia,
                type: "GET",
                success: function (data) {

                    //$('#respuesta_provincia').html(data);

                    //$('#select_ciudad_2').css('display', 'none');

                    let ciudades = data.ciudades;

                    let ciudadSelect = $('#select_ciudad');
                    ciudadSelect.empty();
                    ciudades.forEach(c => {
                        ciudadSelect.append(`<option value="${c.id}">${c.name}</option>`)
                    });
                }
            });
        } else {
            alert('Debe seleccionar una provincia/estado');
        }

    });

</script>

<script>

        /*$(document).on('change','#select_provincia',function () {
            var id_provincia = $(this).val();

            if(id_provincia){
                $.ajax({
                    url:"{{url('/admin/configuracion/provincia/')}}"+'/'+id_provincia,
    type: "GET",
        success: function(data) {

            $('#respuesta_provincia').html(data);

            $('#select_ciudad_2').css('display', 'none');
        }
                });
            }else {
        alert('Debe seleccionar una provincia/estado');
    }

        });*/

</script>

<script>

    window.onload = function () {

        //$('#select_pais').trigger('change');
    };

</script>

@stop