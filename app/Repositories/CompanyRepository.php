<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\Company;

class CompanyRepository extends AbstractRepository
{

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function createHoliday($id,$data){

        $holiday =  $this->findById($id)->Holidays()->create($data);
        return $holiday;
    }
}
