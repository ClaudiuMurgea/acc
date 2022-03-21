<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\City;

class CityRepository extends AbstractRepository
{

    public function __construct(City $model)
    {
        $this->model = $model;
    }
}
