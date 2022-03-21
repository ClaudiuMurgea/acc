<div class="flex justify-center">
    @for($i=1;$i<=count($data['steps']);$i++)
        <button
            class="intro-y w-10 h-10 rounded-full btn
            {!!
                ($data['current_step'] != $i && $i > auth()->user()->registration_step) ?
                        'bg-gray-200 dark:bg-dark-1 text-gray-600'
                        :
                        ($data['current_step'] == $i ? 'btn-primary' : 'btn-twitter ')

            !!}  mx-2"
            @if($data['current_step'] != $i && $i > auth()->user()->registration_step)
            disabled
            @else
            wire:click="$emit('changeStep',{!! $i !!})"
            @endif
        >
            {!! $i !!}
        </button>
    @endfor

</div>
