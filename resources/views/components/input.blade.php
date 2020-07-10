<div class="form-group {{$col}}">
    <label class="control-label">{{Str::title($name)}}</label>
    <input type="{{$type}}" name="{{$name}}" class="form-control {{$class ?? ''}}" value="{{$value}}" />
</div>