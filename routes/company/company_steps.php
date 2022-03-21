<?php

use App\Http\Controllers\Company\StepController;

Route::get('/steps/',[StepController::class,'details'])->name('steps');
