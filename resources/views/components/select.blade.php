<div class="form-group  {{$col}}">
    <label class="control-label" for="name">{{Str::title($name)}}</label>
    <select class="form-control select2" id="{{$name}}_id" name="{{$name}}_id">
        <option value="">Select {{Str::title($name)}}</option>
        @foreach($model as $value)
        <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach
    </select>
</div>