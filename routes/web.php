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

    Route::post('user.contact', 'RegisterController@sendContact')->name('user.contact');
});

Route::namespace('User')->group(function () {
    Route::get('/', 'UserController@index')->name('/');
    Route::get('about-us', 'UserController@getAbout')->name('about-us');
    Route::get('pricing', 'UserController@getPricing')->name('pricing');
    Route::get('contact', 'UserController@getContact')->name('contact');
    Route::get('faq', 'UserController@getFaq')->name('faq');
    Route::get('our-services', 'UserController@openServices')->name('our-services');
    Route::get('our-team', 'UserController@openTeam')->name('our-team');
    Route::get('search-event/{id}', 'UserController@openSearch')->name('search-event');
    Route::post('search-event', 'UserController@openSearch')->name('search-event-post');
    Route::get('event-detail/{id}', 'EventController@view')->name('event.detail');
    Route::get('/dashboard', 'DashboardController@index')->name('user.dashboard');
    Route::post('password-update', 'ProfileController@changePassword')->name('user.updatePass');
    Route::post('edit-profile', 'ProfileController@updateProfile')->name('user.editProfile');

    //**  //** Votes Management And Contestants**//
    Route::any('votes/{id}', 'VotesController@index')->name('votes.index');
    Route::any('noncatvotes', 'VotesController@nonCateVotes')->name('votes.noncatvote');

    Route::get('contestants/{id}', 'ContestantsController@index')->name('contestants.index');
    Route::get('vote/contestants/{id}/{any}', 'ContestantsController@buyVotesByUser')->name('contestants.buyvotes');
    Route::post('vote/contestants', 'ContestantsController@saveBuyVotesByUser')->name('pay');
   

    //**  //** Categories**//
    Route::get('categories-list', 'CategoriesController@index')->name('user.categories.index');
    Route::post('categories-list', 'CategoriesController@index')->name('user.categories.index');
    //**  //** Sub-Categories**//
    Route::get('vote/categories-list', 'SubCategoriesController@index')->name('user.subcategories.index');
    Route::post('vote/categories-list', 'SubCategoriesController@index')->name('user.subcategories.index');
    
    //** Buy event Tickets**//
     Route::post('event-tickets-buy', 'EventController@buyEventTickets')->name('tickets.buy');
//     Route::get('/payment/callback', 'ContestantsController@handleGatewayCallback');
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
    Route::resource('vendor-categories', 'CategoriesController');
    Route::post('vendor/all-categories', 'CategoriesController@allcategories')->name('vendor.all.categories');
    Route::resource('event', 'EventsController');
    Route::get('/getSubcategories/{id}', 'DashboardController@getSubcategories')->name('subcategories');
    Route::post('getAllEvents', 'EventsController@allEvents')->name('event.getEvents');

    Route::get('vendor/getCountries', 'DashboardController@getCountries');
    Route::get('vendor/getStates/{id}', 'DashboardController@getStates')->name('vendor.states');
    Route::get('vendor/getCities/{id}', 'DashboardController@getCities')->name('vendor.cities');

    Route::get('vendor/contestant', 'ContestantController@index')->name('vendor.contestant.index');
    Route::get('vendor/contestant-create', 'ContestantController@create')->name('vendor.contestant.create');
    Route::post('vendor/contestant-store', 'ContestantController@store')->name('vendor.contestant.store');
    Route::post('vendor/get-contestant', 'ContestantController@getContestant')->name('vendor.getContestant');
    Route::post('vendor/contestant-update/{id}', 'ContestantController@update')->name('vendor.contestant.update');
    Route::delete('vendor/contestant-delete/{id}', 'ContestantController@destroy')->name('vendor.contestant.destroy');
    //* voting constant *//
    Route::get('vendor/start-voting', 'VotingContestsController@index')->name('vendor.voting.index');
    Route::any('vendor/add-voting', 'VotingContestsController@addVotingContest')->name('vendor.add.voting');
    Route::post('vendor/get-voting', 'VotingContestsController@allvotingContests')->name('vendor.voting');
    Route::any('vendor/edit-voting', 'VotingContestsController@editVotingContest')->name('vendor.edit.voting');
    Route::post('vendor/delete-voting', 'VotingContestsController@deleteVotingContest')->name('vendor.delete.voting');
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
    Route::get('vendors', 'UserController@vendorList')->name('admin.vendors');

    Route::get('vendors-permissions/{id}', 'VendorPermissionsController@index')->name('admin.vendor.permissions');
    Route::post('vendors-permissions', 'VendorPermissionsController@addvendorPermissions')->name('admin.vendor.addpermissions');
    Route::post('get-vendors', 'UserController@allVendors')->name('admin.getVendor');
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

    Route::get('/getCountries', 'DashboardController@getCountries');
    Route::get('/getStates/{id}', 'DashboardController@getStates')->name('states');
    Route::get('/getCities/{id}', 'DashboardController@getCities')->name('cities');

    Route::get('/page/{name}', 'PageController@getPage')->name('admin.page');
    Route::post('/add-home', 'PageController@addHomePage')->name('admin.pages.home');
    Route::post('/add-about', 'PageController@addAboutPage')->name('admin.pages.about');
    Route::post('/add-contact', 'PageController@addContactPage')->name('admin.pages.contact');
    Route::post('/pricing', 'PageController@addPricingPage')->name('admin.pages.pricing');

    Route::resource('contestant', 'ContestantController');
    Route::post('get-contestant', 'ContestantController@getContestant')->name('admin.getContestant');
    Route::post('contestant-update/{id}', 'ContestantController@update')->name('contestant.update');

    Route::resource('testimonials', 'TestimonialController');
    Route::post('get-testimonials', 'TestimonialController@getTestimonial')->name('admin.getTestimonial');

    Route::resource('faqs', 'FaqController');
    Route::post('get-faqs', 'FaqController@getFaqs')->name('admin.getFaqs');

    Route::resource('team', 'TeamMemberController');
    Route::post('get-team', 'TeamMemberController@getTeam')->name('admin.getTeam');
    Route::get('/team-data', 'TeamMemberController@getPageData')->name('team.addData');
    Route::post('/save-data', 'TeamMemberController@addPageData')->name('team.saveData');
    Route::get('our-investors', 'TeamMemberController@openInvestors')->name('our.investors');
    Route::post('/team-data', 'TeamMemberController@addInvestorData')->name('investor.saveData');

    Route::get('/slider/{name}', 'PageController@getSlider')->name('admin.slider');
    Route::any('/add-slider', 'PageController@addHomeSlider')->name('admin.add.homeSlider');
    Route::post('get-home-slider', 'PageController@allHomeSlider')->name('admin.getHomeSlider');
    Route::any('/edit-slider', 'PageController@editHomeSlider')->name('admin.edit.homeSlider');
    Route::post('delete-slider', 'PageController@deleteHomeSlider')->name('admin.homeSlider.delete');
    Route::any('/add-trusted-slider', 'PageController@addTrustedSlider')->name('admin.add.trustedBrands');
    Route::post('get-brands-slider', 'PageController@allTrustedBrandsSlider')->name('admin.getTrustedBrandsSlider');
    Route::any('/edit-trusted-slider', 'PageController@editTrustedBrandsSlider')->name('admin.edit.trustedBrandsSlider');
    Route::get('/banners/{name}', 'PageController@getBanners')->name('admin.banners');
    Route::post('add-banner', 'PageController@addBanner')->name('admin.banner');
    Route::resource('services', 'ServicesController');

    Route::get('/deleteTicket/{id}', 'TicketController@deleteTicket')->name('deleteTicket');

    //* voting constant *//
    Route::get('start-voting', 'VotingContestsController@index')->name('admin.voting.index');
    Route::any('add-voting', 'VotingContestsController@addVotingContest')->name('admin.add.voting');
    Route::post('get-voting', 'VotingContestsController@allvotingContests')->name('admin.voting');
    Route::any('edit-voting', 'VotingContestsController@editVotingContest')->name('admin.edit.voting');
    Route::post('delete-voting', 'VotingContestsController@deleteVotingContest')->name('admin.delete.voting');

    //** Countries **//
    Route::get('countries', 'CountriesController@index')->name('admin.countries.index');
    Route::any('add-country', 'CountriesController@addCountry')->name('admin.add.country');
    Route::post('get-country', 'CountriesController@allCountries')->name('admin.getcountries');
    Route::any('edit-country', 'CountriesController@editCountry')->name('admin.edit.country');
    Route::post('delete-country', 'CountriesController@deleteCountry')->name('admin.country.delete');
    //** Countries  States**//
    Route::get('states', 'StateController@index')->name('admin.states.index');
    Route::any('add-state', 'StateController@addState')->name('admin.add.state');
    Route::post('get-states', 'StateController@allStates')->name('admin.getstates');
    Route::any('edit-state', 'StateController@editState')->name('admin.edit.state');
    Route::post('delete-state', 'StateController@deleteState')->name('admin.delete.state');
    //** Countries  Cities**//
    Route::get('cities', 'CitiesController@index')->name('admin.cities.index');
    Route::any('add-city', 'CitiesController@addCity')->name('admin.add.city');
    Route::post('get-cities', 'CitiesController@allCities')->name('admin.getcities');
    Route::any('edit-city', 'CitiesController@editCity')->name('admin.edit.city');
    Route::post('delete-city', 'CitiesController@deleteCity')->name('admin.delete.city');

    //** Payment Mangement**//
    Route::get('votespayments-list', 'PaymentsManagement@votesIndex')->name('admin.votes.payments');
    Route::post('votes-payments', 'PaymentsManagement@allVotes')->name('admin.votes.list.payments');
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
