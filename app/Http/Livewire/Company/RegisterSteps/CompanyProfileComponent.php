<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Services\UserService;
use Livewire\Component;

class CompanyProfileComponent extends Component
{

    protected $userService;

    public $steps = [
        1 => 'details',
        2 => 'billing',
        3 => 'holidays',
        4 => 'staff',
        5 => 'shift',
        6 => 'shiftschedule',
    ] ;
    public $companyId ;

    protected $listeners = ['changeStep','setCompanyId'];

    public function render()
    {

        return view('livewire.company.register-steps.company-profile-component');
    }
    public function mount(){
        $this->companyId = auth()->user()->Company->id ?? null;
        $this->changeStep(auth()->user()->registration_step ?? 1);

        $this->timeFormat = ($this->companyId && auth()->user()->Company->am_pm) ? "hh:mm p": "HH:mm";
    }

    public function setCompanyId($companyId){
        $this->companyId = $companyId;
    }
    public function changeStep($step){


        $this->userService->UpdateRegistrationStep(auth()->user(),$step);
        if ($step > max(array_keys($this->steps))){
            return redirect(route('company.dashboard',$this->companyId))->with('success',__('lang.company_finish_registration'));
        }

        $this->step = $this->steps[$step];

    }

    public function boot(UserService $userService){
        $this->userService = $userService;
    }
}
