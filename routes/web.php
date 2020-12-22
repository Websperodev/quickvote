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
	Route::get('/', 'UserController@index')->name('/');
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

Route::namespace('Admin')->group(function () {
	Route::get('admin', 'Auth\LoginController@index')->name('admin');
	Route::post('admin', 'Auth\LoginController@login')->name('admin.login');
	Route::get('admin-dashboard', 'DashboardController@index')->name('admin.dashboard');
	Route::get('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');
	Route::get('profile', 'ProfileController@myAccount')->name('admin.myaccount');
	Route::post('profile', 'ProfileController@updateProfile')->name('admin.update.profile');
	Route::get('password-change', 'ProfileController@openChangePassword')->name('admin.changePassword');
	Route::post('password-change', 'ProfileController@changePassword')->name('admin.update.password');
	Route::get('users', 'UserController@index')->name('admin.users');
	Route::any('add-user', 'UserController@addUser')->name('admin.add.user');
	Route::post('get-users', 'UserController@allUsers')->name('admin.getUsers');
	Route::any('edit-user', 'UserController@editUser')->name('admin.edit-user');
	Route::post('delete-user', 'UserController@deleteUser')->name('admin.users.delete');

	Route::get('categories', 'CategoriesController@index')->name('admin.categories');
	Route::any('add-category', 'CategoriesController@addCategory')->name('admin.add.category');
	Route::post('get-categories', 'CategoriesController@allCategories')->name('admin.getCategories');
	Route::any('edit-categories', 'CategoriesController@editCategory')->name('admin.edit-category');
	Route::post('delete-category', 'CategoriesController@deleteCategory')->name('admin.category.delete');

	Route::get('events', 'EventsController@index')->name('admin.events');
	Route::any('add-event', 'EventsController@addEvent')->name('admin.add.event');
	Route::post('get-events', 'EventsController@allEvents')->name('admin.getEvents');
	Route::any('edit-event', 'EventsController@editEvent')->name('admin.edit.event');
	Route::post('delete-event', 'EventsController@deleteEvent')->name('admin.event.delete');
    
	Route::get('/getCountries','DashboardController@getCountries');
	Route::get('/getStates/{id}','DashboardController@getStates')->name('states');
	Route::get('/getCities/{id}','DashboardController@getCities')->name('cities');


});	

// Route::get('/redirect', 'SocialAuthFacebookController@redirect');
// Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::get('auth/google', 'SocialController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialController@handleGoogleCallback');
Route::get('/auth/twitter/callback', 'SocialController@twitterCallback');

Route::get('privacy-policy', 'HomeController@openPage')->name('privacy-policy');


//Route::get('/home', 'HomeController@index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/vendor-test', 'HomeController@vendorTest')->name('vendor')->middleware('role:vendor');
