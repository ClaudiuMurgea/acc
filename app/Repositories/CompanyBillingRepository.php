<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\CompanyBilling;

class CompanyBillingRepository extends AbstractRepository
{

    public function __construct(CompanyBilling $model)
    {
        $this->model = $model;
    }
}
