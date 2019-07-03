<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/car', 'CarController@allcars');=Route::get('/car', 'CarController@allcars')->name('car');
Route::get('/car', 'CarController@allcars');
Route::get('/newcar', 'CarController@newcar');
Route::post('/carsAction', 'CarController@storecar')->name('carsAction');
//Route::get('/car/{id}', 'CarController@particularcar');
Route::get('/review', 'ReviewsController@allreviews');
Route::get('/newreview', 'ReviewsController@newreview');
Route::post('/reviewsAction', 'ReviewsController@storereview')->name('reviewsAction');
//Route::post('/reviews', 'ReviewsController@carreview')->name('reviews');
Route::get('/carreviews', 'CarController@carreviews');
Route::get('/carreviewsAction', 'CarController@carIDreviews')->name('carreviewsAction');
//
Route::get('/cardetailsAction', 'ReviewsController@cardetails')->name('cardetailsAction');



