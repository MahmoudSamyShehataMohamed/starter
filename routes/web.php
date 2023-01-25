<?php

define('PAGINATION_COUNT',3);

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');


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
######################### Begin CROUD routes ##################################
        Route::group(['prefix'=>'offers'],function(){

            Route::get('create','TestController@create')->name('offers.create');
            Route::post('store','TestController@store')->name('offers.store');

            Route::get('index','TestController@index')->name('offers.index');

            Route::get('edit/{offer_id}','TestController@edit')->name('offers.edit');
            Route::post('update/{offer_id}','TestController@update')->name('offers.update');

            Route::get('delete{offer_id}','TestController@delete')->name('offers.delete');

});
######################### End CROUD routes ####################################


######################### Begin ajax routes ##################################
Route::group(['prefix'=>'ajax'],function(){

    Route::get('create','AjaxController@create')->name('ajax.create');
    Route::post('store','AjaxController@store')->name('ajax.store');

    Route::get('index','AjaxController@index')->name('ajax.index');

    Route::post('delete','AjaxController@delete')->name('ajax.delete');


    Route::get('edit/{offer_id}', 'AjaxController@edit')->name('ajax.edit');
    Route::post('update', 'AjaxController@update')->name('ajax.update');

});
######################### End ajax routes ####################################


});



######################### Start Authentication and guards ####################################
Route::get('/not-adualt',function(){
    return "you are not adualt";
})->name('not-adualt');


Route::group(['namespace'=>'Auth','middleware'=>'CheckAge'],function(){

    Route::get('adualts','CustomAuthController@adualts')->name('adualts');

});


Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');
Route::get('site','Auth\CustomAuthController@site')->middleware('auth:web')->name('site');

Route::get('admin/login','Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login','Auth\CustomAuthController@CheckAdminLogin')->name('save.admin.login');

######################### End   Authentication and guards ####################################




######################### Start one to one relation ####################################

Route::get('has-one','Relation\RelationsController@hasOne');
Route::get('has-one-reverse','Relation\RelationsController@hasOneReverse');
Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');
Route::get('get-user-has-phone-with-condition','Relation\RelationsController@getUserHasPhoneWithCondition');
Route::get('get-user-not-has-phone','Relation\RelationsController@getUserNotHasPhone');

######################### End one to one relation  ####################################



######################### Start one to many relation ####################################
Route::get('hospital-has-many','Relation\RelationsController@getHospitalDoctors');
Route::get('hospital','Relation\RelationsController@hospital');
Route::get('delete/{hospital_id}','Relation\RelationsController@delete')->name('delete.hospital');
Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')->name('hospitals.doctors');

Route::get('hospitals_has_doctors','Relation\RelationsController@hospitalsHasDoctors');
Route::get('hospitals_has_doctors_male','Relation\RelationsController@hospitalsHasDoctorsMale');
Route::get('hospitals_has_no_doctors','Relation\RelationsController@hospitalsHasNoDoctors');
Route::get('doctors-services','Relation\RelationsController@getDoctorServices');

Route::get('services-doctors','Relation\RelationsController@getServicesDoctor');

Route::get('showservices/{doctor_id}','Relation\RelationsController@showServices')->name('show.services');
Route::post('store-service','Relation\RelationsController@storeService')->name('store.service');


Route::get('has-one-throught','Relation\RelationsController@getPatientDoctor');
Route::get('has-many-throught','Relation\RelationsController@getContryDoctor');
######################### End   one to many relation ####################################

Route::get('data-table','TestController@showDataTable');























/*
    Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');
    Route::post('file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');

    Route::get('file1', 'TestFile@file1')->name('file1');
    Route::post('file2', 'TestFile@file2')->name('file2');
*/
