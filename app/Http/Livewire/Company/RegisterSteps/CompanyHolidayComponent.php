<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Models\Company;
use App\Models\CompanyHoliday;
use App\Services\CompanyHolidayService;
use Livewire\Component;

class CompanyHolidayComponent extends Component
{

    public $holidays = [];
    public $modal = false;
    public $company_holidays;
    public $subscribedHolidays;

    public $listeners = ['reloadHoliday'];

    public function render()
    {

        $data = [
            'current_step'  => 3,
            'page_title'    => __('lang.holiday_setup'),
            'page_description'  => __('lang.holiday_setup_description'),
            'steps'             => $this->steps
        ];
        $this->company_holidays = $this->company->Holidays;

        $this->legalHolidays = getPlatformHolidays();

        return view('livewire.company.register-steps.company-holiday-component',compact('data'));
    }

    public function reloadHoliday(){
        $this->company_holidays = $this->company->Holidays;
    }

    public function subscribeHoliday($holiday_id,CompanyHolidayService $CompanyHolidayService){


        $CompanyHolidayService->Subscription(
            $this->companyId,
            $holiday_id
        );
        $this->subscribeHolidays();

    }

    public function subscribeHolidays(){
        return $this->subscribedHolidays = CompanyHoliday::where('company_id',$this->companyId)->pluck('holiday_id')->toArray();
    }

    public function mount($companyId,$steps){
        $this->company = Company::with('Holidays')->find($companyId);
        $this->companyId = $companyId;

        $this->subscribedHolidays = $this->company->SubscribedHolidays->pluck('holiday_id')->toArray();

        $this->steps = $steps;

    }

    public function save(){
        $this->emit('changeStep',4,$this->companyId);
    }
}
