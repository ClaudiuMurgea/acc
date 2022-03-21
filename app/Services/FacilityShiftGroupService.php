<?php
namespace App\Services;

use App\Models\FacilityShiftGroup;
use App\Repositories\FacilityShiftGroupRepository;
use TheCodeRepublic\Repository\AbstractService;

class FacilityShiftGroupService extends AbstractService
{

    public $facilityShiftGroupRepository;


    public function __construct(FacilityShiftGroupRepository $facilityShiftGroupRepository)
    {
        $this->facilityShiftGroupRepository = $facilityShiftGroupRepository;
    }

    public function saveShiftGroups($facilityId,$shiftGroups){

        foreach ($shiftGroups as $shiftGroup){
            $shift =     $this->facilityShiftGroupRepository->updateOrCreate(
                $shiftGroup['shift_group_id'],
                [
                    'facility_id'    =>  $facilityId,
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




            $this->facilityShiftGroupRepository->createSchedule($newDtat,$shift_id,$schedule['schedule_id'] ?? null);


        }
    }

    public function removeShiftGroup($shiftGroupId){
        $shiftGroup = FacilityShiftGroup::find($shiftGroupId);
        $shiftGroup->Schedules()->delete();
        $shiftGroup->delete();

        return;
    }
}
