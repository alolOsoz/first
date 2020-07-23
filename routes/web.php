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

Route::get('/', function () {
//    $data=[];
//    $data['age']=21;
//    $data['name']='ali osama';

    return view('welcome');//->with($data);
});
Route::get('/show-all-prod/', function () {
    return 'hello';
})->name('ali');
Route::get('/add-new-prod/{id}', function ($id) {
    return $id;
})->name('abo');
Route::namespace('Front')->group(function () {
    Route::get('users');
});
Route::get('second','Admin\SecondController@showString');
Route::group(['namespace' => 'Admin'], function () {
    Route::get('second', 'SecondController@showString0')->middleware('auth');
    Route::get('second1', 'SecondController@showString1');
    Route::get('second2', 'SecondController@showString2');
    Route::get('second3', 'SecondController@showString3');


});

Route::get('login', function () {
    return 'must be log';
})->name('login');
Route::resource('news', 'NewsController');
Route::get('index', 'Front\UserController@showboot');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');
Route::get('/fillable', 'CrudController@getoffers');


//  Route::get('store','CrudController@store');
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('edit/{offer_id}', 'CrudController@edit');
        Route::post('update/{offer_id}', 'CrudController@update')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');
        Route::get('index', 'CrudController@index')->name('offers.all');
        Route::get('get-inactive-offers', 'CrudController@getInactiveOffers');

    });
});

Route::get('youtube', 'YoutubeController@getvideo')->middleware('auth');
#################  ajax###################################################################################################################################################################
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'ajaxoffers'], function () {
        Route::get('create', 'Offers\OfferController@create');
        Route::post('save', 'Offers\OfferController@save')->name('ajaxoffers.save');
        Route::get('edit/{offer_id}', 'Offers\OfferController@edit')->name('ajax.offers.edit');
        Route::post('update', 'Offers\OfferController@update')->name('ajax.offers.update');
        Route::post('delete', 'Offers\OfferController@delete')->name('ajax.offers.delete');
        Route::get('all', 'Offers\OfferController@all')->name('ajax.offers.all');

    });

});
#################  ajax###################################################################################################################################################################
Route::group(['middleware' => 'CheckAge',], function () {

    Route::get('adult', 'CustomAuthController@adult')->name('adult');
});

Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')-> name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin') -> name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/loginp', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');

##################### relation one to one ###########################
Route::get('has-one','Relation\RelationController@hasone');
Route::get('has-one-reverse','Relation\RelationController@hasonereverse');
Route::get('has-one-has-phones','Relation\RelationController@getuserphone');
Route::get('has-one-has-phones-condition','Relation\RelationController@getuserphonecondition');
Route::get('has-one-has-no-phones','Relation\RelationController@getusernophone');

##################### relation one to many ###########################
Route::get('has-one-many','Relation\RelationController@hasonemany');
Route::get('hospitals','Relation\RelationController@hospitals')->name('hospital.all');
Route::get('hospitals/{hospital_id}','Relation\RelationController@delete')->name('hospital.delete');
Route::get('doctors/{hospital_id}','Relation\RelationController@doctors')->name('hospital.doctors');
Route::get('hospitals-has-doc','Relation\RelationController@hospitalsHasDoctor');
Route::get('hospitals-has-doc-male','Relation\RelationController@hospitalsHasDoctorMale');
Route::get('hospitals-not-has-doc','Relation\RelationController@hospitalsNotHasDoctor');
###################### relation many to many # ######################################
Route::get('doctors-services','Relation\RelationController@getDoctorService');
Route::get('services-doctors','Relation\RelationController@getServiceDoctor');
Route::get('doctors/services/{doctor_id}','Relation\RelationController@getDoctorServiceById')->name('doctors.service');
Route::post('saveServiceToDoctor','Relation\RelationController@saveServiceDoctor')->name('save.doctors.service');
################################## has through ##################################
Route::get('has-one-through','Relation\RelationController@getPatientDoctor');
Route::get('has-many-through','Relation\RelationController@getCountryDoctor');
Route::get('hospital-many-country','Relation\RelationController@getCountryHospital');

##################### relation ##############################################

Route::get('accessor','Relation\RelationController@getdoctor');




