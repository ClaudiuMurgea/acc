<?php
namespace App\Repositories;

use TheCodeRepublic\Repository\AbstractRepository;
use App\Models\Department;

class DepartmentRepository extends AbstractRepository
{

    public function __construct(Department $model)
    {
        $this->model = $model;
    }
}
