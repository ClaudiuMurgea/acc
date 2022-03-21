<div class="{!! $parentDiv !!}">
    <label for="{!! $name !!}" class="form-label {!! $label_class !!}">{!! $label !!}</label>
    {!! Form::select($name,  $values , null, $options  ) !!}
    @error($name)
    <div class="pristine-error text-danger">
        <small>
            {{$message}}
        </small>
    </div>
    @enderror
</div>
