<?php

namespace App\Http\Livewire\Facility\Departments;

use App\Models\Facility;
use Livewire\Component;

class FacilityDepartmentList extends Component
{
    public function render()
    {
        return view('livewire.facility.departments.facility-department-list');
    }

    public function mount($facilityId){

        $this->facility_id = $facilityId;
        $this->facility = Facility::with('Departments')->find($this->facility_id);

    }
}
