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
Route::get('getclientsjson','ClientsController@getJSonDataSearch');
Route::get('search/clients','ClientsController@searchClients');
Route::post('search/clients','ClientsController@postSearchClient');

Route::resource('inventory-categories','ItemsCategoriesController');
Route::resource('inventory','ItemInventoryController');
Route::resource('inventory-received','ItemsReceivingController');

//Assessments
Route::resource('assessments/vulnerability','VulnerabilityAssessmentController');
Route::get('getvalist','VulnerabilityAssessmentController@getJSonDataSearch');
Route::get('client/assessments/vulnerability/{id}','VulnerabilityAssessmentController@showClientVulnerability');


//Import
Route::get('inventory-import','ItemInventoryController@showImport');
Route::post('inventory-import','ItemInventoryController@postImport');
//Clients
Route::get('import/clients','ClientsController@showImport');
Route::post('import/clients','ClientsController@postImport');


Route::get('excel/import/received/items','ItemsReceivingController@showImport');
Route::post('excel/import/received/items','ItemsReceivingController@postImport');


//ItemsDisbursementController
Route::get('inventory/disbursement','ItemsDisbursementController@index');
Route::get('inventory/disbursement/beneficiaries','ItemsDisbursementController@showBeneficiaries');
Route::get('inventory/disbursement/create/{id}','ItemsDisbursementController@create');
Route::post('inventory/disbursement/create','ItemsDisbursementController@store');
Route::get('inventory/disbursement/edit/{id}','ItemsDisbursementController@edit');
Route::get('inventory/disbursement/print/{id}','ItemsDisbursementController@show');
Route::get('inventory/disbursement/pdf/{id}','ItemsDisbursementController@downloadPdf');
Route::post('inventory/disbursement/edit','ItemsDisbursementController@update');
Route::get('inventory/disbursement/show/{id}','ItemsDisbursementController@show');
Route::get('inventory/disbursement/remove/{id}','ItemsDisbursementController@destroy');
Route::get('inventory/disbursement/reports','ItemsDisbursementController@reports');
Route::get('inventory/disbursement/import','ItemsDisbursementController@showImport');
Route::post('inventory/disbursement/import','ItemsDisbursementController@postImport');
Route::get('inventory/disbursement/import/errors','ItemsDisbursementController@showImportErrors');



//ItemsReceivingController




