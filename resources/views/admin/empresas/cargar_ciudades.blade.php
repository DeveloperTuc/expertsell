<select name="ciudad" id="select_ciudad" class="form-control">
    @foreach($ciudades as $ciudad)
        <option value="{{$ciudad->id}}">{{$ciudad->name}}</option>
    @endforeach
</select>
@error('ciudad')
    <small style="color: red;">{{$message}}</small>
@enderror