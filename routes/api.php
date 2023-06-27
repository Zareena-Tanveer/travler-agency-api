<?php

use App\Http\Controllers\API\V1\TourController;
use App\Http\Controllers\API\V1\TravelController;
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

// public routes
Route::get('travels',[TravelController::class,'index']); //to get all the travels
Route::get('travels/{travel:slug}/tours',[TourController::class,'index']); //to get all the travels
Route::apiResources([
    // 'travel'=>TravelController::class,
    // 'tour'=>TravelController::class,
]);
