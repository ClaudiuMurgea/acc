<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\State;

class StateRepository extends AbstractRepository
{

    public function __construct(State $model)
    {
        $this->model = $model;
    }
}
