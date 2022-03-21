<?php

namespace App\Http\Livewire\Facility\Units;

use App\Models\FacilityUnit;
use App\Repositories\FacilityUnitRepository;
use Livewire\Component;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class FacilityUnitEdit extends Component
{
    use LivewireAlert;
    public $color;
    public $name;
    public $description;

    protected $facilityUnitRepository;
    protected $listeners = [
        'confirmed'
    ];
    protected $rules = [
        'color' => ['required', 'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3}|[a-fA-F0-9]{8}|[a-fA-F0-9]{4})$/'],
        'name'  => 'required',
        'description'  => 'required',
    ];

    public function render()
    {
        return view('livewire.facility.units.facility-unit-edit');
    }

    public function mount($facilityId,$unitId){

        $this->facility_id = $facilityId;
        $this->unit = FacilityUnit::find($unitId);

        $this->color = $this->unit->color;
        $this->name = $this->unit->name;
        $this->description = $this->unit->description;
    }

    public function boot(FacilityUnitRepository $facilityUnitRepository){

        $this->facilityUnitRepository = $facilityUnitRepository;
    }


    public function edit(){

        $this->validate();

        $this->facilityUnitRepository->update(
                $this->unit->id,
            [
            'name'  => $this->name,
            'description'  => $this->description,
            'description'  => $this->description,
            'color'  => $this->color,
        ]);

        $this->emitUp('show','showList');
    }

    public function delete($id){

            $this->unitId = $id ;
            $this->confirm('Are you sure want to delete?', [
                'showConfirmButton' => true,
                'confirmButtonText' => 'Yes',
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancel',
                'position' => 'center',
                'timer' => '20000',
                'confirmButtonColor' => '#2C7BE5',
                'allowOutsideClick' => false,
            ]);
    }
    public function confirmed(){

        $this->facilityUnitRepository->deleteById($this->unitId);
        $this->emitUp('show','showList');
    }
}
