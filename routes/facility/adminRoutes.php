<?php


use App\Http\Controllers\Facility\FacilityDepartmentController;
use App\Http\Controllers\Facility\FacilityUnitController;
use App\Http\Controllers\Facility\FacilityUnitTestController;
use App\Http\Controllers\FacilityController;


Route::group(['prefix'=>'facility','as' => 'facility.'], function(){
    @include ('facility_steps.php');
    @include ('facility_schedule.php');

    Route::get('/{facility}',[FacilityController::class,'dashboard'])->name('dashboard');

    Route::get('{facility}/units',[FacilityUnitController::class,'index'])->name('units');

    Route::get('{facility}/planner',[FacilityUnitTestController::class,'index'])->name('planner');

    Route::get('{facility}/departments',[FacilityDepartmentController::class,'index'])->name('departments');
});




