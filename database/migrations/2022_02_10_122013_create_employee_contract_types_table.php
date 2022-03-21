<?php

use App\Models\EmployeeContractType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeContractTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_contract_types', function (Blueprint $table) {
            $table->id();
                $table->string('name');
            $table->timestamps();
        });

        $types = [
            ["name" => "Full-Time Employees(FTE)"],
            ["name" => "Part-Time Employees(PTE)"],
            ["name" => "Agency Employees"],
            ["name" => "Contract Employees"],
            ["name" => "Interns"],
        ];

        EmployeeContractType::insert($types);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_contract_types');
    }
}
