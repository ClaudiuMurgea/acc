<label class="relative col-span-4 mt-2">
        {!! Form::input($type, $name, $value , $options ) !!}
    {!! $icon !!}
    @error($name)
    <div class="pristine-error text-danger">
        <small>
            {{$message}}
        </small>
    </div>
    @enderror
</label>
