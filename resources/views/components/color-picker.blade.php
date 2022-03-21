<div

    x-data="{ color: '{!! $color ?? '#ffffff' !!}'}"
    x-init="

        picker = new Picker($refs.button);
        picker.onDone = rawColor => {
            color = rawColor.hex;
            $dispatch('input', color)
        }
    "
    wire:ignore
    {{ $attributes }}
>
    <button class="btn btn-default mt-5" :style="`background: ${color}`" x-ref="button">{!! __('lang.unit_color') !!}</button>
</div>
