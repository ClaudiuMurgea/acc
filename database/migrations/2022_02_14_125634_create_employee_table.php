<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('payroll_no');
            $table->unsignedBigInteger('facility_id');
            $table->string('phone');
            $table->string('mobile_phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('zipcode');
            $table->unsignedInteger('rate_of_pay');
            $table->unsignedBigInteger('rate_of_pay_option_id');
            $table->unsignedBigInteger('approved_by');

            $table->unsignedBigInteger('employee_contract_type_id');
            $table->unsignedBigInteger('employee_role_id');
            $table->date('date_of_hire');
            $table->string('social_security');
            $table->string('address');
            $table->date('date_of_birth');
            $table->string('title');

            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('state_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('facility_id')->references('id')->on('facilities');
            //Full-Time, Part-Time, etc.
            $table->foreign('employee_contract_type_id')->references('id')
                ->on('employee_contract_types');
            $table->foreign('approved_by')->references('id')->on('employee');
            // Nurse, etc
            $table->foreign('employee_role_id')->references('id')->on('employee_roles');
            $table->foreign('rate_of_pay_option_id')
                ->references('id')->on('rate_of_pay_options');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
