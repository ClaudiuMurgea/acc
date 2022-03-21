<?php

namespace App\Http\Livewire\Facility\Units;

use App\Models\Facility;
use Livewire\Component;

class FacilityUnitsComponent extends Component
{

    public $showCreate = false;
    public $showList = true;
    public $showEdit = false;
    public $title;
    public $unitId;


    protected $listeners = ['show'];

    public function render()
    {
        return view('livewire.facility.units.facility-units-component');
    }


    public function mount($facilityId){

        $this->facility_id = $facilityId;
        $this->title = __('lang.manage_what',['what' => 'Units']);
    }

    public function show($show,$unitId = null){

        $this->hideAll();
        $this->$show = true;

        if ($show == 'showList'){

            $this->title = __('lang.manage_what',['what' => 'Units']);

        }elseif ($show == 'showCreate'){
            $this->title = __('lang.action_unit',['action' => 'Add']);
        }elseif ($show == 'showEdit'){
            $this->title = __('lang.action_unit',['action' => 'Edit']);
            $this->unitId = $unitId;
        }
    }

    private function hideAll(){
        $this->showList = false;
        $this->showCreate = false;
        $this->showEdit = false;
        $this->showTest = false;
    }
}
