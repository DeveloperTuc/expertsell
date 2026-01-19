@extends('adminlte::page')

@section('content_header')
<h1><b>Editar datos de usuario</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('/admin/usuarios',$usuario->id)}}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="role">Nombre del rol</label>
                                <select name="role" id="" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $role->name == $usuario->roles('name')->pluck('name')->implode(', ') ? 'selected':'' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Nombre del usuario</label>
                                <input type="text" class="form-control" name="name" value="{{ $usuario->name }}" autocomplete="off" required>
                                @error('name')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>
                                @error('email')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" value="{{ old('name') }}" autocomplete="new-password" >
                                @error('password')
                                    <small style="...">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="password_confirmation">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" >
                                @error('password')
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
                                <a href="{{ url('/admin/usuarios') }}" class="btn btn-secondary">Volver</a>
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