<?php


use App\Http\Controllers\PageController;

Route::group(['prefix'=>'super','as' => 'super.'], function(){
    Route::get('/', [PageController::class, 'dashboardOverview1'])->name('dashboard');
});



