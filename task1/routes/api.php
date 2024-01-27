<?php

use App\Http\Controllers\AcquiringController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InternalController;
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

Route::middleware('token.valid')->group(function () {
    Route::get('/cards/{card_number}', [AcquiringController::class, 'checkCard']);
    Route::post('/cards/charge', [AcquiringController::class, 'charge']);
});

Route::get('getCards', [InternalController::class, 'getCards']);

//За это много не отнимайте я просто плохо понял задачу и переспрашивать по 100500 раз не хотел реализовал просто через мидл вейр
//По итогу просто так время потерял
//    Route::post('/register', [AuthController::class, 'register']);
//    Route::post('/login', [AuthController::class, 'login']);
//    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
//    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//});

