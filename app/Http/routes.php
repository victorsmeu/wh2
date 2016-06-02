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

Route::get('/home', 'HomeController@index');

Route::get('/secure-download/{id}/{file_id}', 'DownloadController@secureDownload');

Route::get('/dashboard', 'DashboardController@index');

Route::resource('/patients', 'PatientsController');

Route::resource('/users', 'UserController');

Route::resource('/studies', 'StudiesController');
Route::post('/studies/invite', ['uses' => 'StudiesController@invite', 'as' => 'studies.invite']);
Route::get('/studies/view/{study_id}/{viewer_id}', ['uses' => 'StudiesController@view', 'as' => 'studies.view']);
Route::get('/studies/accept/{study_id}', ['uses' => 'StudiesController@accept', 'as' => 'studies.accept']);
Route::get('/studies/decline/{study_id}', ['uses' => 'StudiesController@decline', 'as' => 'studies.decline']);

Route::resource('/reports', 'ReportsController');
Route::get('/reports/create/{id_study}', ['uses' => 'ReportsController@create', 'as' => 'reports.create']);

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
     'middleware' => ['auth'],
     'uses' => 'PatientDataController@index',
     'as' => 'patients.ehr'
]); 
Route::get('/patients/ehr/{id}/view', [
     'middleware' => ['auth'],
     'uses' => 'PatientDataController@view',
     'as' => 'patients.ehr.view'
]); 
Route::post('/patients/ehr/{id}', [
     'middleware' => ['auth'],
     'uses' => 'PatientDataController@update',
     'as' => 'patient-data.update'
]); 
Route::post('/patients/ehr/upload/{id}', [
     'middleware' => ['auth'],
     'uses' => 'PatientDataController@upload',
     'as' => 'patient-data.upload'
]); 
/* -- */

Route::get('/medics', [
    'middleware' => ['auth'],
    'uses' => 'MedicController@index'
]);
Route::get('/medics/edit-cv', [
    'middleware' => ['auth'],
    'uses' => 'MedicController@editCV'
]);
Route::get('/medics/view-cv', [
    'middleware' => ['auth'],
    'uses' => 'MedicController@viewCV'
]);

