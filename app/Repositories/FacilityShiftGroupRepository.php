<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\FacilityShiftGroup;

class FacilityShiftGroupRepository extends AbstractRepository
{


    public function __construct(FacilityShiftGroup $model)
    {
        $this->model = $model;
    }

    public function createSchedule($data,$shiftID,$scheduleID){
        return  $this->findById($shiftID)->Schedules()->updateOrCreate(['id' => $scheduleID],$data);
    }
}
