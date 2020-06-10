<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::post('/messages', 'ChatController@sendMessage');

Route::get('/messages', 'ChatController@fetchMessages');

Route::get('/room/{room}', 'ChatController@getMessage');

Route::get('/joinRoom1', 'ChatController@joinRoom1');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/profile/create', 'ProfileController@create')->name('profile.create');

Route::post('/profile', 'ProfileController@store')->name('profile.store');

Route::get('/profile/{profile}', 'ProfileController@show')->name('profile.show');

Route::get('/profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit');

Route::patch('/profile/{profile}', 'ProfileController@update')->name('profile.update');

Route::delete('/profile/{profile}', 'ProfileController@destroy')->name('profile.destroy');



Route::get('/statistics/{user}', 'StatisticsController@index')->name('statistics');

Route::get('/statistics/mail/{user}', 'StatisticsController@emailStatistics')->name('statistics.mail');


Route::group([ 'middleware'	=>	'admin'], function(){

Route::get('/admin/users','Admin\UserController@index')->name('admin.users.index');

Route::get('/admin/users/{user}','Admin\UserController@show')->name('admin.users.show');

Route::get('/admin/users/{user}/edit','Admin\UserController@edit')->name('admin.users.edit');

Route::patch('/admin/users/{user}','Admin\UserController@update')->name('admin.users.update');

Route::delete('/admin/users/{user}', 'Admin\UserController@destroy')->name('admin.users.destroy');


Route::get('/admin/dashboard','Admin\DashboardController@index')->name('admin.dashboard');


Route::get('/admin/messages','Admin\MessageController@index')->name('admin.messages.index');

Route::get('/admin/messages/{message}','Admin\MessageController@show')->name('admin.messages.show');

Route::get('/admin/messages/{message}/edit','Admin\MessageController@edit')->name('admin.messages.edit');

Route::patch('/admin/messages/{message}','Admin\MessageController@update')->name('admin.messages.update');

Route::delete('/admin/messages/{message}', 'Admin\MessageController@destroy')->name('admin.messages.destroy');

});

Route::group(['middleware'=>'guest'],function (){

    Route::get('/sign-in/github','Auth\LoginController@redirectToProvider');

    Route::get('/sign-in/github/redirect','Auth\LoginController@handleProviderCallback');
});
