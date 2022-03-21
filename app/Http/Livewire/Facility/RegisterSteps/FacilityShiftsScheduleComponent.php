<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Repositories\FacilityRepository;
use App\Services\CompanyService;
use Livewire\Component;

class FacilityShiftsScheduleComponent extends Component
{
    public $days;
    protected $facilityRepository;
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


    protected $listeners = ['toggleDefaultShift'];

    public function render(CompanyService $companyService)
    {
        $data = [
            'current_step'          => 4,
            'page_title'            => __('lang.review_standard_shift'),
            'page_description'      => __('lang.review_standard_shift_description'),
            'steps'                 => $this->steps,
            'registration_step'     => $this->facility->registration_step
        ];
        $this->timeFormat = auth()->user()->Company->am_pm  ? "h:i A": "H:i";
        $this->shifts =   $companyService->shifts($this->facility->Company->id,$this->eudays,$this->timeFormat);


        $this->days = parseShifts($this->shifts,$this->week_start,$this->hour_format);
        return view('livewire.facility.register-steps.facility-shifts-schedule-component',compact('data'));

    }
    public function boot(FacilityRepository $facilityRepository){
        $this->facilityRepository = $facilityRepository;
    }

    public function mount($facilityId,$steps,$defaultShift){

        $this->facility = $this->facilityRepository->findById($facilityId,['*'],['Company','ShiftGroups']);
        $this->facilityId = $facilityId;
        $this->defaultShift = $defaultShift;

        $this->steps = $steps;
        $this->week_start = $this->facility->Company->week_start;

        $this->hour_format = $this->facility->Company->am_pm ? 'H:i A' : 'H:i';
    }

    public function toggleDefaultShift($val){
        $this->defaultShift = $val;
    }

}
