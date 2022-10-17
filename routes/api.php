<?php

use Illuminate\Http\Request;

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
// Route::get('callback/success', ['as' => 'ordersSuccess', 'middleware' => ['api', 'settings'], 'uses' => 'Api\V1\CountriesController@ordersSuccess']);
// Route::get('callback/error', ['as' => 'ordersError', 'middleware' => ['api', 'settings'], 'uses' => 'Api\V1\CountriesController@ordersError']);
// Route::post('cities', ['as' => 'api-get-cities', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V1\CountriesController@getRegion']);
// Route::post('contactUs', ['as' => 'api-get-contactUs', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V1\ClothesController@contactUs']);
// Route::post('about', ['as' => 'api-get-contactUs', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V1\ClothesController@about']);
// Route::post('home', ['as' => 'api-get-contactUs', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V1\ClothesController@home']);
// Route::post('slider', ['as' => 'api-get-slider', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V1\ClothesController@slider']);

// Route::group(['prefix' => 'user', 'middleware' => ['api', 'settings', 'https']], function () {
//     Route::post('auth', ['as' => 'api-auth', 'uses' => 'Api\V1\AuthController@auth']);
//     Route::post('auth/refresh', ['as' => 'api-auth-refresh', 'uses' => 'Api\V1\AuthController@refreshToken']);
//     Route::post('forgetPass', ['as' => 'api-forget-pass', 'uses' => 'Api\V1\AuthController@forgetPassword']);
//     Route::post('verifyCode', ['as' => 'api-auth-verify-ode', 'uses' => 'Api\V1\AuthController@verifyCode']);

//     Route::post('register', ['as' => 'api-user-register', 'uses' => 'Api\V1\UserController@register']);

//     Route::post('activateAccount', ['middleware' => 'api.auth', 'as' => 'api-user-activate', 'uses' => 'Api\V1\UserController@activateAccount']);
//     Route::post('resendActivation', ['middleware' => 'api.auth', 'as' => 'api-user-resend-code', 'uses' => 'Api\V1\UserController@resendActivation']);
//     Route::post('update', ['middleware' => 'api.auth', 'as' => 'api-user-resend-code', 'uses' => 'Api\V1\UserController@updateInfo']);
//     Route::post('profile', ['middleware' => 'api.auth', 'as' => 'api-user-profile', 'uses' => 'Api\V1\UserController@profile']);
//     Route::post('changePass', ['middleware' => 'api.auth', 'as' => 'api-user-change-pass', 'uses' => 'Api\V1\AuthController@changePass']);
//     Route::any('notification', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\NotificationController@getData']);
//     Route::get('read/{id}', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\NotificationController@read']);
//     Route::get('notification/delete/{id}', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\NotificationController@delete']);
//     Route::post('credit', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\UserController@credit']);
//     Route::post('add_promo', ['middleware' => 'api.auth', 'as' => 'api-user-notification', 'uses' => 'Api\V1\UserController@promoAccount']);
//     Route::any('logout', ['middleware' => 'api.auth', 'as' => 'api-user-logout', 'uses' => 'Api\V1\AuthController@logout']);

// });

// Route::group(['prefix' => 'products', 'middleware' => ['api', 'settings', 'https']], function () {
//     Route::post('/', ['as' => 'api-products', 'uses' => 'Api\V1\ClothesController@index']);
//     Route::post('/details', ['as' => 'api-products', 'uses' => 'Api\V1\ClothesController@getRow']);
//     Route::post('/deals/{type}', ['as' => 'api-products-deals', 'uses' => 'Api\V1\ClothesController@dataType']);
//     Route::post('/search', ['as' => 'api-products-box', 'uses' => 'Api\V1\ClothesController@search']);
//     Route::post('/categories', ['as' => 'api-categories', 'uses' => 'Api\V1\ClothesController@getData']);
//     Route::post('/delivery', ['as' => 'api-categories', 'uses' => 'Api\V1\ClothesController@delivery']);
//     Route::post('/payment', ['as' => 'api-categories', 'uses' => 'Api\V1\ClothesController@payment']);
//     Route::post('addFav', ['middleware' => 'api.auth', 'as' => 'api-add-fav', 'uses' => 'Api\V1\ClothesController@addFav']);
//     Route::post('deleteFav', ['middleware' => 'api.auth', 'as' => 'api-delete-fav', 'uses' => 'Api\V1\ClothesController@deleteFav']);
//     Route::post('getFav', ['middleware' => 'api.auth', 'as' => 'api-get-fav', 'uses' => 'Api\V1\ClothesController@getFav']);
// });

// Route::group(['prefix' => 'address', 'middleware' => ['api', 'settings', 'https']], function () {
//     Route::post('add', ['middleware' => 'api.auth', 'as' => 'api-add-fav', 'uses' => 'Api\V1\ClothesController@addAdd']);
//     Route::post('edit', ['middleware' => 'api.auth', 'as' => 'api-add-fav', 'uses' => 'Api\V1\ClothesController@editAdd']);
//     Route::post('delete', ['middleware' => 'api.auth', 'as' => 'api-delete-fav', 'uses' => 'Api\V1\ClothesController@deleteAdd']);
//     Route::post('get', ['middleware' => 'api.auth', 'as' => 'api-get-fav', 'uses' => 'Api\V1\ClothesController@getAdd']);
// });

// Route::group(['prefix' => 'orders', 'middleware' => ['api', 'settings', 'https']], function () {
//     Route::post('checkout', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@create']);
//     Route::post('checkPromo', ['as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@checkPromo']);

//     Route::post('payment_status', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@paymentStatus']);

//     Route::post('cart/add', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@cart']);
//     Route::post('cart/clear', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@clearCart']);
//     Route::post('cart/delete', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@cartDelete']);
//     Route::post('rate', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@sendReview']);
//     Route::post('deliverNow', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@deliverNow']);
//     Route::post('later', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@later']);
//     Route::post('accept', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@accept']);
//     Route::post('add', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@add']);
//     Route::post('getUserOrders', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@getData']);
//     Route::post('getCart', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@getDataCart']);
//     Route::post('checkCart', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@checkCart']);
//     Route::post('getUserCompleteOrders', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@completeOrders']);
//     Route::any('getOrders/{type}', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@completeOrders']);
//     Route::post('getOrderDetails', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\UserOrderController@getRow']);
//     Route::post('getNewOrders', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@getData']);
//     Route::post('getDataNew', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@getDataNew']);
//     Route::post('getCarOrders', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@getDataCar']);
//     Route::post('getLandryOrders', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@getDataLandry']);
//     Route::post('getCompleteOrders', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@getDataComplete']);
//     Route::post('delivered', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@delivered']);
//     Route::post('completeWash', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@completeWash']);
//     Route::post('completed', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@completed']);
//     Route::post('driverOrderDetails', ['as' => 'api-auth', 'uses' => 'Api\V1\DriverOrderController@getRow']);


// });


// Route::group(['prefix' => 'v2'], function () {
//     Route::post('home', ['as' => 'api-get-contactUs', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V2\ClothesController@home']);
//     Route::any('setting', ['as' => 'api-get-slider', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V2\ClothesController@setting']);
//     Route::group(['prefix' => 'products', 'middleware' => ['api', 'settings', 'https']], function () {
//         Route::post('/payment', ['as' => 'api-categories', 'uses' => 'Api\V2\ClothesController@payment']);
//     });
// });
// Route::group(['prefix' => 'v3'], function () {
//     Route::post('home', ['as' => 'api-get-contactUs', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V3\ClothesController@home']);
//     Route::post('interested', ['as' => 'api-get-interested', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V3\ClothesController@interested']);
//     Route::any('setting', ['as' => 'api-get-slider', 'middleware' => ['api', 'settings', 'https'], 'uses' => 'Api\V3\ClothesController@setting']);
//     Route::any('cities', ['as' => 'api-governorates', 'middleware' => ['api', 'settings'], 'uses' => 'Api\V3\CountriesController@getCities']);
//     Route::any('regions/{id}', ['as' => 'api-cities', 'middleware' => ['api', 'settings'], 'uses' => 'Api\V3\CountriesController@getAreas']);
//     Route::any('/times', ['as' => 'api-categories', 'uses' => 'Api\V3\ClothesController@times']);
//     Route::any('/deliveryTypes', ['as' => 'api-categories', 'uses' => 'Api\V3\ClothesController@deliveryTypes']);

//     Route::group(['prefix' => 'products', 'middleware' => ['api', 'settings', 'https']], function () {
//         Route::post('/categories', ['as' => 'api-categories', 'uses' => 'Api\V3\ClothesController@getData']);
//     });
//     Route::group(['prefix' => 'orders', 'middleware' => ['api', 'settings', 'https']], function () {
//         Route::post('checkout', ['middleware' => 'api.auth', 'as' => 'api-auth', 'uses' => 'Api\V3\UserOrderController@create']);
//     });

// });

