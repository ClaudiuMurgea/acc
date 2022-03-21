<div class="{!! $parentDiv !!}" {!! isset($ignore) && $ignore == true ? 'wire:ignore' : '' !!}>
    @if($label != false && $label != null)
        <label for="{!! $name !!}" class="form-label {{ $label_class ?? '' }}">{!! $label !!}</label>
    @endif

    {!! Form::select($name,  $values ,$selected ?? null, $options  ) !!}

    @error($name)
    <div class="pristine-error text-danger mt-2">
        <small>
            {{$message}}
        </small>
    </div>
    @enderror
</div>
