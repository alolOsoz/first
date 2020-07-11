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
Route::namespace('Front')->group(function (){
    Route::get('users');
});
//Route::get('second','Admin\SecondController@showString');
Route::group(['namespace' =>'Admin'],function (){
    Route::get('second','SecondController@showString0')->middleware('auth');
    Route::get('second1','SecondController@showString1');
    Route::get('second2','SecondController@showString2');
    Route::get('second3','SecondController@showString3');


});

Route::get('login',function (){
   return 'must be log';
})->name('login');
Route::resource('news','NewsController');
Route::get('index','Front\UserController@showboot');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
