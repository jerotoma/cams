<?php
Route::get('/','HomeController@index');
Route::get('home','HomeController@index');

//test
Route::get('fingerprint','FingerprintController@index');

//Authentication
Route::get('login','Auth\LoginController@login');
Route::post('login','Auth\LoginController@postLogin');
Route::post('logout','Auth\LoginController@logout')->name('logout');

//Users
Route::resource('users','UserController');
Route::get('account/profile','UserController@getProfile');
Route::get('account/settings','UserController@getSettings');
Route::get('account/settings/access','UserController@showChangePassword');
Route::post('account/settings/access','UserController@postChangePassword');

//Audits
Route::resource('audit/logs','AuditController');

//Clients needs
Route::resource('setting/client/needs','ClientNeedsController');
//Cash monitoring

Route::resource('cash/monitoring/budget','CashBudgetController');
Route::resource('cash/monitoring/provision','CashProvisionController');
Route::resource('post/cash/monitoring','PostCashMonitoringController');
Route::get('list-post-cash-monitoring','PostCashMonitoringController@getPostCashMonitoringList');
Route::get('download/pdf/post/cash/monitoring/{id}','PostCashMonitoringController@downloadPdf');
Route::get('print/post/cash/monitoring/{id}','PostCashMonitoringController@showPrint');

//Authorize
Route::post('authorize/post/cash/monitoring','PostCashMonitoringController@AuthorizeAll');
Route::post('authorize/post/cash/{id}/monitoring','PostCashMonitoringController@AuthorizePostCashAssessmentById');


Route::get('print/cash/monitoring/provision/{id}','CashProvisionController@showPrint');
Route::get('download/pdf/cash/monitoring/provision/{id}','CashProvisionController@downloadPdf');
Route::get('bulk/cash/monitoring/provision','CashProvisionController@showBulk');
Route::post('bulk/cash/monitoring/provision','CashProvisionController@postBulk');
Route::get('list-cash-provisions','CashProvisionController@getCashProvisionsList');

//Imports errors
Route::get('import/cash/monitoring/provision/errors','CashProvisionController@showImportErrors');
Route::get('download/import/cash/monitoring/provision/errors','CashProvisionController@downloadImportErrors');

//Authorize
Route::post('authorize/cash/monitoring/provision','CashProvisionController@AuthorizeAll');
Route::post('authorize/cash/monitoring/{id}/provision','CashProvisionController@AuthorizeCashProvisionById');

//User rights
Route::resource('access/rights','RolesController');

Route::resource('countries','CountryController');
Route::resource('origins','OriginController');

Route::resource('regions','RegionController');
Route::get('fetch/districts/{id}','RegionController@getDistrictsById');
Route::resource('districts','DistrictController');
Route::resource('camps','CampController');
Route::resource('departments','DepartmentController');
Route::resource('psncodes','PSNCodesController');
Route::resource('psncodes-categories','PSNCodeCategoryController');

Route::resource('clients','ClientController');

//Authorize
Route::post('authorize/all/clients','ClientController@authorizeAll');
Route::post('authorize/{id}/clients','ClientController@authorizeClientById');

Route::get('getclientslist','ClientController@getJSonClientDataSearch');
Route::get('search/clients','ClientController@searchClient');
Route::post('search/clients','ClientController@postSearchClient');
Route::post('advanced/search/clients','ClientController@advancedSearchClient');

Route::get('create-client','ClientController@createClient');

//NFIs Item inventory
Route::resource('inventory-categories','ItemsCategoriesController');
Route::resource('/inventories/categories','ItemsCategoriesController');
Route::post('onflycategory','ItemsCategoriesController@onFlyCategory');
Route::resource('inventories','ItemInventoryController');
Route::resource('inventory','ItemInventoryController');

//Item received
Route::get('list-items-received','ItemsReceivingController@getListItemsReceived');
Route::resource('inventory-received','ItemsReceivingController');
Route::resource('/inventories/received-items','ItemsReceivingController');
Route::get('download/pdf/inventory-received/{id}','ItemsReceivingController@downloadPDF');
Route::get('print/inventory-received/{id}','ItemsReceivingController@loadPrintForm');
Route::get('fetchitemsbycategoryid/{id}','ItemsCategoriesController@getItemsList');

//Authorize
Route::post('authorize/inventory/received','ItemsReceivingController@AuthorizeAll');

//Referrals
Route::resource('referrals','ReferralController');
Route::get('list-all-referrals','ReferralController@getReferralList');
Route::get('authorize/referrals','ReferralController@authorizeAllReferrals');
Route::get('referrals-request','ReferralController@getReferralClientList');
Route::get('referrals-request/{id}','ReferralController@create');
Route::get('referrals/download/{id}','ReferralController@downloadPDF');
Route::get('getreferralpsnprofile/{id}','ReferralController@getClientProfile');

//Authorize
Route::post('authorize/referrals','ReferralController@AuthorizeAll');
Route::post('authorize/{id}/referrals','ReferralController@AuthorizeReferralsById');

//Functional Assessments
Route::resource('assessments/functional','FunctionalAssessmentController');


//Vulnerability Assessments
Route::resource('assessments/vulnerability','VulnerabilityAssessmentController');
Route::get('clients-va','VulnerabilityAssessmentController@showClients');
Route::get('client/assessments/vulnerability/{id}','VulnerabilityAssessmentController@showClientVulnerability');
Route::get('assessments/vulnerability/download/{id}','VulnerabilityAssessmentController@downloadForm');
Route::get('getvulassessmentpsnprofile/{id}','VulnerabilityAssessmentController@getPSNProfile');

//Authorize
Route::post('authorize/assessments/vulnerability','VulnerabilityAssessmentController@authorizeAll');
Route::post('authorize/assessments/{id}/vulnerability','VulnerabilityAssessmentController@authorizeAssessmentById');


//Paediatric Assessments
Route::resource('assessments/paediatric','PaediatricAssessmentController');
Route::get('clients-pd','PaediatricAssessmentController@showClients');
Route::get('getpdlist','PaediatricAssessmentController@getJSonDataSearch');
Route::get('client/assessments/paediatric/{id}','PaediatricAssessmentController@showClientPaediatric');
Route::get('paediatric-assessment/download/{id}','PaediatricAssessmentController@downloadForm');

//PSN Needs/Home assessment Form
Route::get('clients-hm','HomeAssessmentController@showClients');
Route::get('assessments/home/{id}/download','HomeAssessmentController@downloadPDF');
Route::get('gethomeassessmentpsnprofile/{id}','HomeAssessmentController@getPSNProfile');
Route::resource('assessments/home','HomeAssessmentController');

//Authorize
Route::post('authorize/home/assessments','HomeAssessmentController@AuthorizeAll');
Route::post('authorize/home/{id}/assessments','HomeAssessmentController@AuthorizeAssessmentById');

Route::get('client/assessments/home/{id}','HomeAssessmentController@create');

//Progress monitoring
//Case management
Route::resource('cases','ClientCaseController');
Route::get('list-all-cases','ClientCaseController@getCasesList');
Route::get('download/cases/form/{id}','ClientCaseController@downloadPDF');
//Authorize
Route::post('authorize/cases/clients/all','ClientCaseController@AuthorizeAll');
Route::post('authorize/cases/{id}/clients','ClientCaseController@AuthorizeClientCaseById');

//Progressive note
Route::resource('progressive/notices','ProgressNoteController');
Route::get('list-all-notices','ProgressNoteController@getNoticeList');
Route::get('download/notice/pdf/{id}','ProgressNoteController@downloadPDF');

//Authorize
Route::post('authorize/progressive/notices','ProgressNoteController@AuthorizeAll');
Route::post('authorize/progressive/{id}/notices','ProgressNoteController@AuthorizeProgressNoteById');

//Import
Route::get('inventory-import','ItemInventoryController@showImport');
Route::post('inventory-import','ItemInventoryController@postImport');

//Referrals
Route::get('import/referrals','ReferralController@showImport');
Route::post('import/referrals','ReferralController@postImport');
//Clients
Route::get('import/clients','ClientController@showImport');
Route::post('import/clients','ClientController@postImport');
Route::get('import/clients/errors','ClientController@showImportErrors');
Route::get('download/import/clients/errors','ClientController@downloadImportErrors');
//Just for me
//Route::get('create-client','ClientController@createClient');


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


Route::get('import/items/distributions/error','ItemsDisbursementController@showImportErrors');
Route::get('download/import/items/distributions/error','ItemsDisbursementController@downloadImportErrors');

Route::get('list-items-distributions','ItemsDisbursementController@getDistributionListJson');

//Authorize
Route::post('authorize/items/distributions','ItemsDisbursementController@AuthorizeAll');
Route::post('authorize/items/{id}/distributions','ItemsDisbursementController@AuthorizeItemsDisbursementById');




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


Route::get('generate/reports/clients','ClientReportsController@index');
Route::post('generate/reports/clients','ClientReportsController@postGenerate');

Route::get('reports/nfis','InventoryReportsController@index');
Route::post('reports/nfis','InventoryReportsController@generateReport');

Route::get('reports/assessments','AssessmentReportsController@index');
Route::post('reports/assessments','AssessmentReportsController@generateReport');

Route::get('reports/referrals','ReferralReportsController@index');
Route::post('reports/referrals','ReferralReportsController@generateReport');

Route::get('reports/case/management','CaseManagementReportsController@index');
Route::post('reports/case/management','CaseManagementReportsController@generateReport');


//Inclusion Assessments
Route::resource('assessments/inclusion','InclusionAssessmentController');
Route::get('get-inclass-clientsjson','InclusionAssessmentController@getJSonClientData');
Route::get('assessments/inclusion/client-to-assess/{id}','InclusionAssessmentController@getSelectedClientInfo');
Route::post('assessments/inclusion/store-assessment','InclusionAssessmentController@postData');
Route::get('inclusion-get-assessed-clients','InclusionAssessmentController@getJSONIncAssessmentListAllClientData');
Route::get('assessments/inclusion/view/{id}','InclusionAssessmentController@getClientData');
Route::get('assessments/inclusion/view/inclusion/client-to-assess/{id}','InclusionAssessmentController@getSelectedClientInfo');
Route::post('assessments/inclusion/{id}/update-assessment','InclusionAssessmentController@update');

//System backups imports and exports
Route::get('backup/import/advanced','BackupImportExportController@showImport');
Route::post('backup/import/advanced','BackupImportExportController@postImport');

Route::get('backup/export/advanced','BackupImportExportController@showExport');
Route::post('backup/export/advanced','BackupImportExportController@postExport');
Route::delete('/backup/export/advanced/downloads', 'BackupImportExportController@deleteFile');
Route::get('backup/export/advanced/downloads','BackupImportExportController@downloadDocs');

Route::prefix('rest/secured')->group(function () {
    //Dashboard
    Route::get('/dashboard/chart-stats','HomeController@findChartStats');
    Route::get('/dashboard/counter-stats','HomeController@findCountStats');
    Route::post('/dashboard/registered-clients/date-range', 'HomeController@loadClientRegistrationByDateRange');
    Route::post('/dashboard/nfis-distributions/year', 'HomeController@loadNFISDistributionByYear');
    Route::post('/dashboard/cash-provisions/year', 'HomeController@loadMonthlyCashProvisionByYear');
    Route::post('/dashboard/cases/year', 'HomeController@loadMonthlyAverageCaseByYear');

    //Clients
    Route::get('/clients','ClientController@findClientList');
    Route::get('/clients/search-paginated','ClientController@searchClientPaginated');
    Route::post('/clients/{id}/authorize','ClientController@authorizeClientById');

    //VulnerabilityAssessmentsearch-paginated
    Route::get('/assessments/vulnerabilities','VulnerabilityAssessmentController@findVulnerabilityAssessments');
    Route::get('/assessments/vulnerabilities/search-paginated','VulnerabilityAssessmentController@searchVulnerabilityAssessments');
    Route::post('/assessments/vulnerability/{id}/authorize', 'VulnerabilityAssessmentController@authorizeAssessmentById');

    //HomeAssessmentsearch-paginated
    Route::get('/assessments/home','HomeAssessmentController@findHomeAssessments');
    Route::get('/assessments/home/search-paginated','HomeAssessmentController@searchHomeAssessments');
    Route::post('/assessments/home/{id}/authorize', 'HomeAssessmentController@authorizeAssessmentById');

    //Referrals
    Route::get('/referrals', 'ReferralController@getReferralList');
    Route::get('/referrals/search-paginated', 'ReferralController@searchReferralPaginated');
    Route::post('/referrals/{id}/authorize', 'ReferralController@AuthorizeReferralsById');

    //Inventories
    Route::get('/inventories','ItemInventoryController@findInventories');
    Route::get('/inventories/search-paginated','ItemInventoryController@searchInventoryPaginated');

    //Item Categories
    Route::get('/inventories/categories','ItemsCategoriesController@findInventories');
    Route::get('/inventories/categories/search-paginated','ItemsCategoriesController@searchInventoryPaginated');

    //Item Distributions
    Route::get('/inventories/distributions','ItemsDisbursementController@findItemDistributions');
    Route::get('/inventories/distributions/search-paginated','ItemsDisbursementController@searchItemDistributionPaginated');
    Route::post('/inventories/distributions/{id}/authorize','ItemsDisbursementController@AuthorizeItemsDisbursementById');

    //Received Items
    Route::get('/inventories/received-items','ItemsReceivingController@getReceivedItemList');
    Route::post('/inventories/received-items/{id}/authorize','ItemsReceivingController@authorizeInventoryReceivedById');
    Route::get('/inventories/received-items/search-paginated','ItemInventoryController@searchInventoryPaginated');

    //Backups
    Route::get('/backup/import/advanced/available-docs', 'BackupImportExportController@findDocumentList');
});

Route::prefix('/settings')->group(function () {
    //Client Settings
    Route::get('/clients','Settings\ClientSettingController@index');

    //User Settings
    Route::get('/users/edit', 'Settings\UserSettingController@editSettings');
    Route::post('/users/update', 'Settings\UserSettingController@updateSettings');
    Route::get('/users','Settings\UserSettingController@index');
});




