<?php

use App\Http\Controllers\AdsController;
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

Route::group(
    [
        'prefix' => "admin",
        'middleware' => ['auth']
] , function (){
    Route::controller(AdsController::class)->group(function () {
        Route::get('ads', 'ads')->name('ads');

        Route::get('ads/get', 'get_ads')->name('get_ads');

        // Route::post('admin/add' , 'add_admin')->name('add_admin');

        // Route::get('admin/edit/{id}' , 'edit')->name('admin.edit');

        // Route::post('admin/update/{id}' , 'update')->name('admin.update');

        // Route::delete('admin/delete/{id}' , 'delete')->name('admin.delete');
    });
});

