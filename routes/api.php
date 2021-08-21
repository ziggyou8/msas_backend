<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SourceFinancementController;
use App\Http\Controllers\API\StructureController;
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

/* Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']); */

Route::group([
    'prefix' => 'v1', 
    'as' => 'api.'
  ], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);
  });
     
Route::middleware('auth:api')->group( function () {
    /* Route::resource('users', UserController::class); */
    Route::post('v1/logout',[RegisterController::class, 'logout'] );
    Route::get('v1/users',[UserController::class, 'index'] );
    Route::get('v1/user',[UserController::class, 'get_current_user'] );
    Route::get('v1/users/{id}',[UserController::class, 'show'] );
    Route::put('v1/users/{id}',[UserController::class, 'update'] ); //?_method=PUT
    Route::post('v1/users',[UserController::class, 'store'] );
    Route::delete('v1/users/{id}',[UserController::class, 'destroy']);

    Route::post('/financements',[SourceFinancementController::class, 'store']);
    Route::get('/financements',[SourceFinancementController::class, 'index']);
    Route::delete('/financements/{id}',[SourceFinancementController::class, 'destroy']);

    Route::get('/structures',[StructureController::class, 'index']);
    Route::post('/structures',[StructureController::class, 'store']);

    Route::get('v1/roles',[RoleController::class, 'index']);
    Route::get('v1/roles/{id}',[RoleController::class, 'show']);
    Route::delete('v1/roles/{id}',[RoleController::class, 'destroy']);

});
Route::post('v1/roles',[RoleController::class, 'store']);
Route::put('v1/roles/{id}',[RoleController::class, 'update']);

/* Route::middleware('auth:api')->get('v1/user', function (Request $request) {
    return $request->user();
}); */

/* Route::middleware('auth:api')->post('/logout',[RegisterController::class, 'logout'] ); */
