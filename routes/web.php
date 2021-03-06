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

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('categories/ads/{ad}', [\App\Http\Controllers\Frontend\AdsController::class, 'show'])->name('ads.show-detail');
Route::get('ads/ads-saved', [\App\Http\Controllers\AdvertisementController::class, 'getAdsSaved'])->name('ads.ads-saved');
Route::post('ads/ads-report', [\App\Http\Controllers\AdvertisementController::class, 'reportAds'])->name('ads.ads-report');
Route::prefix('cms')->middleware(['auth', \App\Http\Middleware\AllowAdminOnly::class])->group(function (){
    Route::get('/', [\App\Http\Controllers\CMS\DashboardController::class, 'index']);
    Route::resources([
        'categories' => \App\Http\Controllers\CMS\CategoryController::class,
    ]);
    Route::resource(  'sub-categories' , \App\Http\Controllers\CMS\SubCategoryController::class)->parameter('sub-categories', 'category');
    Route::get('ads/fraud-ads', [\App\Http\Controllers\CMS\AdvertisementController::class, 'getFraudAds'])->name('cms.fraud-ads');
    Route::delete('ads/fraud-ads/{fraud}/delete', [\App\Http\Controllers\CMS\AdvertisementController::class, 'delete'])->name('ads-fraud.destroy');
    Route::get('ads', [\App\Http\Controllers\CMS\AdvertisementController::class, 'index'])->name('cms.ads');
});
Route::get('user/{user:email}/ads', [\App\Http\Controllers\AdvertisementController::class, 'viewAdsByUserEmail'])->name('user.ads');
Route::delete('ads-saved/delete/{adId}', [\App\Http\Controllers\AdvertisementController::class, 'deleteSavedAd'])->name('ads.ads-saved.delete');
Route::resource('ads', \App\Http\Controllers\AdvertisementController::class)->parameter('ads', 'advertisement');
//Route::patch('profile/password/update', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update-password');
Route::resource('profile', \App\Http\Controllers\ProfileController::class);

Route::get('sub-categories/{subCategory}/categories/{category}', [\App\Http\Controllers\Frontend\CategoryController::class, 'getAdsByChildCategory'])
    ->name('frontend.child-categories')
    ->scopeBindings();
Route::get('categories/{rootCategory}/sub-categories/{category}', [\App\Http\Controllers\Frontend\CategoryController::class, 'getAdsBySubCategory'])
    ->name('frontend.subcategories')
    ->scopeBindings();
Route::get('categories/{rootCategory}/products/all', [\App\Http\Controllers\Frontend\CategoryController::class, 'getAdsByRootCategory'])
    ->name('frontend.root-categories')
    ->scopeBindings();

Route::get('message', [\App\Http\Controllers\Frontend\MessageController::class, 'index'])->name('message.index');

Route::get('/auth/{provider}/redirect', [\App\Http\Controllers\SocialController::class, 'redirect'])->name('social.login');

Route::get('/auth/{provider}/callback', [\App\Http\Controllers\SocialController::class, 'callback']);



