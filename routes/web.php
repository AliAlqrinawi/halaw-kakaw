<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\AppUsersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ProdectController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryTypesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OedersController;
use App\Http\Controllers\Payment_methodsController;
use App\Http\Controllers\ProductsDetailsController;
use App\Http\Controllers\timesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['auth'],
    ], function () {
        Route::get('/',[HomeController::class , 'index']);
        Route::get('admin/best/selling/clothes', [ProductsDetailsController::class , 'index'])->name('mmm');
Route::get('admin/clothes/gettt', [ProductsDetailsController::class , 'get_d'])->name('get_d');
Route::get('admin/clothes/getm', [ProductsDetailsController::class , 'get_m'])->name('get_m');
Route::get('admin/modern/selling/clothes', [ProductsDetailsController::class , 'indexm'])->name('aaa');
    });
Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('category/update/status', [CategoriesController::class , 'updateStatus'])->name('update.status');
Route::post('clothes/update/status', [ProdectController::class , 'updateStatus'])->name('prodect.status');
Route::post('coupon/update/status', [CouponsController::class , 'updateStatus'])->name('coupon.status');
Route::post('ads/update/status', [AdsController::class , 'updateStatus'])->name('ads.status');
Route::post('city/update/status', [CitiesController::class , 'updateStatus'])->name('city.status');
Route::post('appuser/update/status', [AppUsersController::class , 'updateStatus'])->name('appuser.status');
Route::post('payment/update/status', [Payment_methodsController::class , 'updateStatus'])->name('payments.status');
Route::post('deliveryTypes/update/status', [DeliveryTypesController::class , 'updateStatus'])->name('deliveryTypes.status');
Route::post('time/update/status', [timesController::class , 'updateStatus'])->name('time.status');
Route::post('delivery/update/status', [DeliveryController::class , 'updateStatus'])->name('delivery.status');

Route::post('order/update/status', [OedersController::class , 'updateStatus'])->name('order.status');
Route::post('order2/update/status', [OedersController::class , 'updateStatus'])->name('order2.status');
Route::post('order3/update/status', [OedersController::class , 'updateStatus'])->name('order3.status');


require __DIR__.'/admin.php';
require __DIR__.'/client.php';
require __DIR__.'/category.php';
require __DIR__.'/roles.php';
require __DIR__.'/setting.php';
require __DIR__.'/prodect.php';
require __DIR__.'/coupon.php';
require __DIR__.'/ads.php';
require __DIR__.'/app_user.php';
require __DIR__.'/contact.php';
require __DIR__.'/payment.php';
require __DIR__.'/governorat.php';
require __DIR__.'/city.php';
require __DIR__.'/delivery.php';
require __DIR__.'/deliverytype.php';
require __DIR__.'/time.php';
require __DIR__.'/order.php';