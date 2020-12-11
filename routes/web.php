<?php

use Illuminate\Support\Facades\Route;

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




Route::namespace('User\Auth')->group(function () {
	Route::post('user-register', 'RegisterController@create')->name('user.register');
	Route::get('email-verify', 'RegisterController@varifyEmail')->name('user.verify');
	Route::post('user-login', 'LoginController@index')->name('user.login');
	Route::get('user-logout', 'LoginController@logout')->name('user.logout');
	Route::post('forget-password', 'RegisterController@forgetPassword')->name('forget.password');
	Route::get('reset-password', 'RegisterController@openResetPassword')->name('reset.password');
	Route::post('reset-password', 'RegisterController@resetPassword')->name('change.password');
	

});

Route::namespace('User')->group(function () {
	Route::get('/', 'HomeController@index')->name('/');
	Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');
	Route::post('password-update', 'ProfileController@changePassword')->name('user.updatePass');
	Route::post('edit-profile', 'ProfileController@updateProfile')->name('user.editProfile');

});	

Route::namespace('Vendor\Auth')->group(function () {
	Route::post('vendor-register', 'RegisterController@create')->name('vendor.register');
	
});	

Route::namespace('Vendor')->group(function () {
	Route::get('/vendor-dashboard', 'DashboardController@index')->name('vendor.dashboard');
	Route::get('/change-password', 'ProfileController@openChangePassword')->name('vendor.changePassword');
	Route::post('update-password', 'ProfileController@changePassword')->name('vendor.update.password');
	Route::get('/my-account', 'ProfileController@myAccount')->name('vendor.myaccount');
	Route::post('/my-account', 'ProfileController@updateProfile')->name('vendor.update.profile');

});	






//Route::get('/home', 'HomeController@index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vendor-test', 'HomeController@vendorTest')->name('vendor')->middleware('role:vendor');
