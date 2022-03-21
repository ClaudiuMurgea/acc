<?php

namespace App\Http\Livewire\Facility\Departments;

use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FacilityDepartmentEdit extends Component
{

    use LivewireAlert;

    public $name;
    public $description;

    protected $departmentRepository;
    protected $listeners = [
        'confirmed'
    ];
    protected $rules = [
        'name'  => 'required',
        'description'  => 'required',
    ];
    public function render()
    {
        return view('livewire.facility.departments.facility-department-edit');
    }

    public function mount($facilityId,$departmentId){

        $this->department_id = $facilityId;
        $this->department = Department::find($departmentId);
        $this->name = $this->department->name;
        $this->description = $this->department->description;
    }

    public function boot(DepartmentRepository $departmentRepository){

        $this->departmentRepository = $departmentRepository;
    }


    public function edit(){

        $this->validate();

        $this->departmentRepository->update(
            $this->department->id,
            [
                'name'  => $this->name,
                'description'  => $this->description,

            ]);

        $this->emitUp('show','showList');
    }

    public function delete($id){

        $this->departmentId = $id ;
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

        $this->departmentRepository->deleteById($this->departmentId);
        $this->emitUp('show','showList');
    }
}
