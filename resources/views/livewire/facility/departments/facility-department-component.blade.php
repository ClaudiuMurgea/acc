<div class="pos intro-y grid grid-cols-12 gap-5 mt-10">
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <h2 class="text-lg font-medium truncate mr-5">{!! $title !!}</h2>
    </div>
    @if($showList)
        <livewire:facility.departments.facility-department-list :facilityId="$facility_id" />
    @elseif($showCreate)
        <livewire:facility.departments.facility-department-create :facilityId="$facility_id" />
    @elseif($showEdit)
        <livewire:facility.departments.facility-department-edit :facilityId="$facility_id" :departmentId="$departmentId"/>
    @endif
</div>
