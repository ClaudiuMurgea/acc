<?php

namespace App\Http\Livewire\Facility\RegisterSteps;

use App\Repositories\FacilityRepository;
use App\Rules\NotEmptyArrayRule;
use App\Services\CompanyService;
use App\Services\FacilityService;
use App\Services\FacilityShiftGroupService;
use App\Services\ShiftScheduleService;
use Livewire\Component;

class FacilityAddShiftsScheduleComponent extends Component
{
    protected $facilityRepository;
    protected $facilityService;
    public $selectedShift ;
    public $facility;
    public $shifts = [];
    protected $listeners = ['selectDay','setTime'];

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
        $this->shiftselected($this->selectedShift);
        $this->emit('render');
        return view('livewire.facility.register-steps.facility-add-shifts-schedule-component');
    }
    public function rules(){
        return[
            'shifts'    => 'required',
            'shifts.*.name' => 'required',
            'shifts.*.values.*.start_time' => 'required',
            'shifts.*.values.*.end_time' => 'required',
            'shifts.*.values.*.days' => new NotEmptyArrayRule('day'),

        ];
    }


    public function messages()
    {
        return [
            'shifts.*.name.required'     => 'This field is required',
            'shifts.*.values.*.start_time.required'  =>  __('lang.field_required') ,
            'shifts.*.values.*.end_time.required'  =>  __('lang.field_required') ,
        ];
    }
    public function mount($facilityId){
        $this->facility = $this->facilityRepository->findById($facilityId,['*'],['Company','ShiftGroups']);
        $this->week_start = $this->facility->Company->week_start;
        $this->hour_format = $this->facility->Company->am_pm ? 'H:i A' : 'H:i';
        $this->days = $this->facility->Company->week_start ? $this->eudays : $this->usdays;
        $this->shifts =   shifts($this->facility,$this->days);


        $this->shiftselected();
    }

    public function boot(FacilityRepository $facilityRepository,FacilityService $facilityService){
        $this->facilityRepository = $facilityRepository;
        $this->facilityService = $facilityService;
    }

    public function addShiftGroup(){
        $newVal =  [
            'name' => '',
            'shift_group_id'    => null,
            'values'   => [
                [
                    'schedule_id'   => null,
                    'start_time' => null,
                    'end_time' => null,
                    'days' => $this->days
                ]
            ]
        ];
        //$this->emit('loadGlobalPicker');
        array_push($this->shifts,$newVal);
    }

    public function removeShiftGroup($index,FacilityShiftGroupService $facilityShiftGroupService){
        if ($this->shifts[$index]['shift_group_id']){
            $facilityShiftGroupService->removeShiftGroup($this->shifts[$index]['shift_group_id']);
        }
        unset($this->shifts[$index]);
        $this->shifts = $this->shifts;
    }

    public function removeShift($index, ShiftScheduleService $shiftScheduleService){

        if ($this->shifts[$this->selectedShift]['values'][$index]['schedule_id']){
            $shiftScheduleService->removeSchedule($this->shifts[$this->selectedShift]['values'][$index]['schedule_id']);
        }
        unset($this->shifts[$this->selectedShift]['values'][$index]);
        $this->shifts = $this->shifts;
    }

    public function shiftselected($index = null){
        if (!isset($this->shifts[$index])){
            $this->selectedShift = array_key_first($this->shifts);
            $this->emit('shiftSelected',array_key_first($this->shifts));
            return;
        }
        $this->selectedShift = $index;
        $this->emit('shiftSelected',$index);
        $this->emit('initTime');
    }

    public function save(FacilityShiftGroupService $facilityShiftGroupService,CompanyService $companyService){
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->emit('alert', ['type' => 'warning', 'message' => 'Please check the form for errors!']);
            $this->validate();
        }


        $facilityShiftGroupService->saveShiftGroups($this->facility->id,$this->shifts);

        $this->emit('toggleDefaultShift',1);

    }

    public function selectDay($selectedDay,$selectedShift,$selectedValue){
        $this->shifts[$selectedShift]['values'][$selectedValue]['days'][$selectedDay] = !$this->shifts[$selectedShift]['values'][$selectedValue]['days'][$selectedDay];
    }

    public function setTime($el,$val){
        $this->$el = $val;
    }
    public function addShift(){
        $newVal = [
            'schedule_id' => null,
            'start_time' => null,
            'end_time' => null,
            'days' => $this->days
        ];
        array_push($this->shifts[$this->selectedShift]['values'],$newVal);

    }
}
