<?php
Route::get('/','HomeController@index');
Route::get('home','HomeController@index');

//Authentication
Route::get('login','Auth\LoginController@login');
Route::post('login','Auth\LoginController@postLogin');
Route::get('logout','Auth\LoginController@logout');

//Users
Route::resource('users','UserController');
Route::get('create-user','UserController@createUser');
Route::get('account/profile','UserController@getProfile');
Route::get('account/settings','UserController@getSettings');
Route::get('account/settings/access','UserController@showChangePassword');
Route::post('account/settings/access','UserController@postChangePassword');

//User rights
Route::resource('access/rights','RolesController');

Route::resource('countries','CountryController');
Route::resource('regions','RegionController');
Route::get('fetch/districts/{id}','RegionController@getDistrictsById');
Route::resource('districts','DistrictController');
Route::resource('camps','CampController');
Route::resource('departments','DepartmentController');
Route::resource('psncodes','PSNCodesController');
Route::resource('psncodes-categories','PSNCodeCategoryController');

Route::resource('clients','ClientsController');
Route::get('getclientsjson','ClientsController@getJSonDataSearch');
Route::get('getclientslist','ClientsController@getJSonClientDataSearch');
Route::get('search/clients','ClientsController@searchClient');
Route::post('search/clients','ClientsController@postSearchClient');
Route::get('create-client','ClientsController@createClient');

//NFIs Item inventory
Route::resource('inventory-categories','ItemsCategoriesController');
Route::post('onflycategory','ItemsCategoriesController@onFlyCategory');
Route::resource('inventory','ItemInventoryController');
Route::resource('inventory-received','ItemsReceivingController');
Route::get('download/pdf/inventory-received/{id}','ItemsReceivingController@downloadPDF');
Route::get('print/inventory-received/{id}','ItemsReceivingController@loadPrintForm');
Route::get('fetchitemsbycategoryid/{id}','ItemsCategoriesController@getItemsList');


//Referrals
Route::resource('referrals','ReferralController');
Route::get('list-all-referrals','ReferralController@getReferralList');
Route::get('referrals-request','ReferralController@getReferralClientList');
Route::get('referrals-request/{id}','ReferralController@create');
Route::get('download/referrals/form/{id}','ReferralController@downloadPDF');

//Functional Assessments
Route::resource('assessments/functional','FunctionalAssessmentController');


//Vulnerability Assessments
Route::resource('assessments/vulnerability','VulnerabilityAssessmentController');
Route::get('clients-va','VulnerabilityAssessmentController@showClients');
Route::get('getvalist','VulnerabilityAssessmentController@getJSonDataSearch');
Route::get('client/assessments/vulnerability/{id}','VulnerabilityAssessmentController@showClientVulnerability');
Route::get('vulnerability-assessment/download/{id}','VulnerabilityAssessmentController@downloadForm');

//Paediatric Assessments
Route::resource('assessments/paediatric','PaediatricAssessmentController');
Route::get('clients-pd','PaediatricAssessmentController@showClients');
Route::get('getpdlist','PaediatricAssessmentController@getJSonDataSearch');
Route::get('client/assessments/paediatric/{id}','PaediatricAssessmentController@showClientPaediatric');
Route::get('paediatric-assessment/download/{id}','PaediatricAssessmentController@downloadForm');

//PSN Needs/Home assessment Form
Route::resource('assessments/home','HomeAssessmentController');
Route::get('clients-hm','HomeAssessmentController@showClients');
Route::get('list/assessments/home','HomeAssessmentController@getJSonAssessmentList');
Route::get('client/assessments/home/{id}','HomeAssessmentController@create');

//Progress monitoring
//Case management
Route::resource('cases','ClientCaseController');
Route::get('list-all-cases','ClientCaseController@getCasesList');
Route::get('download/cases/form/{id}','ClientCaseController@downloadPDF');


//Progressive note
Route::resource('progressive/notices','ProgressiveNoticeController');
Route::get('list-all-notices','ProgressiveNoticeController@getNoticeList');
Route::get('download/notice/pdf/{id}','ProgressiveNoticeController@downloadPDF');

//Import
Route::get('inventory-import','ItemInventoryController@showImport');
Route::post('inventory-import','ItemInventoryController@postImport');

//Referrals
Route::get('import/referrals','ReferralController@showImport');
Route::post('import/referrals','ReferralController@postImport');
//Clients
Route::get('import/clients','ClientsController@showImport');
Route::post('import/clients','ClientsController@postImport');
//Just for me
//Route::get('create-client','ClientsController@createClient');


Route::get('excel/import/received/items','ItemsReceivingController@showImport');
Route::post('excel/import/received/items','ItemsReceivingController@postImport');


//ItemsDisbursementController
Route::resource('items/distributions','ItemsDisbursementController');
Route::get('distributions/items/import','ItemsDisbursementController@showImport');
Route::post('distributions/items/import','ItemsDisbursementController@postImport');
Route::post('distributions/items/bulk','ItemsDisbursementController@postBulk');
Route::get('distributions/items/bulk','ItemsDisbursementController@showBulk');
Route::get('distributions/items/import/errors','ItemsDisbursementController@showImportErrors');
Route::get('download/pdf/items/distributions/{id}','ItemsDisbursementController@downloadPdf');
Route::get('print/items/distributions/{id}','ItemsDisbursementController@showPrint');


//WheelChairAssessment

Route::get('getwaclientsjson','WheelChairAssessmentController@getJSonClientData');
Route::get('getwaclientsjson-wc-list-all','WheelChairAssessmentController@getJSonWCListAllClientData');
Route::resource('assessments/wheelchair','WheelChairAssessmentController');
Route::post('assessments/wheelchair/wheelchairassessment','WheelChairAssessmentController@postData');
Route::get('wheelchair/view/{id}','WheelChairAssessmentController@show');
Route::post('assessments/wheelchair/{id}/edit','WheelChairAssessmentController@update');

//Audit logs
Route::get('audit/los','AuditController@index');
//ItemsReceivingController


//RehabilitationController
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
      'uses' => 'ClientReportsController@index',
      'as'   => 'reports/clients'
]);

Route::get('reports/referrals','ReferralReportsController@index');
Route::get('generate/reports/clients','ClientReportsController@index');
Route::post('generate/reports/clients','ClientReportsController@postGenerate');
Route::get('reports/assessments','DataVisualizationController@showAssessments');
//Inclusion Assessments
Route::resource('assessments/inclusion','InclusionAssessmentController');
Route::get('get-inclass-clientsjson','InclusionAssessmentController@getJSonClientData');
Route::get('assessments/inclusion/client-to-assess/{id}','InclusionAssessmentController@getSelectedClientInfo');
Route::post('assessments/inclusion/store-assessment','InclusionAssessmentController@postData');
Route::get('inclusion-get-assessed-clients','InclusionAssessmentController@getJSONIncAssessmentListAllClientData');
Route::get('assessments/inclusion/view/{id}','InclusionAssessmentController@getClientData');
Route::post('assessments/inclusion/{id}/update-assessment','InclusionAssessmentController@update');