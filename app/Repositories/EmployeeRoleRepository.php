<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\EmployeeRole;

class EmployeeRoleRepository extends AbstractRepository
{

    public function __construct(EmployeeRole $model)
    {
        $this->model = $model;
    }
}
