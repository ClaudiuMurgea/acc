@extends('../layout/'.$layout)

@section('subhead')
    <title>{!! env('APP_NAME') !!}</title>
@endsection

@section('subcontent')

    @switch($type)
        @case('units')
            <livewire:facility.units.facility-units-component :facilityId="$facility->id" />
        @break
        @case('test')
            <livewire:facility.units.facility-unit-test :facilityId="$facility->id" />
        @break
        @case('dashboard')
         <livewire:facility.facility-dashboard-component :facilityId=1 />
        @break
        @case('departments')
            <livewire:facility.departments.facility-department-component :facilityId="$facility->id" />
        @break
    @endswitch

@endsection
@push('scripts')
    <script src="https://unpkg.com/vanilla-picker@2"></script>
@endpush
