<select name="codigo_postal" id="select_codigo" class="form-control">
    @foreach($codigos as $codigo)
        <option value="{{$codigo->phone_code}}">{{$codigo->phone_code}}</option>
    @endforeach
</select>
@error('codigo_postal')
    <small style="color: red;">{{$message}}</small>
@enderror