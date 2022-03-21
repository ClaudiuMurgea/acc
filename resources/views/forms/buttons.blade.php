<div class="{!! $parentDiv !!}">
    @foreach($buttons as $button)
        @if(isset($button['nolabel']))
            <br>
        @endif
        {!! Form::button($button['label'],$button['options']) !!}
        @if(isset($button['name']))
            @error($button['name'])
            <div class="pristine-error font-small text-danger text-sm">
               <small> {{$message}}</small>
            </div>
            @enderror
        @endif
    @endforeach

</div>
