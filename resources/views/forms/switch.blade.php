@if(isset($parentDiv))
<div class="{!! $parentDiv !!}">
@endif
    @if(isset($label))
        <label for="{!! $name !!}" class="form-check-label ml-0" >{!! $label !!}</label>
    @endif
    {!! Form::input('checkbox', $name,1,$options) !!}
@if(isset($parentDiv))
</div>
@endif

