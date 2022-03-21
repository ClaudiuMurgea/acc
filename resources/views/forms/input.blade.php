<div class="{!! $parentDiv !!}" style="{!! $parentDivStyle ?? '' !!}">
    @if($label != false)
        <label for="{!! $name !!}" class="form-label {!! $label_class ?? '' !!}">{!! $label !!}</label>
    @endif
    {!! Form::input($type, $name, $value , $options ) !!}
    @error($name)
    <div class="pristine-error text-danger">
        <small>
            {{$message}}
        </small>
    </div>
    @enderror
</div>
