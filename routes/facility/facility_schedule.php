<?php 

use App\Http\Livewire\Facility\Schedule\DailyUnitAssignment;

Route::get('/schedule/{facility}', DailyUnitAssignment::class)->name('schedule');
