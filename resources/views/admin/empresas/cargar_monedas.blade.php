<select name="moneda" id="select_moneda" class="form-control">
    @foreach($monedas as $moneda)
        <option value="{{$moneda->id}}">{{$moneda->symbol}}</option>
    @endforeach
</select>
@error('moneda')
    <small style="color: red;">{{$message}}</small>
@enderror