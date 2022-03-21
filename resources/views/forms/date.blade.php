<div class="{!! $parentDiv !!}">
        <label for="{!! $name !!}" class="form-label {!! $label_class ?? '' !!}">{!! $label ?? '<br>' !!}</label>
    <div class="relative">
        <div class="absolute rounded-l w-10 h-full flex items-center justify-center  text-gray-600 dark:bg-dark-1 dark:border-dark-4">
            {!! $icon !!}
        </div>
        {!! Form::input($type, $name, $value , $options ) !!}
    </div>

    @error($name)
        <div class="pristine-error text-danger">
            <small>
                {{$message}}
            </small>
        </div>
    @enderror
</div>

