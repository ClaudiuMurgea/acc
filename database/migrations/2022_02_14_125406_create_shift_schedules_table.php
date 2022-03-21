<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_schedules', function (Blueprint $table) {
            $table->id();
            $table->morphs('type');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('sun')->default(0); //Sun
            $table->boolean('mon')->default(0); //Monday
            $table->boolean('tue')->default(0); //Tue
            $table->boolean('wed')->default(0); //Wed
            $table->boolean('thu')->default(0); //Thu
            $table->boolean('fri')->default(0); //Fri
            $table->boolean('sat')->default(0); //Sat

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
        Schema::dropIfExists('shift_schedules');
    }
}
