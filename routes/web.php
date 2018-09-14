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

Auth::routes();

// Home Page -- shows the login or redirects to the indicators page if the user is logged in
Route::get('/', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Personal Profile Routes
|--------------------------------------------------------------------------
|
*/
Route::get('profile', 'ProfileController@edit')->name('edit');
Route::patch('profile', 'ProfileController@update')->name('update');
Route::get('profile/disable', 'ProfileController@disable')->name('disable');
Route::get('password/update', 'ProfileController@editPassword')->name('password.edit');
Route::patch('password/update', 'ProfileController@updatePassword')->name('password.update');

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
*/
Route::get('users', 'UsersController@index')->name('users.index');
Route::post('users', 'UsersController@store')->name('users.store');
Route::get('users/create', 'UsersController@create')->name('users.create');
Route::get('users/{username}', 'UsersController@edit')->name('users.edit');
Route::patch('users/{username}', 'UsersController@update')->name('users.update');
Route::delete('users/{username}', 'UsersController@destroy')->name('users.destroy');
Route::patch('users/{username}/password/reset', 'UsersController@resetPassword')->name('users.resetPassword');

 /*
 |--------------------------------------------------------------------------
 | Indicators Routes
 |--------------------------------------------------------------------------
 |
 */
// Mainboard Request
Route::get('indicators', 'IndicatorsController@mainboard')->name('indicators');
// Agriculture Request
Route::get('indicators/agriculture', 'IndicatorsController@agriculture')->name('indicators.agriculture');
// Energy Request
Route::get('indicators/energy', 'IndicatorsController@energy')->name('indicators.energy');
// Forestry Request
Route::get('indicators/forestry', 'IndicatorsController@forestry')->name('indicators.forestry');
// Water Request
Route::get('indicators/water', 'IndicatorsController@water')->name('indicators.water');
// Gender Request
Route::get('indicators/gender', 'IndicatorsController@gender')->name('indicators.gender');
// Land Rights Request
Route::get('indicators/land-rights', 'IndicatorsController@landRights')->name('indicators.land');
// Government Links Request
Route::get('indicators/gov-links', 'IndicatorsController@govLinks')->name('indicators.gov');
