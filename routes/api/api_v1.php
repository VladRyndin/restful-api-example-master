<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function ($router) {
    Route::group(['middleware' => 'jwt'], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth_logout_v1');
        //TODO: review this endpoint
        Route::get('me', [AuthController::class, 'me'])->name('auth_me_v1');
    });

    Route::post('login', [AuthController::class, 'login'])->name('auth_login_v1');
    Route::post('register', [AuthController::class, 'registration'])->name('auth_registration_v1');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth_refresh_token_v1');
});
