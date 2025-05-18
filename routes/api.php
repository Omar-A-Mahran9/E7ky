<?php

use App\Http\Controllers\Api\AgendaController as ApiAgendaController;
use App\Http\Controllers\Api\ArticalController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SocialController as ApiSocialController;
use App\Http\Controllers\Api\SpeakerController;
use App\Http\Controllers\Api\TalkController as ApiTalkController;
use App\Http\Controllers\Api\WorkshopsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('login', 'Auth\AuthController@loginByEmail');
    Route::post('login-otp/{customer:phone}', 'Auth\AuthController@loginOTP');
    Route::post('register', 'Auth\AuthController@register');
    Route::post('social_register', 'Auth\AuthController@Social_register');


    Route::post('send-otp/{data}', [ForgetPasswordController::class, 'sendOtp']);
    Route::get('resend-otp/{data}', [ForgetPasswordController::class, 'reSendOtp']);
    Route::post('check-otp/{data}', [ForgetPasswordController::class, 'checkOTP']);
    Route::post('change-password/{data}', [ForgetPasswordController::class, 'changePassword']);
    Route::get('articles', [ArticalController::class, 'index']);
        Route::get('category', [ArticalController::class, 'fetchAllCategories']);

    Route::get('/events/workshop/{id}', 'WorkshopsController@WorkshopPerEvent');

    Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('workshops', WorkshopsController::class);
    Route::apiResource('talks', ApiTalkController::class);

         Route::post('/customers/update-info', [ProfileController::class, 'updateInfo']);
        Route::post('/customers/update-password', 'ProfileController@updatePassword');
        Route::get('/customers/profile-info', [ProfileController::class, 'profileInfo'])->name('profile-info');

        Route::get('/current', function (Request $request) {
            return auth()->user();
        });
        Route::post('/booking/talk/{id}', 'TalkController@BookTalk');
        Route::post('/booking/workshop/{id}', 'WorkshopsController@Bookworkshop');

        Route::get('/booking/talk/{id}', [ApiTalkController::class, 'bookingtalk'])->name('booking.talk');

    });

    Route::get('/login/{provider}', [ApiSocialController::class,'redirectToProvider']);
    Route::get('/login/{provider}/callback', [ApiSocialController::class,'handleProviderCallback']);

    Route::apiResource('events', EventController::class);
    Route::get('/event/agenda/{id}', 'EventController@getAgenda');

    Route::get('/event/speakers/{id}', 'EventController@Eventspeakers');
    Route::apiResource('speakers', SpeakerController::class);

    Route::get('/events/talk/{id}', 'TalkController@talksPerEvent');


    Route::apiResource('agenda', ApiAgendaController::class);
    Route::get('/splashes', 'SplashController@index');

    Route::get('/home-page', 'HomeController@index');


});
