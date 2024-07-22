<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TelemetryLogController;
use App\Http\Controllers\ISPUController;
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

Route::get('telemetry/get/{data}', [TelemetryLogController::class, 'get'])->name('telemetry_logs.get');
Route::post('telemetry/store', [TelemetryLogController::class, 'store'])->name('telemetry_logs.store');
Route::get('telemetry/getAverageISPUperDay', [ISPUController::class, 'getAverageISPUperDay']);
