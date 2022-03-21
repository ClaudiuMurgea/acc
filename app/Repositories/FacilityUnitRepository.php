<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\FacilityUnit;

class FacilityUnitRepository extends AbstractRepository
{

    public function __construct(FacilityUnit $model)
    {
        $this->model = $model;
    }
}
