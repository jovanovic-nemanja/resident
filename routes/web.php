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
Route::get('/resident/add', 'Admin\ResidentController@index')->name('resident.add');
Route::resource('resident', 'Admin\ResidentController');


Route::get('/account', 'Frontend\AccountController@index')->name('account');
Route::get('/changepass', 'Frontend\AccountController@changepass')->name('changepass');
Route::get('/myreviews', 'Frontend\AccountController@myreviews')->name('myreviews');

Route::put('/account/update', 'Frontend\AccountController@update')->name('account.update');
Route::put('/account/updatePassword', 'Frontend\AccountController@updatePassword')->name('account.updatePassword');



Route::get('/admin/general', 'Admin\GeneralSettingsController@index')->name('admin.generalsetting');
Route::put('/admin/general/update/{generalsetting}', 'Admin\GeneralSettingsController@update')->name('admin.generalsetting.update');

Route::get('/admin/localization', 'Admin\LocalizationSettingsController@index')->name('admin.localizationsetting');
Route::put('/admin/localization/update/{localizationsetting}', 'Admin\LocalizationSettingsController@update')->name('admin.localizationsetting.update');



