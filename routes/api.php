<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'user', 'middleware' => ['api']], function () {
    Route::post('auth', ['as' => 'api-auth', 'uses' => 'Api\V1\AuthController@auth']);
    Route::post('auth/refresh', ['as' => 'api-auth-refresh', 'uses' => 'Api\V1\AuthController@refreshToken']);
    Route::post('forgetPass', ['as' => 'api-forget-pass', 'uses' => 'Api\V1\AuthController@forgetPassword']);
    Route::post('verifyCode', ['as' => 'api-auth-verify-ode', 'uses' => 'Api\V1\AuthController@verifyCode']);

    Route::post('register', ['as' => 'api-user-register', 'uses' => 'App\Http\Controllers\Api\V1\UserController@register']);

    Route::post('activateAccount', ['middleware' => 'api.auth', 'as' => 'api-user-activate', 'uses' => 'Api\V1\UserController@activateAccount']);
    Route::post('resendActivation', ['middleware' => 'api.auth', 'as' => 'api-user-resend-code', 'uses' => 'Api\V1\UserController@resendActivation']);
    Route::post('update', ['middleware' => 'api.auth', 'as' => 'api-user-resend-code', 'uses' => 'Api\V1\UserController@updateInfo']);
    Route::post('profile', ['middleware' => 'api.auth', 'as' => 'api-user-profile', 'uses' => 'Api\V1\UserController@profile']);
    Route::post('changePass', ['middleware' => 'api.auth', 'as' => 'api-user-change-pass', 'uses' => 'Api\V1\AuthController@changePass']);
    Route::any('notification', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\NotificationController@getData']);
    Route::get('read/{id}', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\NotificationController@read']);
    Route::get('notification/delete/{id}', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\NotificationController@delete']);
    Route::post('credit', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\UserController@credit']);
    Route::post('add_promo', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\UserController@promoAccount']);
    Route::any('logout', ['middleware' => 'api.auth', 'as' => 'api-user-logout', 'uses' => 'Api\V1\AuthController@logout']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
