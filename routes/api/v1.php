<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\PauseController;
use App\Http\Controllers\V1\SalaryController;
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
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::name('shifts.')->prefix('/shifts')->group(function () {
        Route::post('/start', [ShiftController::class, 'startShift'])->name('start');
        Route::post('/end', [ShiftController::class, 'endShift'])->name('end');
        Route::get('/', [ShiftController::class, 'getShifts'])->name('get');
    });

    Route::name('pauses.')->prefix('/shifts/{shift}')->group(function () {
        Route::post('/start', [PauseController::class, 'startPause'])->name('start');
        Route::post('/{pause}/end', [PauseController::class, 'endPause'])->name('end');
    });

    Route::name('salaries.')->prefix('/salaries')->group(function () {
        Route::get('/', [SalaryController::class, 'getSalaries'])->name('get');
    });
});
