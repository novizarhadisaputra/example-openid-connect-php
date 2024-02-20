<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Domain\V2\SatuSehat\Http\Controllers\SatuSehatController;

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

Route::get('/health-check', function () {
    $response = [
        'status' => 'success',
        'message' => 'Service is active',
        'timestamp' => now(),
    ];

    return Response::json($response);
});

Route::prefix('v2')->group(function () {
    Route::prefix('kyc')
        ->middleware(['auth.verification:KYC,CREATE'])
        ->controller(SatuSehatController::class)->group(function () {
            Route::post('/generate-url', 'generateUrlKYC');
        });
});
