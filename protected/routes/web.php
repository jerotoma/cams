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

//Users
Route::get('login','UserController@login');
Route::post('login','UserController@postLogin');
Route::get('logout','UserController@logout');
Route::get('users/create','UserController@create');
Route::post('users/store','UserController@store');
Route::get('users','UserController@index');
Route::get('users/{id}/edit','UserController@edit');
Route::get('users/{id}/view','UserController@show');
Route::post('users/{id}/update','UserController@update');
Route::get('users/{id}/delete','UserController@destroy');

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
Route::get('getclientslist','ClientsController@getJSonClientDataSearch');
Route::get('search/clients','ClientsController@searchClient');
Route::post('search/clients','ClientsController@postSearchClient');

Route::resource('inventory-categories','ItemsCategoriesController');
Route::resource('inventory','ItemInventoryController');
Route::resource('inventory-received','ItemsReceivingController');

//Referrals
Route::resource('referrals','ReferralController');
Route::get('list-all-referrals','ReferralController@getReferralList');
Route::get('referrals-request','ReferralController@getReferralClientList');
Route::get('referrals-request/{id}','ReferralController@create');
Route::get('download/referrals/form/{id}','ReferralController@downloadPDF');


//Assessments
Route::resource('assessments/vulnerability','VulnerabilityAssessmentController');
Route::resource('assessments/wheelchair','VulnerabilityAssessmentController');
Route::resource('assessments/inclusion','VulnerabilityAssessmentController@inclusion');
Route::get('clients-va','VulnerabilityAssessmentController@showClients');
Route::get('getvalist','VulnerabilityAssessmentController@getJSonDataSearch');
Route::get('client/assessments/vulnerability/{id}','VulnerabilityAssessmentController@showClientVulnerability');
Route::get('vulnerability-assessment/download/{id}','VulnerabilityAssessmentController@downloadForm');

//PSN Needs/Home assessment Form
Route::resource('assessments/home','HomeAssessmentController');
Route::get('clients-hm','HomeAssessmentController@showClients');
Route::get('list/assessments/home','HomeAssessmentController@getJSonAssessmentList');
Route::get('client/assessments/home/{id}','HomeAssessmentController@create');

//Import
Route::get('inventory-import','ItemInventoryController@showImport');
Route::post('inventory-import','ItemInventoryController@postImport');

//Referrals
Route::get('import/referrals','ReferralController@showImport');
Route::post('import/referrals','ReferralController@postImport');
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


//RehabilitationControllers
Route::get('rehabilitation/register',[
      'uses' => 'RehabilitationController@index',
      'as'   => 'rehabilitation/register'
]);
Route::get('rehabilitation/export',[
      'uses' => 'RehabilitationController@export',
      'as'   => 'rehabilitation/export'
]);
Route::get('rehabilitation/import',[
      'uses' => 'RehabilitationController@import',
      'as'   => 'rehabilitation/import'
]);
Route::get('rehabilitation/progress',[
      'uses' => 'RehabilitationController@progress',
      'as'   => 'rehabilitation/progress'
]);

//Data Visualization
Route::get('reports/clients',[
      'uses' => 'DataVisualizationController@registration',
      'as'   => 'reports/clients'
]);
Route::get('reports/clients',[
      'uses' => 'DataVisualizationController@assessments',
      'as'   => 'reports/clients'
]);
Route::get('reports/clients',[
      'uses' => 'DataVisualizationController@referral',
      'as'   => 'reports/clients'
]);





