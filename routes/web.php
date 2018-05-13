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

// Mainboard Request
Route::get('/', 'MainboardController@index');
// Mainboard Request filtering for a community
Route::post('/', 'MainboardController@communityFilter');
// Agriculture Request
Route::get('/agriculture', 'AgricultureController@index');
// Energy Request
Route::get('/energy', 'EnergyController@index');
// Forestry Request
Route::get('/forestry', 'ForestryController@index');
// Water Request
Route::get('/water', 'WaterController@index');
// Gender Request
Route::get('/gender', 'GenderController@index');
// Gender Request
Route::get('/land-rights', 'LandRightsController@index');
// Government Linkages Request
Route::get('/gov-links', 'GovLinksController@index');
// Tree Diagram
Route::get('/tree_diagram', 'TreeDiagramController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
