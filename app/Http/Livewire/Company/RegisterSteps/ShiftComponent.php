<?php

namespace App\Http\Livewire\Company\RegisterSteps;

use App\Models\Company;
use App\Rules\NotEmptyArrayRule;
use App\Services\CompanyService;
use App\Services\ShiftGroupService;
use App\Services\ShiftScheduleService;
use Livewire\Component;

class ShiftComponent extends Component
{

    public $selectedShift ;
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


    public function rules(){
        return[
            'shifts'    => 'required',
            'shifts.*.name' => 'required',
            'shifts.*.values.*.start_time' => 'required',
            'shifts.*.values.*.end_time' => 'required',
            'shifts.*.values.*.days' => new NotEmptyArrayRule('day'),

        ];
    }


    public function render()
    {
        $data = [
            'current_step'  => 5,
            'page_title'    => __('lang.shift_setup'),
            'page_description'  => __('lang.shift_setup_description'),
            'steps'             => $this->steps
        ];

        $this->shiftselected($this->selectedShift);
        $this->emit('render');

        return view('livewire.company.register-steps.shift-component',compact('data'));
    }

    public function mount($companyId,$steps,CompanyService $companyService){


        $this->companyId = $companyId;
        $this->steps = $steps;
        $this->timeFormat = auth()->user()->Company->am_pm  ? "h:mm A": "H:mm";

        $this->days = Company::find($companyId)->week_start ? $this->eudays : $this->usdays;

        $this->shifts =   $companyService->shifts($companyId,$this->days,$this->timeFormat);


        $this->shiftselected();
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

    public function removeShiftGroup($index,ShiftGroupService $shiftGroupService){
        if ($this->shifts[$index]['shift_group_id']){
            $shiftGroupService->removeShiftGroup($this->shifts[$index]['shift_group_id']);
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
        $this->emit('settimeFormat',$this->timeFormat);

        $this->emit('initTime');
    }

    public function save(ShiftGroupService $shiftGroupService,CompanyService $companyService){
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->emit('alert', ['type' => 'warning', 'message' => __('lang.form_error')]);
            $this->validate();
        }


        $shiftGroupService->saveShiftGroups($this->companyId,$this->shifts);

        $this->emit('changeStep',6);

    }

    public function selectDay($selectedDay,$selectedShift,$selectedValue){

        $this->shifts[$selectedShift]['values'][$selectedValue]['days'][$selectedDay] = !$this->shifts[$selectedShift]['values'][$selectedValue]['days'][$selectedDay];
    }

    public function setTime($el,$val){
        $this->$el = $val;
    }
}
