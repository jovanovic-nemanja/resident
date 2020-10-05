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


Route::get('auth/github', 'Auth\LoginController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/redirect', 'Auth\LoginController@redirectToProvidergoogle');
Route::get('/callback', 'Auth\LoginController@handleProviderCallbackgoogle');



Route::get('/sellerregister', 'Auth\RegisterController@sellerregister')->name('sellerregister');
Route::get('/emailverify', 'Auth\RegisterController@emailverify')->name('emailverify');
Route::get('/emailverifyseller', 'Auth\RegisterController@emailverifyseller')->name('emailverifyseller');
Route::post('/emails/sendverifycode', 'Frontend\EmailsController@sendverifycode')->name('emails.sendverifycode');
Route::post('/emails/validatecode', 'Frontend\EmailsController@validatecode')->name('emails.validatecode');
Route::get('/emails/directconfirmpage/{email}/{role}/{codes}', 'Frontend\EmailsController@directconfirmpage')->name('emails.directconfirmpage');
Route::get('/emailverifyforresend/{email}/{role}', 'Auth\RegisterController@emailverifyforresend')->name('emailverifyforresend');



Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/account', 'Frontend\AccountController@index')->name('account');
Route::get('/changepass', 'Frontend\AccountController@changepass')->name('changepass');
Route::get('/myreviews', 'Frontend\AccountController@myreviews')->name('myreviews');

Route::put('/account/update', 'Frontend\AccountController@update')->name('account.update');


Route::resource('request', 'Frontend\RequestController');
Route::post('/request/store', 'Frontend\RequestController@store')->name('request.store');
Route::post('/request/update', 'Frontend\RequestController@update')->name('request.update');
Route::get('/request/destroy/{id}', 'Frontend\RequestController@destroy')->name('request.destroy');
Route::get('/request/create/{product_id}', 'Frontend\RequestController@create')->name('request.sendrequest');
Route::get('/request/change/{request_id}', 'Frontend\RequestController@change')->name('request.change');
Route::get('/request/view/{request_id}', 'Frontend\RequestController@view')->name('request.view');



Route::resource('quote', 'Frontend\QuotesController');
Route::post('/quote/store', 'Frontend\QuotesController@store')->name('quote.store');
Route::post('/quote/update', 'Frontend\QuotesController@update')->name('quote.update');
Route::get('/quote/destroy/{id}', 'Frontend\QuotesController@destroy')->name('quote.destroy');
Route::get('/quote/reply/{id}', 'Frontend\QuotesController@reply')->name('quote.reply');
Route::get('/quote/change/{id}', 'Frontend\QuotesController@change')->name('quote.change');
Route::get('/quote/detailview/{id}', 'Frontend\QuotesController@detailview')->name('quote.detailview');
Route::get('/quote/accepted/{id}', 'Frontend\QuotesController@accepted')->name('quote.accepted');
Route::get('/quote/reject/{id}', 'Frontend\QuotesController@reject')->name('quote.reject');




Route::resource('purchaseorders', 'Frontend\PurchaseordersController');
Route::get('/purchaseorders/create', 'Frontend\PurchaseordersController@create')->name('purchaseorders.create');
Route::get('/purchaseorders/paymentchange/{id}', 'Frontend\PurchaseordersController@paymentchange')->name('purchaseorders.paymentchange');
Route::post('/purchaseorders/update', 'Frontend\PurchaseordersController@update')->name('purchaseorders.update');
Route::get('/purchaseorders/comments/{id}', 'Frontend\PurchaseordersController@comments')->name('purchaseorders.comments');
Route::get('/purchaseorders/getcomments/{id}', 'Frontend\PurchaseordersController@getcomments')->name('purchaseorders.getcomments');

Route::get('/purchaseorders/addreview/{id}', 'Frontend\PurchaseordersController@addreview')->name('purchaseorders.addreview');
Route::get('/purchaseorders/viewreview/{id}', 'Frontend\PurchaseordersController@viewreview')->name('purchaseorders.viewreview');
Route::get('/purchaseorders/userreview/{id}', 'Frontend\ReviewsController@show')->name('purchaseorders.userreview');



Route::resource('howtoworks', 'Frontend\HowtoworksController');
Route::get('/howtoworks', 'Frontend\HowtoworksController@index')->name('howtoworks.index');



Route::resource('userprofile', 'Frontend\UserprofileController');
Route::get('/userprofile/view/{id}', 'Frontend\UserprofileController@view')->name('userprofile.view');



Route::resource('achieved', 'Frontend\AchievedquotesController');


Route::resource('howtosells', 'Frontend\HowtosellsController');
Route::get('/howtosells', 'Frontend\HowtosellsController@index')->name('howtosells.index');


Route::resource('howtobuys', 'Frontend\HowtobuysController');
Route::get('/howtobuys', 'Frontend\HowtobuysController@index')->name('howtobuys.index');


Route::resource('comments', 'Frontend\CommentsController');
Route::post('/comments/store', 'Frontend\CommentsController@store')->name('comments.store');



Route::resource('emails', 'Frontend\EmailsController');
Route::post('/emails/store', 'Frontend\EmailsController@store')->name('emails.store');



Route::resource('reviews', 'Frontend\ReviewsController');
Route::post('/reviews/save', 'Frontend\ReviewsController@save')->name('reviews.save');




Route::put('/account/updatePassword', 'Frontend\AccountController@updatePassword')->name('account.updatePassword');

Route::get('/cart/index', 'Frontend\CartController@index')->name('cart.index');
Route::get('/cart/create/{product}', 'Frontend\CartController@create')->name('cart.create');
Route::get('/cart/destroy/{id}', 'Frontend\CartController@destroy')->name('cart.destroy');
Route::put('/cart/update/{id}', 'Frontend\CartController@update')->name('cart.update');
Route::get('/cart/empty', 'Frontend\CartController@empty')->name('cart.empty');
Route::get('/cart/checkout', 'Frontend\CartController@checkout')->name('cart.checkout');

Route::get('order/sales', 'Frontend\OrderController@sales')->name('order.sales');
Route::resource('order', 'Frontend\OrderController');

Route::resource('product', 'Frontend\ProductController');
Route::get('/myproduct', 'Frontend\ProductController@myproduct')->name('product.my');
Route::get('/create', 'Frontend\ProductController@create')->name('product.create');

Route::get('products/deleteproductsbychoosing', 'Frontend\ProductController@deleteproductsbychoosing')->name('products.deleteproductsbychoosing');

Route::resource('shop', 'Frontend\ShopController');
Route::resource('address', 'Frontend\AddressController');
Route::put('address/setmain/{address}', 'Frontend\AddressController@set_main_address')->name('address.set_main_address');

Route::delete('/image/destroy/{image}', 'Frontend\ImageController@destroy')->name('image.destroy');

Route::get('/admin', 'Admin\GeneralSettingsController@index')->name('dashboard.index');
Route::get('/manager', 'Admin\ManagesellersController@index')->name('managesellers.index');
Route::get('/admin/general', 'Admin\GeneralSettingsController@index')->name('admin.generalsetting');
Route::put('/admin/general/update/{generalsetting}', 'Admin\GeneralSettingsController@update')->name('admin.generalsetting.update');

Route::get('/admin/localization', 'Admin\LocalizationSettingsController@index')->name('admin.localizationsetting');
Route::put('/admin/localization/update/{localizationsetting}', 'Admin\LocalizationSettingsController@update')->name('admin.localizationsetting.update');


Route::resource('admin/managemanagers', 'Admin\ManagemanagersController');
Route::resource('admin/managesellers', 'Admin\ManagesellersController');
Route::get('/admin/managesellers', 'Admin\ManagesellersController@index')->name('managesellers.index');

Route::resource('admin/managebuyers', 'Admin\ManagebuyersController');
Route::get('/admin/managebuyers', 'Admin\ManagebuyersController@index')->name('managebuyers.index');


Route::resource('admin/category', 'Admin\CategoryController');
Route::get('/admin/category', 'Admin\CategoryController@index')->name('category.index');

Route::resource('admin/unit', 'Admin\UnitController');
Route::get('/admin/unit', 'Admin\UnitController@index')->name('unit.index');

Route::resource('admin/products', 'Admin\ProductsController');
Route::get('/admin/products', 'Admin\ProductsController@index')->name('products.index');

Route::resource('admin/requests', 'Admin\RequestsController');
Route::get('/admin/requests', 'Admin\RequestsController@index')->name('requests.index');
Route::get('/admin/requests/assign/{id}', 'Admin\RequestsController@assign')->name('requests.assign');
Route::get('/admin/requests/view/{id}', 'Admin\RequestsController@view')->name('requests.view');


Route::resource('admin/quotes', 'Admin\QuotesController');
Route::get('/admin/quotes', 'Admin\QuotesController@index')->name('quotes.index');

Route::resource('admin/emails', 'Admin\EmailsController');
Route::get('/admin/emails', 'Admin\EmailsController@index')->name('emails.index');

Route::resource('admin/logs', 'Admin\AdminlogsController');
Route::get('/admin/logs', 'Admin\AdminlogsController@index')->name('logs.index');

Route::get('/home', 'Frontend\HomeController@index')->name('home');

// Axios AJAX call
Route::get('/getproducts-byfilter/{word}/{by}/{min}/{max}/{category}', 'Frontend\ProductController@getproductsbyfilter');

Route::get('/api-getcategory', 'Frontend\ProductController@getcategory');
Route::get('/api-getcurrency', 'Frontend\ProductController@getlocalizationsettings');
Route::get('/api-getrole', 'Frontend\ProductController@getrole');


Route::get('/address-api', 'API\AddressApiController@index');
Route::get('/address-api/search/{searchQuery}', 'API\AddressApiController@search');
Route::get('/address-api/byid/{address}', 'API\AddressApiController@getAddressById');
Route::get('/address-api/mainaddress', 'API\AddressApiController@getMainAddress');


Route::get('/buyerdashboard', 'Frontend\BuyerdashboardController@index')->name('buyerdashboard.index');
Route::get('/sellerdashboard', 'Frontend\SellerdashboardController@index')->name('sellerdashboard.index');
Auth::routes();
