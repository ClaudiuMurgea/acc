<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\FacilityGroup;

class FacilityGroupRepository extends AbstractRepository
{

    public function __construct(FacilityGroup $model)
    {
        $this->model = $model;
    }
}
