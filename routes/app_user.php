<?php

use App\Http\Controllers\AppUsersController;
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
    Route::controller(AppUsersController::class)->group(function () {
        Route::get('appUser', 'app_user')->name('app_user');

        Route::get('appUser/get', 'get_appUser')->name('get_appUser');

        // Route::post('category/add' , 'add_category')->name('add_category');

        // Route::get('category/edit/{id}' , 'edit')->name('category.edit');

        // Route::post('category/update/{id}' , 'update')->name('category.update');

        Route::delete('appUser/delete/{id}' , 'delete')->name('category.delete');
    });
});

