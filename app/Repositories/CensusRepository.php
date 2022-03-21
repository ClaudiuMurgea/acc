<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\Census;

class CensusRepository extends AbstractRepository
{

    public function __construct(Census $model)
    {
        $this->model = $model;
    }
}
