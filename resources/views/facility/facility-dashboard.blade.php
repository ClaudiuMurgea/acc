{{--
@extends('../layout/'.$layout)

@section('subhead')
    <title>{!! env('APP_NAME') !!}</title>
@endsection

@section('subcontent')

    @switch($type)
        @case('units')
            <livewire:facility.units.facility-units-component :facilityId="$facility->id" />
        @break

        @case('dashboard')
        <livewire:facility.facility-dashboard-component :facilityId=1 />
        @break
    @endswitch




@endsection
--}}
