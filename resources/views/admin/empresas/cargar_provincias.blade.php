<select name="provincia" id="select_provincia" class="form-control">
    @foreach($provincias as $provincia)
        <option value="{{$provincia->id}}">{{$provincia->name}}</option>
    @endforeach
</select>
@error('provincia')
    <small style="color: red;">{{$message}}</small>
@enderror