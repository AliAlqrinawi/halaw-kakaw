<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
})->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__.'/admin.php';
require __DIR__.'/client.php';
require __DIR__.'/category.php';
require __DIR__.'/roles.php';
require __DIR__.'/setting.php';
require __DIR__.'/prodect.php';
require __DIR__.'/coupon.php';
require __DIR__.'/ads.php';