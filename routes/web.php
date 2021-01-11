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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@redirect');


Route::get('fillable', 'CrudController@getOffers');



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function (){
        Route::group(['prefix' => 'offers'], function (){
//            Route::get('story', 'CrudController@story');
            Route::get('create', 'CrudController@create');
            Route::post('store', 'CrudController@store') -> name('offers.store');
            Route::get('all', 'CrudController@getAllOffers');
        });
});
