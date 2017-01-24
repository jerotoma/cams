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

Route::get('/','HomeController@index');
Route::get('home','HomeController@index');
Route::get('login','UserController@login');
Route::post('login','UserController@postLogin');
Route::get('logout','UserController@logout');

//Countries
Route::resource('countries','CountryController');
Route::resource('regions','RegionController');
Route::get('fetch/districts/{id}','RegionController@getDistrictsById');
Route::resource('districts','DistrictController');
Route::resource('camps','CampController');
Route::resource('departments','DepartmentController');
Route::resource('psncodes','PSNCodesController');
Route::resource('clients','ClientsController');
Route::resource('inventory','ItemInventoryController@index');
Route::resource('inventory/categories','ItemsCategoriesController@index');
Route::resource('inventory/disbursement','ItemsDisbursementController@index');
Route::resource('inventory/received','ItemsReceivingController@index');

//Assessments
Route::resource('assessments/vulnerability','VulnerabilityController@index');

//Import
Route::get('inventory/import','ItemInventoryController@showImport');
Route::post('inventory/import','ItemInventoryController@postImport');
Route::get('inventory/disbursement/import','ItemsDisbursementController@showImport');
Route::post('inventory/disbursement/import','ItemsDisbursementController@postImport');



