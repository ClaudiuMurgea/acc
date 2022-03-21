<?php

namespace App\Http\Livewire\Facility\Schedule;

use Livewire\Component;

class DailyUnitAssignment extends Component
{
    public function render()
    {
        return view('livewire.facility.schedule.daily-unit-assignment');
    }

    public function mount($id)
    {
        dd($id);
    }
}
