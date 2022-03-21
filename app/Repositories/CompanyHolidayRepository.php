<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\CompanyHoliday;

class CompanyHolidayRepository extends AbstractRepository
{

    public function __construct(CompanyHoliday $model)
    {
        $this->model = $model;
    }

    public function findByArray(array $conditions){
        return $this->getModel()->where($conditions)->first();
    }
}
