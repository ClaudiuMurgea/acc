<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityGroupRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_group_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_group_id');
            $table->unsignedBigInteger('employee_role_id');
            $table->timestamps();

            $table->foreign('facility_group_id')->references('id')->on('facility_groups');
            $table->foreign('employee_role_id')->references('id')->on('employee_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_group_roles');
    }
}
