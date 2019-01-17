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
Route::get('/', 'DashboardController@index');

Route::get('/process', 'ProcessResourceController@index');
Route::get('/process/create', 'ProcessResourceController@create');
Route::post('/process/create', 'ProcessResourceController@store');

Route::get('/process/{id}/tasks', 'TaskResourceController@show');

Route::get('/tasks', 'TaskResourceController@index');
Route::get('/tasks/create', 'TaskResourceController@create');

Route::get('/staff', 'StaffResourceController@index');
Route::get('/staff/create', 'StaffResourceController@create');
Route::post('/staff/create', 'StaffResourceController@store');
Route::get('/staff/{id}', 'StaffResourceController@show');

Route::get('/client', 'ClientResourceController@index');
Route::get('/client/create', 'ClientResourceController@create');
Route::post('/client/create', 'ClientResourceController@store');

Route::get('/company/item/create', 'CompanyItemResourceController@create');
Route::post('/company/item/create', 'CompanyItemResourceController@store');
Route::post('/company/items/add/tags', 'CompanyItemResourceController@groupAddTags');
Route::post('/company/items/change-password', 'CompanyItemResourceController@changePassword');

Route::get('/search/process','SearchController@processes');
Route::get('/search/client','SearchController@clients');
Route::get('/search/staff','SearchController@staff');
Route::get('/search/company/items','SearchController@companyItems');

Route::post('/tags/create', 'TagController@create');

// NEW SITE
Route::get('/companies', 'CompanyController@showUsersCompanies');

Route::get('/company', 'CompanyController@show');
Route::get('/company/locations', 'CompanyController@locations');
Route::get('/company/files', 'CompanyController@files');
Route::get('/company/staff', 'CompanyController@staff');
Route::get('/company/contacts', 'CompanyController@contacts');

Route::get('/company/staff/{id}', 'StaffResourceController@show');
Route::get('/company/staff/{id}/files', 'StaffResourceController@files');
Route::post('/company/staff/{id}/update', 'StaffResourceController@update');

Route::get('/company/contact/{id}', 'ClientResourceController@show');
Route::get('/company/contact/{id}/files', 'ClientResourceController@files');

Route::get('/client/{id}/update', 'ClientResourceController@update');

// Route::get('/staff/{id}/update', 'StaffResourceController@update');
