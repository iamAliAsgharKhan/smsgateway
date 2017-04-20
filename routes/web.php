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

Route::get('/', 'AppController')->name('app');

Route::group(['middleware' => 'auth', 'prefix' => 'message', 'as' => 'message.'], function(){
    Route::get('paginate', 'MessageController@paginate')->name('paginate');
    Route::post('send', 'MessageController@send')->name('send');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('paginate', 'UserController@paginate')->name('paginate');
    Route::put('profile', 'UserController@profile')->name('profile');
    Route::get('view', 'UserController@view')->name('view');
    Route::put('password', 'PasswordController@update')->name('password.update');
});

Route::get('setting/all', 'SettingController@all')->name('setting.all');
Route::put('setting', 'SettingController@update')->name('setting.update');

Auth::routes();

Route::get('/home', 'HomeController@index');
