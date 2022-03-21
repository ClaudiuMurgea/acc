<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Models\Company;
use App\Services\CompanyService;
use Livewire\Component;

class CompanyShiftScheduleComponent extends Component
{

    public $days;

    public $usdays =  [
        'Sunday' => false,
        'Monday' => false,
        'Tuesday' => false,
        'Wednesday' => false,
        'Thursday' => false,
        'Friday' => false,
        'Saturday' => false,

    ];

    public $eudays =  [
        'Monday' => false,
        'Tuesday' => false,
        'Wednesday' => false,
        'Thursday' => false,
        'Friday' => false,
        'Saturday' => false,
        'Sunday' => false,
    ];
    public function render(CompanyService $companyService)
    {
        $data = [
            'current_step'  => 6,
            'page_title'    => __('lang.review_standard_shift'),
            'page_description'  => __('lang.review_standard_shift_description'),
            'steps'             => $this->steps
        ];
        $this->timeFormat = auth()->user()->Company->am_pm  ? "h:m A": "H:m";
        $this->shifts =   $companyService->shifts($this->companyId,$this->eudays,$this->timeFormat);
        $this->days = parseShifts($this->shifts,$this->week_start,$this->timeFormat);



        return view('livewire.company.register-steps.company-shift-schedule-component',compact('data'));
    }

    public function mount($companyId,$steps){

        $this->company = Company::find($companyId);
        $this->companyId = $this->company->id;
        $this->week_start = $this->company->week_start;
        $this->timeFormat = auth()->user()->Company->am_pm  ? "h:m A": "H:m";
        $this->emit('settimeFormat',$this->timeFormat);

        $this->steps = $steps;

    }

    public function save(){


       $this->emit('changeStep',7);
    }
}
