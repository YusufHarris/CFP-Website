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
Route::get('users', 'UsersController@index')->name('users');
Route::post('users', 'UsersController@store')->name('user.store');
Route::get('users/create', 'UsersController@create')->name('user.create');
Route::get('users/{username}', 'UsersController@edit')->name('user.edit');
Route::patch('users/{username}', 'UsersController@update')->name('user.update');
Route::delete('users/{username}', 'UsersController@destroy')->name('user.destroy');
Route::patch('users/{username}/password/reset', 'UsersController@resetPassword')->name('user.resetPassword');

/*
|--------------------------------------------------------------------------
| Employees Routes
|--------------------------------------------------------------------------
|
*/
Route::get('employees', 'EmployeeController@index')->name('employees');
Route::get('employees/create', 'EmployeeController@create')->name('employee.create');
Route::post('employees','EmployeeController@store')->name('employee.store');
Route::get('employees/{id}', 'EmployeeController@edit')->name('employee.edit');
Route::post('employees{id}','EmployeeController@update')->name('employee.update');
Route::delete('employees/{id}','EmployeeController@destroy')->name('employee.destroy');
/*
|--------------------------------------------------------------------------
| Donor Routes
|--------------------------------------------------------------------------
|
*/
Route::get('donors', 'DonorController@index')->name('donors');
Route::get('donors/create', 'DonorController@create')->name('donor.create');
Route::post('donors','DonorController@store')->name('donor.store');
Route::get('donors/{id}', 'DonorController@edit')->name('donor.edit');
Route::post('donors/{id}','DonorController@update')->name('donor.update');
Route::delete('donors/{id}','DonorController@destroy')->name('donor.destroy');
/*
|--------------------------------------------------------------------------
| Beneficiaries Routes
|--------------------------------------------------------------------------
|
*/
Route::get('beneficiaries', 'BeneficiaryController@index')->name('beneficiaries');
Route::get('beneficiaries/create','BeneficiaryController@create')->name('beneficiary.create');
Route::post('beneficiaries','BeneficiaryController@store')->name('beneficiary.store');
Route::get('beneficiaries/{id}','BeneficiaryController@edit')->name('beneficiary.edit');
Route::post('beneficiaries/{id}','BeneficiaryController@update')->name('beneficiary.update');
Route::delete('beneficiaries/{id}','BeneficiaryController@destroy')->name('beneficiary.destroy');

/*
|--------------------------------------------------------------------------
| Photos Routes
|--------------------------------------------------------------------------
*/
Route::get('galleries/{id}/photo/create','PhotoController@create')->name('photo.create')->middleware('auth');
Route::post('galleries/{id}','PhotoController@store')->name('photo.store')->middleware('auth');
Route::delete('galleries/{id}/image','PhotoController@destroy')->name('photo.destroy')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Galleries Routes
|--------------------------------------------------------------------------
|
*/
Route::get('galleries','GalleryController@index')->name('galleries');
Route::get('galleries/create','GalleryController@create')->name('gallery.create');
Route::post('galleries','GalleryController@store')->name('gallery.store');
Route::get('galleries/{id}','GalleryController@show')->name('gallery.show');
Route::delete('galleries/{id}','GalleryController@destroy')->name('gallery.destroy');

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
