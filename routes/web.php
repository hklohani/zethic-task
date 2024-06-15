<?php

use App\Http\Controllers\GeolocationLogController;
use Illuminate\Support\Facades\Route;




Route::get('/', [GeolocationLogController::class, 'create'])->name('geolocation.create');
Route::post('/', [GeolocationLogController::class, 'store'])->name('geolocation.store');
