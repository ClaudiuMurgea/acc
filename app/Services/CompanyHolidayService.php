<?php
namespace App\Services;


use App\Repositories\CompanyHolidayRepository;
use TheCodeRepublic\Repository\AbstractService;

class CompanyHolidayService extends AbstractService
{

    public function __construct(CompanyHolidayRepository $companyHolidayRepository)
    {
        $this->companyHolidayRepository = $companyHolidayRepository;
    }

    public function Subscription($companyId,$holiday_id){

        $data = ['company_id' => $companyId,'holiday_id' => $holiday_id];
        $hol = $this->companyHolidayRepository->findByArray($data);

        if ($hol){
            $hol->delete();
            return;
        }

        return $this->companyHolidayRepository->create($data);

    }
}
