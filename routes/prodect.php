<?php

use App\Http\Controllers\ProdectController;
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
    Route::controller(ProdectController::class)->group(function () {
        Route::get('clothes', 'index')->name('prodect');

        Route::get('clothes/get', 'get_prodect')->name('get_prodect');

        Route::post('clothes/add' , 'add_prodect')->name('add_prodect');

        Route::get('clothes/{id}', 'index_show')->name('prodect.show');

        Route::get('clothes/show/{id}', 'show')->name('get_show');

        Route::get('clothes/edit/{id}' , 'edit')->name('prodect.edit');

        Route::post('clothes/update/{id}' , 'update')->name('prodect.update');

        Route::delete('clothes/delete/{id}' , 'delete')->name('prodect.delete');   
    });
});

