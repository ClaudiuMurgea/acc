<?php


use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PageController;

Route::group(['prefix'=>'company','as' => 'company.'], function(){
    @include ('company_steps.php');

   Route::get('/', [CompanyController::class, 'dashboard'])->name('dashboard');
   Route::get('/{company}', [CompanyController::class, 'dashboard'])->name('dashboard');

});




