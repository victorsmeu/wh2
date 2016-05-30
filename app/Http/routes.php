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

Route::resource('/reports', 'ReportsController');

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
