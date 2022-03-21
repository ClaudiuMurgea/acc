<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContractTypes extends Model
{
    use HasFactory;
    protected $fillable = ['company_id','employee_contract_type_id','order'];


    public function Type(){
        return $this->hasOne(EmployeeContractType::class,'id','employee_contract_type_id');
    }

    public function Company(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
