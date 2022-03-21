<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_benefits', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('benefit_id');
            $table->unsignedInteger('number_of_days');

            $table->foreign('employee_id')->references('id')->on('employee');
            $table->foreign('benefit_id')->references('id')->on('benefits');
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
        Schema::table('employee_benefits',function (Blueprint $tab){
            $tab->dropForeign(['employee_id']);
            $tab->dropForeign(['benefit_id']);
            $tab->dropColumn('employee_id');
            $tab->dropColumn('benefit_id');

        });
        Schema::dropIfExists('employee_benefits');
    }
}
