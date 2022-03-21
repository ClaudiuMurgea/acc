<?php
namespace App\Services;

use App\Models\CompanyContractTypes;
use App\Repositories\CompanyContractTypesRepository;
use TheCodeRepublic\Repository\AbstractService;

class CompanyContractTypesService extends AbstractService
{

    public function __construct(CompanyContractTypesRepository $companyContractTypesRepository)
    {
        $this->companyContractTypesRepository = $companyContractTypesRepository;
    }

    public function Subscription($companyId,$employeeTypeId){


        $data = ['company_id' => $companyId,'employee_contract_type_id' => $employeeTypeId];

        $employeeType = $this->companyContractTypesRepository->findByArray($data);

        if ($employeeType){
            $employeeType->delete();
            return;
        }

        $lastOrder = CompanyContractTypes::where('company_id',$companyId)->get()->max('order') ?? 0 ;
        $data['order'] = $lastOrder + 1;

        return $this->companyContractTypesRepository->create($data);

    }

    public function reorder($newOrder,$companyId){

        foreach ($newOrder as $order){

            $data = [
                'company_id' => $companyId,
                'employee_contract_type_id' => $order['value']
            ];

            $this->companyContractTypesRepository->findByArray($data)->update(['order' => $order['order']]);
        }
    }
}
