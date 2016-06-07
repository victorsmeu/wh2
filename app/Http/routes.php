<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/set-lang/{locale}', function ($locale) {
    App::setLocale($locale);
    setcookie('locale', $locale, time() + 60 * 60 * 24 * 30, '/');
    return back();
});

Route::get('/secure-download/{id}/{file_id}', 'DownloadController@secureDownload');
Route::get('/get-medic-file/{id}/{file_id}', 'DownloadController@medicInfoDownload');
Route::get('/get-medic-image/{id}/{file_id}', 'DownloadController@medicImageView');

Route::get('/dashboard', 'DashboardController@index');

Route::resource('/patients', 'PatientsController');

Route::resource('/users', 'UserController');

Route::resource('/studies', 'StudiesController');
Route::post('/studies/invite', ['uses' => 'StudiesController@invite', 'as' => 'studies.invite']);
Route::get('/studies/view/{study_id}/{viewer_id}', ['uses' => 'StudiesController@view', 'as' => 'studies.view']);
Route::get('/studies/accept/{study_id}', ['uses' => 'StudiesController@accept', 'as' => 'studies.accept']);
Route::get('/studies/decline/{study_id}', ['uses' => 'StudiesController@decline', 'as' => 'studies.decline']);

/*Reports */
Route::get('/reports', [
    'middleware' => ['auth', 'accessReports'],
    'uses' => 'ReportsController@index', 'as' => 'reports.index'
]);
Route::get('/reports/{id}', [
    'middleware' => ['auth', 'accessReports'],
    'uses' => 'ReportsController@show', 'as' => 'reports.show'
]);
Route::get('/reports/create/{id_study}', [
    'middleware' => ['auth', 'roles', 'accessReports'],
    'uses' => 'ReportsController@create', 'as' => 'reports.create',
    'roles' => ['root', 'admin', 'medic']
]);
Route::get('/reports/{id}/edit', [
    'middleware' => ['auth', 'roles', 'accessMyReports'],
    'uses' => 'ReportsController@edit', 'as' => 'reports.edit',
    'roles' => ['root', 'admin', 'medic']
]);
Route::get('/reports/store', [
    'middleware' => ['auth', 'roles', 'accessReports'],
    'uses' => 'ReportsController@edit', 'as' => 'reports.store',
    'roles' => ['root', 'admin', 'medic']
]);
Route::post('/reports/update/{id_report}', [
    'middleware' => ['auth', 'roles', 'accessMyReports'],
    'uses' => 'ReportsController@update', 'as' => 'reports.update',
    'roles' => ['root', 'admin', 'medic']
]);
/* --- */

/*Admin settings */
Route::get('/admin/settings', [
     'middleware' => ['auth', 'roles'],
     'uses' => 'SettingsController@index',
     'roles' => ['root', 'admin']
]);
Route::get('/admin/settings/edit-viewer/{id}',  [
     'middleware' => ['auth', 'roles'],
     'uses' => 'SettingsController@editViewer',
     'roles' => ['root', 'admin']
]);
Route::put('/admin/settings/update-viewer/{viewers}', [
     'middleware' => ['auth', 'roles'],
     'uses' => 'SettingsController@updateViewer',
     'roles' => ['root', 'admin'],
     'as' => 'admin.settings.update-viewer'
]);
/* -- */

/*Patient Data */
Route::get('/patients/ehr/{id}', [
     'middleware' => ['auth', 'accessMyPatients'],
     'uses' => 'PatientDataController@index',
     'as' => 'patients.ehr'
]); 
Route::get('/patients/ehr/{id}/view', [
     'middleware' => ['auth', 'accessPatients'],
     'uses' => 'PatientDataController@view',
     'as' => 'patients.ehr.view'
]); 
Route::post('/patients/ehr/{id}', [
     'middleware' => ['auth', 'accessMyPatients'],
     'uses' => 'PatientDataController@update',
     'as' => 'patient-data.update'
]); 
Route::post('/patients/ehr/upload/{id}', [
     'middleware' => ['auth', 'accessMyPatients'],
     'uses' => 'PatientDataController@upload',
     'as' => 'patient-data.upload'
]); 
/* -- */

/*Medic Data */
Route::get('/medics', [
    'middleware' => ['auth'],
    'uses' => 'MedicController@index'
]);
Route::get('/medics/edit-cv', [
    'middleware' => ['auth', 'roles'],
    'uses' => 'MedicController@editCV',
    'roles' => ['root', 'admin', 'medic']
]);
Route::post('/medics/update/{user_id}', [
    'middleware' => ['auth', 'roles'],
    'uses' => 'MedicController@update',
    'as' => 'medics.update',
    'roles' => ['root', 'admin', 'medic']
]);
Route::get('/medic/view-cv/{user_id}', [
    'middleware' => ['auth'],
    'uses' => 'MedicController@viewCV',
    'as' => 'medic.view-cv'
]);
/* -- */
