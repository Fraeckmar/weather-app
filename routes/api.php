<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Location
Route::get('location_search', [LocationController::class, 'search']);
Route::get('location_details', [LocationController::class, 'details']);
Route::get('location_photos', [LocationController::class, 'photos']);
Route::get('location_tips', [LocationController::class, 'tips']);

// Weather
Route::get('weather_today', [WeatherController::class, 'weatherToday']);
Route::get('weather_daily', [WeatherController::class, 'weatherDaily']);