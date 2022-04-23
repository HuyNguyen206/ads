<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->get('/', function () {
    return view('home');
});

Route::prefix('cms')->middleware('auth')->group(function (){
    Route::get('/', [\App\Http\Controllers\CMS\DashboardController::class, 'index']);
    Route::resources([
        'categories' => \App\Http\Controllers\CMS\CategoryController::class,
    ]);
    Route::resource(  'sub-categories' , \App\Http\Controllers\CMS\SubCategoryController::class)->parameter('sub-categories', 'category');
});

Route::resource('ads', \App\Http\Controllers\AdvertisementController::class);
