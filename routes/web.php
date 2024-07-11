<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\NotifController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index']);
Route::get('/airmap', [MainController::class, 'airmap']);

// Route::get('/average-readings', [MainController::class, 'getAverageReadings']);

Route::get('/test-mqtt', function () {
    return view('test.mqtt');
});

Route::get('/overview', function () {
    return view('overview');
});

Route::get('/airmap', [MainController::class, 'airmap']);

Route::get('/breathecare', function () {
    return view('breathecare');
});


Route::get('/faq', function () {
    return view('faq');
});

Route::get('/overview', [NotifController::class, 'checkAirQuality'])->name('overview');

