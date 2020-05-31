<?php

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

// Route::get('/', function () {
//     return view('admin.dashboard');
// });

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

Route::prefix('/admin')->group(function() {
	Route::group(['prefix' => '/cars',  'middleware' => 'auth'], function() {
    Route::get('/','CarController@index')->name('car.index');
    Route::get('/addCar','CarController@showForm')->name('car.form');
    Route::post('/store','CarController@store')->name('car.store');

    Route::get('/editCar/{id}', 'CarController@edit')->name('car.edit');
     Route::post('/updateCar/{id}', 'CarController@update')->name('car.update');
     Route::get('/delete/{id}','CarController@delete')->name('car.delete');

    Route::post('/updateImage','CarController@updateImage')->name('car.updateImage');

    Route::post('/removeImage','CarController@removeImage')->name('car.removeImage');
  });

	Route::group(['prefix' => '/cars-on-sale',  'middleware' => 'auth'], function() {

	    Route::get('/','SellingCarsController@index')->name('sellingcar.index');

	    Route::get('/add-car-for-sale','SellingCarsController@showForm')->name('sellingcar.form');

	    Route::post('/fetch','SellingCarsController@fetch')->name('sellingcar.fetch');

	    Route::post('/store','SellingCarsController@store')->name('sellingcar.store');

	    Route::get('/edit-car-for-sale/{id}', 'SellingCarsController@edit')->name('sellingcar.edit');

	     Route::post('/update-car-for-sale/{id}', 'SellingCarsController@update')->name('sellingcar.update');

	    Route::post('/updateImage','SellingCarsController@updateImage')->name('sellingcar.updateImage');

	    Route::post('/removeImage','SellingCarsController@removeImage')->name('sellingcar.removeImage');

	     Route::get('/delete/{id}','SellingCarsController@delete')->name('sellingcar.delete');
      });

      Route::group(['prefix' => '/seller',  'middleware' => 'auth'], function() {
        Route::get('/','SellerController@index')->name('seller.index');
        Route::get('/addSeller','SellerController@showForm')->name('seller.form');
        Route::post('/store','SellerController@store')->name('seller.store');

        Route::get('/edit/{id}', 'SellerController@edit')->name('seller.edit');
         Route::post('/update/{id}', 'SellerController@update')->name('seller.update');
         Route::get('/delete/{id}','SellerController@delete')->name('seller.delete');

      });

});


