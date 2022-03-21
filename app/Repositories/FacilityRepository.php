<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\Facility;

class FacilityRepository extends AbstractRepository
{

    public function __construct(Facility $model)
    {
        $this->model = $model;
    }
}
