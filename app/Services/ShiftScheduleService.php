<?php
namespace App\Services;

use App\Repositories\ShiftScheduleRepository;
use TheCodeRepublic\Repository\AbstractService;

class ShiftScheduleService extends AbstractService
{

    public $shiftScheduleRepository;

    public function __construct(ShiftScheduleRepository $shiftScheduleRepository)
    {
        $this->shiftScheduleRepository = $shiftScheduleRepository;
    }

    public function removeSchedule($schedule_id){
        $this->shiftScheduleRepository->deleteById($schedule_id);
    }
}
