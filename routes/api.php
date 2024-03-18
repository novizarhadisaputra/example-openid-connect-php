<?php

use App\Domain\V2\Authentication\Http\Controllers\LoginSSOController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

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

Route::prefix('v2')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::name('login.sso')->get('/login-sso', [LoginSSOController::class, 'authentication']);
        Route::name('callback')->get('/callback', [LoginSSOController::class, 'callback']);
    });
});
