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

Route::get('/signup/clinicowner', 'Auth\RegisterController@registerasclinic')->name('signup.clinicowner');

Route::get('/admin/general', 'Admin\GeneralSettingsController@index')->name('admin.generalsetting');
Route::put('/admin/general/update/{generalsetting}', 'Admin\GeneralSettingsController@update')->name('admin.generalsetting.update');
Route::get('/admin/general/redirectBack', 'Admin\GeneralSettingsController@redirectBack')->name('admin.general.redirectBack');

Route::get('/admin/localization', 'Admin\LocalizationSettingsController@index')->name('admin.localizationsetting');
Route::put('/admin/localization/update/{localizationsetting}', 'Admin\LocalizationSettingsController@update')->name('admin.localizationsetting.update');


Route::get('/resident/add', 'Admin\ResidentController@index')->name('resident.add');
Route::get('/resident/bodyharm', 'Admin\ResidentController@bodyharm')->name('resident.bodyharm');
Route::get('/resident/management', 'Admin\ResidentController@management')->name('resident.management');
Route::resource('resident', 'Admin\ResidentController');
Route::post('/resident/saveResidentPersonalinfo', 'Admin\ResidentController@saveResidentPersonalinfo')->name('resident.saveResidentPersonalinfo');
Route::post('/resident/saveResidentPOAinfo', 'Admin\ResidentController@saveResidentPOAinfo')->name('resident.saveResidentPOAinfo');
Route::post('/resident/saveResidentPhysicianinfo', 'Admin\ResidentController@saveResidentPhysicianinfo')->name('resident.saveResidentPhysicianinfo');
Route::post('/resident/saveSettingsinfo', 'Admin\ResidentController@saveSettingsinfo')->name('resident.saveSettingsinfo');

Route::get('/resident/indexprofile/{resident}/{tabid}', 'Admin\ResidentController@indexprofile')->name('resident.indexprofile');
Route::get('/resident/createprofile/{resident}/{tabid}', 'Admin\ResidentController@createprofile')->name('resident.createprofile');
Route::post('/resident/storeprofile', 'Admin\ResidentController@storeprofile')->name('resident.storeprofile');
Route::get('/resident/showprofile/{id}', 'Admin\ResidentController@showprofile')->name('resident.showprofile');
Route::put('/resident/updateprofile/{id}', 'Admin\ResidentController@updateprofile')->name('resident.updateprofile');
Route::delete('/resident/destroyprofile/{id}', 'Admin\ResidentController@destroyprofile')->name('resident.destroyprofile');






Route::resource('activities', 'Admin\ActivitiesController');



Route::resource('incidences', 'Admin\IncidencesController');



Route::resource('caretaker', 'Admin\CaretakerController');



Route::resource('medications', 'Admin\MedicationsController');



Route::resource('settings', 'Admin\SettingsController');
Route::post('/storeSettings', 'Admin\SettingsController@storeSettings')->name('settings.storeSettings');
Route::post('/clinicstatus', 'Frontend\HomeController@clinicstatus')->name('clinic.status');




Route::resource('useractivities', 'Admin\UseractivitiesController');
Route::get('useractivities/indexuseractivity/{type}', 'Admin\UseractivitiesController@indexuseractivity')->name('useractivities.indexuseractivity');
Route::get('useractivities/indexuseractivitygiven/{type}', 'Admin\UseractivitiesController@indexuseractivitygiven')->name('useractivities.indexuseractivitygiven');
Route::get('useractivities/createuseractivity/{type}/{resident}', 'Admin\UseractivitiesController@createuseractivity')->name('useractivities.createuseractivity');
Route::get('useractivities/assign/{id}', 'Admin\UseractivitiesController@assign')->name('useractivities.assign');
Route::post('useractivities/stop', 'Admin\UseractivitiesController@stop')->name('useractivities.stop');





Route::resource('vitalsign', 'Admin\VitalsignController');
Route::get('vitalsign/indexresidentvitalsign/{resident}', 'Admin\VitalsignController@indexresidentvitalsign')->name('vitalsign.indexresidentvitalsign');
Route::get('vitalsign/createvitalsign/{resident}', 'Admin\VitalsignController@createvitalsign')->name('vitalsign.createvitalsign');






Route::resource('usermedications', 'Admin\UsermedicationsController');
Route::get('usermedications/indexusermedication/{id}', 'Admin\UsermedicationsController@indexusermedication')->name('usermedications.indexusermedication');
Route::get('usermedications/indexusermedicationgiven/{id}', 'Admin\UsermedicationsController@indexusermedicationgiven')->name('usermedications.indexusermedicationgiven');
Route::get('usermedications/createusermedication/{resident}/{assign_id}/{medication_id}', 'Admin\UsermedicationsController@createusermedication')->name('usermedications.createusermedication');
Route::get('usermedications/assign/{id}', 'Admin\UsermedicationsController@assign')->name('usermedications.assign');
Route::post('usermedications/stop', 'Admin\UsermedicationsController@stop')->name('usermedications.stop');


Route::get('usermedications/createassignmedication/{resident}', 'Admin\UsermedicationsController@createassignmedication')->name('usermedications.createassignmedication');
Route::get('usermedications/showassign/{resident}', 'Admin\UsermedicationsController@showassign')->name('usermedications.showassign');
Route::delete('usermedications/destroyassign/{resident}', 'Admin\UsermedicationsController@destroyassign')->name('usermedications.destroyassign');




Route::resource('tfgs', 'Admin\TFGController');
Route::get('tfgs/indextfg/{resident}', 'Admin\TFGController@indextfg')->name('tfgs.indextfg');
Route::get('tfgs/createtfg/{resident}', 'Admin\TFGController@createtfg')->name('tfgs.createtfg');




Route::resource('bodyharmcomments', 'Admin\BodyharmcommentsController');

Route::resource('bodyharm', 'Admin\BodyharmController');
Route::get('bodyharm/indexbodyharm/{id}', 'Admin\BodyharmController@indexbodyharm')->name('bodyharm.indexbodyharm');
Route::get('bodyharm/createbodyharm/{resident}', 'Admin\BodyharmController@createbodyharm')->name('bodyharm.createbodyharm');




Route::resource('reminderconfigs', 'Admin\ReminderConfigsController');
Route::get('reminderconfigs/active/{id}', 'Admin\ReminderConfigsController@active')->name('reminderconfigs.active');




Route::resource('notifications', 'Admin\NotificationsController');
Route::get('notifications/confirmIsread/{id}', 'Admin\NotificationsController@confirmIsread')->name('notifications.confirmIsread');





Route::resource('routes', 'Admin\RoutesController');
Route::resource('adminlogs', 'Admin\AdminlogsController');
Route::resource('switchreminder', 'Admin\SwitchreminderController');
Route::resource('reports', 'Admin\ReportsController');





Route::get('/account', 'Frontend\AccountController@index')->name('account');
Route::get('/changepass', 'Frontend\AccountController@changepass')->name('changepass');
Route::put('/account/update', 'Frontend\AccountController@update')->name('account.update');
Route::put('/account/updatePassword', 'Frontend\AccountController@updatePassword')->name('account.updatePassword');


//Ajax Request
Route::get('/getcommentsbyactivity', 'Admin\ActivitiesController@getcommentsbyactivity');
Route::get('/getCurrentTimeByAjax', 'Admin\UsermedicationsController@getCurrentTimeByAjax');
Route::get('/getbodyharmcomments', 'Admin\BodyharmcommentsController@getbodyharmcomments');
Route::get('/getNotificationdata', 'Admin\NotificationsController@getNotificationdata');
Route::get('/updateIsread', 'Admin\NotificationsController@updateIsread');
Route::post('/storeStorage', 'Admin\BodyharmController@storeStorage')->name('bodyharm.storeStorage');
Route::post('/validationUsername', 'Admin\CaretakerController@validationUsername')->name('caretaker.validationUsername');


Route::get('/indexbyfilter', 'Admin\ReportsController@indexbyfilter')->name('indexbyfilter');
Route::get('/indexresident/{resident}', 'Admin\ReportsController@indexresident')->name('reports.indexresident');
Route::get('/indexresidentbyfilter', 'Admin\ReportsController@indexresidentbyfilter')->name('indexresidentbyfilter');



Route::resource('relations', 'Admin\RelationsController');
Route::resource('moods', 'Admin\MoodsController');

Route::resource('familyvisit', 'Admin\FamilyvisitController');
Route::get('familyvisit/indexfamilyvisit/{resident}', 'Admin\FamilyvisitController@indexfamilyvisit')->name('familyvisit.indexfamilyvisit');
Route::get('familyvisit/createfamilyvisit/{resident}', 'Admin\FamilyvisitController@createfamilyvisit')->name('familyvisit.createfamilyvisit');


Route::resource('moodchange', 'Admin\MoodchangeController');
Route::get('moodchange/indexmoodchange/{resident}', 'Admin\MoodchangeController@indexmoodchange')->name('moodchange.indexmoodchange');
Route::get('moodchange/createmoodchange/{resident}', 'Admin\MoodchangeController@createmoodchange')->name('moodchange.createmoodchange');



Route::resource('representativetypes', 'Admin\RepresentativeTypeController');
Route::resource('healthcarecentertypes', 'Admin\HealthCareCenterTypeController');

Route::resource('representative', 'Admin\RepresentativeController');
Route::get('representative/indexrepresentative/{resident}', 'Admin\RepresentativeController@indexrepresentative')->name('representative.indexrepresentative');
Route::get('representative/createrepresentative/{resident}', 'Admin\RepresentativeController@createrepresentative')->name('representative.createrepresentative');


Route::resource('healthcarecenter', 'Admin\HealtheCareCenterController');
Route::get('healthcarecenter/indexhealthcarecenter/{resident}', 'Admin\HealtheCareCenterController@indexhealthcarecenter')->name('healthcarecenter.indexhealthcarecenter');
Route::get('healthcarecenter/createhealthcarecenter/{resident}', 'Admin\HealtheCareCenterController@createhealthcarecenter')->name('healthcarecenter.createhealthcarecenter');



Route::get('/changepass', 'Frontend\HomeController@changepass')->name('changepass');
Route::put('/account/updatePassword', 'Frontend\HomeController@updatePassword')->name('account.updatePassword');



Route::resource('templates', 'Admin\TemplatesController');
Route::get('templates/viewTemplate/{templateID}', 'Admin\TemplatesController@viewTemplate')->name('templates.viewTemplate');

Route::get('templates/createsetting/{templateID}/{type}', 'Admin\TemplatesController@createsetting')->name('templates.createsetting');
Route::get('templates/activeReminderconfig/{id}', 'Admin\TemplatesController@activeReminderconfig')->name('templates.activeReminderconfig');
Route::get('templates/showsetting/{templateID}/{id}/{type}', 'Admin\TemplatesController@showsetting')->name('templates.showsetting');
Route::post('templates/storeSetting', 'Admin\TemplatesController@storeSetting')->name('templates.storeSetting');
Route::post('templates/storeSettings', 'Admin\TemplatesController@storeSettings')->name('templates.storeSettings');
Route::put('templates/updatesetting/{activity}', 'Admin\TemplatesController@updatesetting')->name('templates.updatesetting');
Route::delete('templates/destroysetting/{id}/{settingtype}', 'Admin\TemplatesController@destroysetting')->name('templates.destroysetting');



Route::resource('clone', 'Admin\CloneController');
Route::get('clone/showsetting/{templateID}/{id}', 'Admin\CloneController@showsetting')->name('clone.showsetting');
Route::post('clone/cloneSettings', 'Admin\CloneController@cloneSettings')->name('clone.cloneSettings');