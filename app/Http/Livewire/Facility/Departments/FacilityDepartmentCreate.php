<?php

namespace App\Http\Livewire\Facility\Departments;

use App\Repositories\DepartmentRepository;
use App\Repositories\FacilityUnitRepository;
use Livewire\Component;

class FacilityDepartmentCreate extends Component
{
    protected $departmentRepository;

    public $name;
    public $description;
    protected $rules = [
        'name'  => 'required',
        'description'  => 'required',
    ];



    public function render()
    {
        return view('livewire.facility.departments.facility-department-create');
    }

    public function boot(DepartmentRepository $departmentRepository){

        $this->departmentRepository = $departmentRepository;
    }

    public function mount($facilityId){
        $this->facility_id = $facilityId;
    }

    public function save(){
        $this->validate();

        $this->departmentRepository->create([
            'facility_id' => $this->facility_id,
            'name'  => $this->name,
            'description'  => $this->description,

        ]);

        $this->emitUp('show','showList');
    }

}
