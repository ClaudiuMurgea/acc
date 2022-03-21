<div>
    <div>
        <h2 class="text-lg font-medium truncate mr-5">{!! $title !!}</h2>
    </div>
    @if($showList)
        <livewire:facility.units.facility-units-list :facilityId="$facility_id" />
    @elseif($showCreate)
        <livewire:facility.units.facility-unit-create :facilityId="$facility_id" />
    @elseif($showEdit)
        <livewire:facility.units.facility-unit-edit :facilityId="$facility_id" :unitId="$unitId"/>
    @endif
</div>

