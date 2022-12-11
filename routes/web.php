<?php


Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/', function () {
    return view('welcome');
});


Route::get('fillable','TestController@getOffers');
Route::get('test1','TestController@store');





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix'=>'offers'],function(){
            Route::get('create','TestController@create');
            Route::get('store2','TestController@store2')->name('offers.store2');
        });
    });


