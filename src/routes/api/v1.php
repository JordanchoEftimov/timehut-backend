<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\ShiftController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::name('shift.')->prefix('/shift')->group(function () {
        Route::post('/start', [ShiftController::class, 'startShift'])->name('start');
        Route::post('/end/{shift}', [ShiftController::class, 'endShift'])->name('end');
    });
});
