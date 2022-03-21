<?php

namespace App\Http\Livewire\Facility\Units;

use App\Repositories\FacilityRepository;
use App\Repositories\FacilityUnitRepository;
use Livewire\Component;

class FacilityUnitCreate extends Component
{
    public $color;
    public $name;
    public $description;

    protected $facilityUnitRepository;

    protected $rules = [
        'color' => ['required', 'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3}|[a-fA-F0-9]{8}|[a-fA-F0-9]{4})$/'],
        'name'  => 'required',
        'description'  => 'required',
    ];

    public function render()
    {
        return view('livewire.facility.units.facility-unit-create');
    }

    public function boot(FacilityUnitRepository $facilityUnitRepository){

        $this->facilityUnitRepository = $facilityUnitRepository;
    }


    public function mount($facilityId){
        $this->facility_id = $facilityId;
    }



    public function save(){

        $this->validate();

        $this->facilityUnitRepository->create([
            'facility_id' => $this->facility_id,
            'name'  => $this->name,
            'description'  => $this->description,
            'color'  => $this->color,
        ]);

       $this->emitUp('show','showList');


    }

}
