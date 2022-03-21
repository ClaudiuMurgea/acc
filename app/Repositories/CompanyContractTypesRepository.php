<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\CompanyContractTypes;

class CompanyContractTypesRepository extends AbstractRepository
{

    public function __construct(CompanyContractTypes $model)
    {
        $this->model = $model;
    }


}
