<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Repositories\FacilityRepository;
use App\Services\CompanyService;
use Livewire\Component;

class FacilityPreviewShiftsScheduleComponent extends Component
{
    protected $facilityRepository;
    protected $companyService;
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
    public function render()
    {
        $data = [
            'current_step'  => 4,
            'page_title'    => __('lang.review_standard_shift'),
            'page_description'  => __('lang.review_standard_shift_description'),
        ];

        return view('livewire.facility.register-steps.facility-preview-shifts-schedule-component',compact('data'));
    }
    public function mount($facilityId){

        $this->facility = $this->facilityRepository->findById($facilityId,['*'],['Company','ShiftGroups']);
        $this->week_start = $this->facility->Company->week_start;
        $this->hour_format = $this->facility->Company->am_pm ? 'H:i A' : 'H:i';

        if ($this->facility->default_shift_type){

            $this->shifts =   shifts($this->facility->Company,$this->facility->Company->week_start ? $this->eudays : $this->usdays);
        }else{

            $this->shifts =   shifts($this->facility,$this->facility->Company->week_start ? $this->eudays : $this->usdays);
        }

        $this->days = parseShifts($this->shifts,$this->week_start,$this->hour_format);



    }

    public function boot(FacilityRepository $facilityRepository,CompanyService $companyService){
        $this->facilityRepository = $facilityRepository;
        $this->companyService = $companyService;
    }

    public function save(){
        $this->emit('changeStep',5);
    }
}
