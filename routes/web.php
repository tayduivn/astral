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

// Admin Routes
Route::group(
  ['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'],
  function() {
  // Index
  Route::get('/', 'AdminController@index')->name('index');
  // Shows resource
  Route::resource('shows', 'ShowController');
  // Users resource
  Route::resource('users', 'UserController');
  // Events resource
  Route::resource('events', 'EventController');
  // Setting resource
  Route::resource('settings', 'SettingController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account', 'HomeController@account')->name('account');
