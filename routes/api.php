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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/all-car-details', 'ApiController\ClientController@getAllCars');
Route::get('/car-details/{id}', 'ApiController\ClientController@getCarDetails');

Route::get('/new-cars', 'ApiController\ClientController@getNewCars');
Route::get('/old-cars', 'ApiController\ClientController@getOldCars');

Route::post('/sign-up', 'ApiController\ClientController@saveSeller');

Route::post('/log-in', 'ApiController\ClientController@sellerLogin');
Route::get('/user-profile/{id}', 'ApiController\ClientController@getUserProfile');
Route::get('/all-brands', 'ApiController\ClientController@getAllBrands');
Route::get('/{brand}', 'ApiController\ClientController@getModel');
Route::get('/{brand}/{model}', 'ApiController\ClientController@getVersion');

Route::post('/add-car-for-sale/', 'ApiController\ClientController@saveCarForSale');
Route::post('/post-question', 'ApiController\ClientController@postQuestions');

Route::delete('car-for-sale/{id}', 'ApiController\ClientController@delete');




