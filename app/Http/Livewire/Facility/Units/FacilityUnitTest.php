<?php

namespace App\Http\Livewire\Facility\Units;

use App\Models\Facility;
use Livewire\Component;

class FacilityUnitTest extends Component
{
    public $monthTotalDays;
    
    //-pto = personal time off - unpaid day off
    public $pto = false;

    //-bdy = birth day
    public $bdy = false;

    //-sck = sick day off
    public $sck = false;

    //-loa = leave of absence - time off from work authorized by the employer
    public $loa = false;

    //-can & -flm => i dont know the meaning
    public $can = false;
    public $flm = false;

    //-dayOff = usual day off
    public $dayOff = [5, 6];

    public function render()
    {
        return view('livewire.facility.units.facility-unit-test', [
            'dayOff' => $this->dayOff,
            'pto'    => $this->pto
        ]);
    }

    public function mount($facilityId)
    {
        $this->monthTotalDays = 30;
        $this->facility_id = $facilityId;
        $this->facility = Facility::with('Units')->find($this->facility_id);
    }

    public function prevDate()
    {
        dd(1);
    }
}
