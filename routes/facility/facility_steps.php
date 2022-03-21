<?php

use App\Http\Controllers\Company\StepController;

Route::get('/details/{companyId}/{facilityId?}',[StepController::class,'addfacility'])->name('facilitySteps');
