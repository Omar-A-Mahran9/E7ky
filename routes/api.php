<?php

use App\Http\Controllers\Api\AgendaController as ApiAgendaController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SpeakerController;
use App\Http\Controllers\Api\TalkController as ApiTalkController;
use App\Http\Controllers\Api\WorkshopsController;
use Illuminate\Http\Request;
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

    Route::post('send-otp/{phone}', 'Auth\ForgetPasswordController@sendOtp');
    Route::post('check-otp/{customer:phone}', 'Auth\ForgetPasswordController@checkOTP');
    Route::post('change-password/{customer:phone}', 'Auth\ForgetPasswordController@changePassword');
    Route::get('resend-otp/{customer:phone}', 'Auth\ForgetPasswordController@reSendOtp');

    Route::middleware(['auth:api'])->group(function () {
        Route::post('products/{product}/rate', 'ProductController@rate');
        Route::post('/customers/update-info', [ProfileController::class, 'updateInfo']);
        Route::post('/customers/update-password', 'ProfileController@updatePassword');
        Route::get('/customers/profile-info', [ProfileController::class, 'profileInfo'])->name('profile-info');

        Route::get('/current', function (Request $request) {
            return auth()->user();
        });
    });


    Route::apiResource('events', EventController::class);
    Route::get('/event/speakers/{id}', 'EventController@Eventspeakers');
    Route::apiResource('speakers', SpeakerController::class);

    Route::apiResource('talks', ApiTalkController::class);
    Route::get('/events/talk/{id}', 'TalkController@talksPerEvent');

    Route::apiResource('workshops', WorkshopsController::class);
    Route::get('/events/workshop/{id}', 'WorkshopsController@WorkshopPerEvent');

    Route::apiResource('agenda', ApiAgendaController::class);


});
