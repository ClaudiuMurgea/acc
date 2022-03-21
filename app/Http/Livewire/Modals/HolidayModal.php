<?php

namespace App\Http\Livewire\Modals;

use App\Http\Livewire\Modal;
use App\Repositories\CompanyRepository;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Validator;


class HolidayModal extends Modal
{


    public $holiday_date;
    public $holiday_name;
    public $recurrent;



    public function render()
    {
        return view('livewire.modals.holiday-modal');
    }



    public function addHoliday(CompanyRepository $companyRepository){
        $companyId = $this->companyId;


        $validator = Validator::make([
            "holiday_date" => $this->holiday_date ? Carbon::createFromFormat('m/d/Y',$this->holiday_date)->format('Y-m-d') : null,
            'holiday_name' =>$this->holiday_name,
        ], [
            'holiday_date' => [
                'required',
                Rule::unique('holidays','date')->where(function ($query) use ($companyId) {
                    return $query
                        ->whereEntityId($companyId);
                }),
            ],
            'holiday_name'  => 'required'
        ],[
            'holiday_date.unique' => 'This holiday already exists!'
        ]);
        $validatedData = $validator->validate();
        if($validator->fails()){
            return $validatedData;
        }



        $companyRepository->createHoliday(
            $this->companyId,
            [
                'date' => $this->holiday_date,
                'label' => $this->holiday_name,
                'recurrent' => $this->recurrent ?? 0
            ]
        );
        $this->show = false;
        $this->emitTo('company.register-steps.company-holiday-component','reloadHoliday');

    }


}
