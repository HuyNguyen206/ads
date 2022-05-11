<?php

use Illuminate\Support\Facades\Route;

Route::get('categories/{category:id}', [\App\Http\Controllers\ApiController::class, 'getCategoryById']);
Route::get('address/get-states/{country}', [\App\Http\Controllers\ApiController::class, 'getStatesByCountryId']);
Route::get('address/get-cities/{state}', [\App\Http\Controllers\ApiController::class, 'getCitiesByStateId']);

Route::post('message/send', [\App\Http\Controllers\ApiController::class, 'store']);
Route::get('message/get-all-conversation', [\App\Http\Controllers\ApiController::class, 'getConversations']);
Route::get('message/get-all-conversation/{userId}', [\App\Http\Controllers\ApiController::class, 'getConversationsByUserId'])->name('message.conversation-by-user');
Route::post('ads/{adsId}/save', [\App\Http\Controllers\ApiController::class, 'storeSavedAd']);
