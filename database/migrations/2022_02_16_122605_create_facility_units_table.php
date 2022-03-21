<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_units', function (Blueprint $table) {
            $table->id();
                $table->unsignedBigInteger('facility_id');
                $table->unsignedBigInteger('facility_group_id')->nullable();
                $table->string('name');
                $table->string('type')->nullable();
                $table->string('color')->default('#ffffff');
                $table->string('description')->nullable();
                $table->unsignedInteger('budget')->nullable();

                $table->foreign('facility_id')->references('id')->on('facilities');
                $table->foreign('facility_group_id')->references('id')->on('facility_groups');

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
        Schema::dropIfExists('facility_units');
    }
}
