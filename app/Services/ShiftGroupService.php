<?php
namespace App\Services;

use App\Models\ShiftGroup;
use App\Repositories\ShiftGroupRepository;
use TheCodeRepublic\Repository\AbstractService;

class ShiftGroupService extends AbstractService
{
    public $shiftGroupRepository;
    public $shiftScheduleService;

    public function __construct(ShiftGroupRepository $shiftGroupRepository,ShiftScheduleService $shiftScheduleService)
    {
        $this->shiftGroupRepository = $shiftGroupRepository;
        $this->shiftScheduleService = $shiftScheduleService;
    }


    public function saveShiftGroups($companyId,$shiftGroups){

        foreach ($shiftGroups as $shiftGroup){
            $shift =     $this->shiftGroupRepository->updateOrCreate(
                $shiftGroup['shift_group_id'],
                [
                    'company_id'    =>  $companyId,
                    'name'  => $shiftGroup['name']
                ],

            );

            $this->storeSchedules( $shift->id,$shiftGroup['values']);
        }
    }

    public function storeSchedules($shift_id,$data){


        foreach ($data as $schedule){

            $days = $schedule['days'];

            foreach ($days as $key => $val){
                $daysToSave[ strtolower(date('D', strtotime($key)))] = $val;
            }



            $newDtat = array_merge($daysToSave,
                [
                    'start_time' => $schedule['start_time'],
                    'end_time' => $schedule['end_time'],

                ]);




            $this->shiftGroupRepository->createSchedule($newDtat,$shift_id,$schedule['schedule_id'] ?? null);


        }
    }

    public function removeShiftGroup($shiftGroupId){
        $shiftGroup = ShiftGroup::find($shiftGroupId);
        $shiftGroup->Schedules()->delete();
        $shiftGroup->delete();

        return;
    }
}
