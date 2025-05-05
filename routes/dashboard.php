<?php

use App\Http\Controllers\Dashboard\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get("/", "DashboardController@index")->name('index');
/* begin Delete And restore */
Route::delete("admins/delete-selected", "AdminController@deleteSelected");
Route::get("admins/restore-selected", "AdminController@restoreSelected");

Route::delete("customers/delete-selected", "CustomerController@deleteSelected");
Route::delete("splashes/delete-selected", "SplashController@deleteSelected");
Route::get("splashes/restore-selected", "SplashController@restoreSelected");

/** begin resources routes **/

Route::resource('admins', 'AdminController')->except(['create', 'edit']);
Route::resource('events', 'EventController')->except(['create', 'edit']);
Route::resource('articles', 'ArticlesController')->except(['create', 'edit']);
Route::resource('articles_categories', 'ArticlesCategoriesController')->except(['create', 'edit']);

Route::resource('sessions', 'SessionController')->except(['create', 'edit']);
Route::resource('splashes', 'SplashController')->except(['create', 'edit']);

Route::get('get-days/{eventId}', [SessionController::class, 'getDaysByEvent']);
Route::resource('workshops', 'WorkshopController')->except(['create', 'edit']);

Route::resource('blogs', 'BlogsController')->except(['create', 'edit']);
Route::resource('CommonQuestion', 'CommonQuestionController')->except(['create', 'edit']);


Route::resource('packages', 'PackagesController')->except(['create', 'edit']);


Route::resource('customers', 'CustomerController')->except(['create', 'edit']);
Route::resource('customers_rates', 'CustomersRatesController')->except(['create', 'edit']);
Route::resource('booking', 'BookingController')->except(['create', 'edit']);

Route::get('customers/blocking/{customer}', 'CustomerController@blocked')->name('customers.blocked');
Route::get('customers/blocked-selected', 'CustomerController@blockedSelected');


Route::resource('newsletter', 'NewsLetterController')->only(['index', 'destroy']);
Route::get('profile-info', 'ProfileController@profileInfo')->name('profile-info');
Route::put('update-profile-info', 'ProfileController@updateProfileInfo')->name('update-profile-info');
Route::put('update-profile-email', 'ProfileController@updateProfileEmail')->name('update-profile-email');
Route::put('update-profile-password', 'ProfileController@updateProfilePassword')->name('update-profile-password');
/** ajax routes **/
Route::post('dropzone/validate-image', 'DropzoneController@validateImage')->name('dropzone.validate-image');
Route::post("select2-ajax/subcategories", "ProductController@getSubcategories")->name('select2-ajax.subcategories');
Route::post("select2-ajax/vendor-cities", "ProductController@getCitiesBasedOnVendor")->name('select2-ajax.vendor-cities');

/**  ====================SETTINGS======================  **/
Route::prefix('settings')->name('settings.')->group(function () {
    Route::match(['get', 'post'], 'general/main', 'SettingController@main')->name('general.main');
    Route::match(['get', 'post'], 'general/terms', 'SettingController@terms')->name('general.terms');
    Route::match(['get', 'post'], 'general/contact', 'SettingController@contact')->name('general.contact');
    Route::match(['get', 'post'], 'general/mobile-app', 'SettingController@mobileApp')->name('general.mobile_app');
    Route::match(['get', 'post'], 'general/tax', 'SettingController@tax')->name('general.tax');

    Route::resource('roles', 'RoleController');
    Route::get('role/{role}/admins', 'RoleController@admins');

    Route::match(['get', 'post'], 'home-content/main', 'HomeController@index')->name('home-content');
    Route::match(['get', 'post'], 'home-content/about-us', 'HomeController@aboutUs')->name('home.about-us');
    Route::match(['get', 'post'], 'home-content/terms', 'HomeController@terms')->name('home.terms');
    Route::match(['get', 'post'], 'home-content/privacy-policy', 'HomeController@privacyPolicy')->name('home.privacy-policy');
    Route::match(['get', 'post'], 'home-content/return-policy', 'HomeController@returnPolicy')->name('home.return-policy');
    Route::match(['get', 'post'], 'home-content/loyality', 'HomeController@loyality')->name('home.loyality');


    Route::post('payment-content/payment-way', 'HomeController@paymentWaystore')->name('home.payment-way.post');
    Route::post('payment-content/payment-way/{id}/update_statue', 'HomeController@updatestatuePaymentWay')->name('home.payment-way.update');
    Route::get('payment-content/payment-way', 'HomeController@paymentWay')->name('home.payment-way.get');
    Route::delete('payment-content/payment-way/{id}/delete', 'HomeController@deletepaymentWay')->name('home.payment-way.delete');


    Route::post('payment-content/payment-partener', 'HomeController@paymentpartenerstore')->name('home.payment-partener.post');
    Route::post('payment-content/payment-partener/{id}/update_statue', 'HomeController@updatestatue')->name('home.payment-partener.update');
    Route::get('payment-content/payment-partener', 'HomeController@paymentpartener')->name('home.payment-partener.get');
});

Route::get('trash/{modelName}/{id}/restore', 'TrashController@restore')->name('trash.restore');
Route::get('trash/{modelName?}', 'TrashController@index')->name('trash');
Route::get('trash/{modelName}/{id}', 'TrashController@restore');
Route::get('/language/{lang}', function (Request $request) {
    session()->put('locale', $request->lang);
    return redirect()->back();
})->name('change-language');
