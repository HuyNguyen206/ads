<?php

use Illuminate\Support\Facades\Route;

Route::get('categories/{category:id}', [\App\Http\Controllers\ApiController::class, 'getCategoryById']);
Route::get('address/get-states/{country}', [\App\Http\Controllers\ApiController::class, 'getStatesByCountryId']);
Route::get('address/get-cities/{state}', [\App\Http\Controllers\ApiController::class, 'getCitiesByStateId']);
