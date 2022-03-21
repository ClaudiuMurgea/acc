<?php
namespace App\Services;

use App\Repositories\CompanyRepository;
use TheCodeRepublic\Repository\AbstractService;

class CompanyService extends AbstractService
{

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function shifts($companyId,$days,$timeFormat){

        $company =   $this->companyRepository->findById($companyId,['*'],['ShiftGroups.Schedules']);

        if (!$company->ShiftGroups->count()){
            return [
                [
                    'name' => "Day Shift",
                    'shift_group_id' => null,
                    'values'   => [
                        [
                            'schedule_id'   => null,
                            'start_time' => null,
                            'end_time' => null,
                            'days' => $days
                        ],
                    ],
                ],

            ];
        }

        $arr = array();


        foreach ($company->shiftGroups as $shiftGroup){

            $values = array();
            foreach ($shiftGroup->Schedules as $schedule){

                $queryDays = [
                    'Monday' => $schedule->mon,
                    'Tuesday' =>  $schedule->tue,
                    'Wednesday' =>  $schedule->wed,
                    'Thursday' =>  $schedule->thu,
                    'Friday' =>  $schedule->fri,
                    'Saturday' =>  $schedule->sat,
                    'Sunday' =>  $schedule->sun,
                ];
                if (array_key_first($days) == 'Sunday'){
                    $queryDays = [
                        'Sunday' =>  $schedule->sun,
                        'Tuesday' =>  $schedule->tue,
                        'Wednesday' =>  $schedule->wed,
                        'Thursday' =>  $schedule->thu,
                        'Friday' =>  $schedule->fri,
                        'Saturday' =>  $schedule->sat,
                        'Monday' => $schedule->mon,
                    ];
                }



                $values[] = [
                    'start_time'    => $schedule->start_time,
                    'end_time'      => $schedule->end_time,
                    'schedule_id'   => $schedule->id,
                    'days' => $queryDays
                ];

            }
            $arr[]    = [
                'name'  => $shiftGroup->name,
                'shift_group_id' => $shiftGroup->id,
                'values'    => $values
            ];

        }
        return $arr;
    }
}
