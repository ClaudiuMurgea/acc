<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\Country;

class CountryRepository extends AbstractRepository
{

    public function __construct(Country $model)
    {
        $this->model = $model;
    }
}
