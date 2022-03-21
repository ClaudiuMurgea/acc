<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\ShiftSchedule;

class ShiftScheduleRepository extends AbstractRepository
{

    public function __construct(ShiftSchedule $model)
    {
        $this->model = $model;
    }
}
