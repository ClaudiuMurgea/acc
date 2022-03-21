<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Models\Company;
use App\Models\CompanyContractTypes;
use App\Models\EmployeeContractType;
use App\Repositories\CompanyContractTypesRepository;
use App\Services\CompanyContractTypesService;
use Livewire\Component;

class CompanyStaffComponent extends Component
{



    protected $companyContractTypesRepository;
    protected $companyContractTypesService;

    public function render()
    {
        $data = [
            'current_step'  => 4,
            'page_title'    => __('lang.staff_setup'),
            'page_description'  => __('lang.staff_setup_description'),
            'steps'             => $this->steps
        ];
        return view('livewire.company.register-steps.company-staff-component',compact('data'));
    }
    public function mount($companyId,$steps,companyContractTypesRepository $companyContractTypesRepository){
        $this->companyId = $companyId;
        $this->company = Company::find($companyId);
        $this->steps = $steps;

        $this->contract_types = EmployeeContractType::all();
        $this->companyContractTypesRepository = $companyContractTypesRepository;
        $this->subscribeEmployeeTypes();


    }
    public function subscribeEmployeeType($employeeTypeId){

        $this->companyContractTypesService->Subscription(
            $this->companyId,
            $employeeTypeId
        );

        $this->subscribeEmployeeTypes();
    }
    public function booted(CompanyContractTypesRepository $companyContractTypesRepository,CompanyContractTypesService $companyContractTypesService){
        $this->companyContractTypesRepository = $companyContractTypesRepository;
        $this->companyContractTypesService = $companyContractTypesService;
    }

    public function subscribeEmployeeTypes(){
        $this->company_contract_types = $this->companyContractTypesRepository->getByColumn('company_id',$this->companyId,['Type'])->sortBy('order');

        $this->company_contract_types_arr = $this->company_contract_types->pluck('employee_contract_type_id')->toArray();
    }

    public function updateOrder($newOrder) {

        $this->companyContractTypesService->reorder($newOrder,$this->companyId);
        $this->subscribeEmployeeTypes();
    }

    public function save(){
        $this->emit('changeStep',5);
    }
}
