<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\ShiftGroup;

class ShiftGroupRepository extends AbstractRepository
{

    public function __construct(ShiftGroup $model)
    {
        $this->model = $model;
    }

    public function createSchedule($data,$shiftID,$scheduleID){

        return  $this->findById($shiftID)->Schedules()->updateOrCreate(['id' => $scheduleID],$data);

    }
}
