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
        Route::get('prodect', 'index')->name('prodect');

        Route::get('prodect/get', 'get_prodect')->name('get_prodect');

        Route::post('prodect/add' , 'add_prodect')->name('add_prodect');

        Route::get('prodect/edit/{id}' , 'edit')->name('prodect.edit');

        Route::post('prodect/update/{id}' , 'update')->name('prodect.update');

        // Route::delete('client/delete/{id}' , 'client_delete')->name('client.delete');
    });
});

