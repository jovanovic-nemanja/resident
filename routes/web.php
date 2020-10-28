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

Auth::routes();

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/home', 'Frontend\HomeController@index')->name('home');

Route::get('/admin/general', 'Admin\GeneralSettingsController@index')->name('admin.generalsetting');
Route::put('/admin/general/update/{generalsetting}', 'Admin\GeneralSettingsController@update')->name('admin.generalsetting.update');

Route::get('/admin/localization', 'Admin\LocalizationSettingsController@index')->name('admin.localizationsetting');
Route::put('/admin/localization/update/{localizationsetting}', 'Admin\LocalizationSettingsController@update')->name('admin.localizationsetting.update');


Route::get('/resident/add', 'Admin\ResidentController@index')->name('resident.add');
Route::get('/resident/bodyharm', 'Admin\ResidentController@bodyharm')->name('resident.bodyharm');
Route::resource('resident', 'Admin\ResidentController');


Route::resource('activities', 'Admin\ActivitiesController');



Route::resource('incidences', 'Admin\IncidencesController');



Route::resource('caretaker', 'Admin\CaretakerController');



Route::resource('medications', 'Admin\MedicationsController');



Route::resource('useractivities', 'Admin\UseractivitiesController');
Route::get('useractivities/indexuseractivity/{type}', 'Admin\UseractivitiesController@indexuseractivity')->name('useractivities.indexuseractivity');
Route::get('useractivities/createuseractivity/{type}/{resident}', 'Admin\UseractivitiesController@createuseractivity')->name('useractivities.createuseractivity');
Route::get('useractivities/assign/{id}', 'Admin\UseractivitiesController@assign')->name('useractivities.assign');




Route::resource('usermedications', 'Admin\UsermedicationsController');
Route::get('usermedications/indexusermedication/{id}', 'Admin\UsermedicationsController@indexusermedication')->name('usermedications.indexusermedication');
Route::get('usermedications/createusermedication/{resident}/{assign_id}/{medication_id}', 'Admin\UsermedicationsController@createusermedication')->name('usermedications.createusermedication');
Route::get('usermedications/assign/{id}', 'Admin\UsermedicationsController@assign')->name('usermedications.assign');

Route::get('usermedications/createassignmedication/{resident}', 'Admin\UsermedicationsController@createassignmedication')->name('usermedications.createassignmedication');
Route::get('usermedications/showassign/{resident}', 'Admin\UsermedicationsController@showassign')->name('usermedications.showassign');
Route::delete('usermedications/destroyassign/{resident}', 'Admin\UsermedicationsController@destroyassign')->name('usermedications.destroyassign');




Route::resource('tfgs', 'Admin\TFGController');
Route::get('tfgs/indextfg/{resident}', 'Admin\TFGController@indextfg')->name('tfgs.indextfg');
Route::get('tfgs/createtfg/{resident}', 'Admin\TFGController@createtfg')->name('tfgs.createtfg');




Route::resource('bodyharmcomments', 'Admin\BodyharmcommentsController');



Route::get('/account', 'Frontend\AccountController@index')->name('account');
Route::get('/changepass', 'Frontend\AccountController@changepass')->name('changepass');
Route::put('/account/update', 'Frontend\AccountController@update')->name('account.update');
Route::put('/account/updatePassword', 'Frontend\AccountController@updatePassword')->name('account.updatePassword');


//Ajax Request
Route::get('/getcommentsbyactivity', 'Admin\ActivitiesController@getcommentsbyactivity');
Route::get('/getCurrentTimeByAjax', 'Admin\UsermedicationsController@getCurrentTimeByAjax');
Route::get('/getbodyharmcomments', 'Admin\BodyharmcommentsController@getbodyharmcomments');