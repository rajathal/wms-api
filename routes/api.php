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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'api\UserController@login');
Route::post('register', 'api\UserController@register');
Route::group(['middleware' => 'auth:api'], function()
{
   Route::post('details', 'api\UserController@details');
});

Route::post('driverlogin', 'api\DriverController@login');
//Route::post('partners', ['as'=>'partners','uses'=>'Franchisor\Auth\FranchisorLoginController@login']);
//Route::group(['middleware' => 'guest:api'], function(){
Route::namespace('drivers')->prefix('accountuser')->group(function() {
   // GUEST/UNAUTHORIZED USERS
   // ENLIST routes here
});