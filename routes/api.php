<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SourceFinancementController;
use App\Http\Controllers\API\UserController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    /* Route::resource('users', UserController::class); */
    Route::post('/logout',[RegisterController::class, 'logout'] );
    Route::get('/users',[UserController::class, 'index'] );
    Route::get('/users/{id}',[UserController::class, 'show'] );
    Route::put('/users/{id}',[UserController::class, 'update'] ); //?_method=PUT
    Route::post('/users',[UserController::class, 'store'] );
    Route::delete('/users/{id}',[UserController::class, 'destroy']);

    Route::post('/financements',[SourceFinancementController::class, 'store']);
    Route::get('/financements',[SourceFinancementController::class, 'index']);
    Route::delete('/financements/{id}',[SourceFinancementController::class, 'destroy']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::middleware('auth:api')->post('/logout',[RegisterController::class, 'logout'] ); */
