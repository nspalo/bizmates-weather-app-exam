<?php

use App\Http\Controllers\API\WeatherApp\WeatherUpdateApiController;
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

// Bizmates Ph Weather App API Routes
Route::get('/weather-update', [
    'as' => 'forecast',
    'uses' => WeatherUpdateApiController::class,
]);
