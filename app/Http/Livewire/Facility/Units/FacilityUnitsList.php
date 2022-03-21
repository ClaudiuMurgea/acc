<?php

namespace App\Http\Livewire\Facility\Units;

use App\Models\Facility;
use Livewire\Component;

class FacilityUnitsList extends Component
{
    public function render()
    {
        return view('livewire.facility.units.facility-units-list');
    }

    public function mount($facilityId){

        $this->facility_id = $facilityId;
        $this->facility = Facility::with('Units')->find($this->facility_id);

    }
}
