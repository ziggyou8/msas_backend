<?php

use App\Http\Controllers\API\CollectiviteController;
use App\Http\Controllers\API\DistricteSanitaireController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SourceFinancementController;
use App\Http\Controllers\API\StructureController;
use App\Http\Controllers\API\TypeActeurController;
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

/* Route::post("register", [RegisterController::class, "register"]);
Route::post("login", [RegisterController::class, "login"]); */

Route::group([
    "prefix" => "v1", 
    "as" => "api."
  ], function () {
    Route::post("register", [RegisterController::class, "register"]);
    Route::post("login", [RegisterController::class, "login"]);
  });
     
Route::middleware("auth:api")->group( function () {
    /* Route::resource("users", UserController::class); */
    Route::post("v1/logout",[RegisterController::class, "logout"] );
    Route::get("v1/users",[UserController::class, "index"] );
    Route::get("v1/user",[UserController::class, "get_current_user"] );
    Route::get("v1/users/{id}",[UserController::class, "show"] );
    Route::put("v1/users/{id}",[UserController::class, "update"] ); //?_method=PUT
    Route::post("v1/users",[UserController::class, "store"] );
    Route::delete("v1/users/{id}",[UserController::class, "destroy"]);

    Route::post("v1/financements",[SourceFinancementController::class, "store"]);
    Route::get("v1/financements",[SourceFinancementController::class, "index"]);
    Route::get("v1/financements/{id}",[SourceFinancementController::class, "show"]);
    Route::put("v1/financements/{id}",[SourceFinancementController::class, "update"]);
    Route::delete("v1/financements/{id}",[SourceFinancementController::class, "destroy"]);

    Route::get("v1/structures",[StructureController::class, "index"]);
    Route::post("v1/structures",[StructureController::class, "store"]);
    Route::get("v1/structures/{id}",[StructureController::class, "show"]);
    Route::put("v1/structures/{id}",[StructureController::class, "update"]);
    Route::delete("v1/structures/{id}",[StructureController::class, "destroy"]);

    Route::get("v1/roles",[RoleController::class, "index"]);
    Route::get("v1/roles/{id}",[RoleController::class, "show"]);
    Route::delete("v1/roles/{id}",[RoleController::class, "destroy"]);
    Route::get("v1/permissions", PermissionController::class);

    Route::get("v1/acteurs",[TypeActeurController::class, "index"]);
    Route::post("v1/acteurs",[TypeActeurController::class, "store"]);
    Route::get("v1/acteurs/{id}",[TypeActeurController::class, "show"]);
    Route::get("v1/acteurs-by-financement/{id}",[TypeActeurController::class, "ActeurByFinancement"]);
    Route::delete("v1/acteurs/{id}",[TypeActeurController::class, "destroy"]);
    Route::put("v1/acteurs/{id}",[TypeActeurController::class, "update"]);

    Route::get("v1/collectivites",[CollectiviteController::class, "index"]);
    Route::get("v1/collectivites/regions",[CollectiviteController::class, "region_list"]);
    Route::get("v1/collectivites/departements",[CollectiviteController::class, "departement_list"]);
    Route::get("v1/collectivites/communes",[CollectiviteController::class, "commune_list"]);
    Route::get("v1/collectivites/quartiers",[CollectiviteController::class, "quartier_list"]);
    Route::get("v1/collectivites/{code_parent}",[CollectiviteController::class, "collectivie_by_code_parent"]);

    Route::post("v1/collectivites",[CollectiviteController::class, "store"]);
    Route::get("v1/collectivites/{id}",[CollectiviteController::class, "show"]);
    /* Route::get("v1/collectivites-by-financement/{id}",[CollectiviteController::class, "ActeurByFinancement"]); */
    Route::delete("v1/collectivites/{id}",[CollectiviteController::class, "destroy"]);
    Route::put("v1/collectivites/{id}",[CollectiviteController::class, "update"]);
    Route::get("v1/districtes/by_parent/{parent_code}",[CollectiviteController::class, "collectivie_by_code_parent"]);



    Route::get("v1/districtes",[DistricteSanitaireController::class, "index"]);
    Route::post("v1/districtes",[DistricteSanitaireController::class, "store"]);
    Route::get("v1/districtes/{id}",[DistricteSanitaireController::class, "show"]);
    Route::delete("v1/districtes/{id}",[DistricteSanitaireController::class, "destroy"]);
    Route::put("v1/districtes/{id}",[DistricteSanitaireController::class, "update"]);

    


});
Route::post("v1/roles",[RoleController::class, "store"]);
Route::put("v1/roles/{id}",[RoleController::class, "update"]);

/* Route::middleware("auth:api")->get("v1/user", function (Request $request) {
    return $request->user();
}); */

/* Route::middleware("auth:api")->post("/logout",[RegisterController::class, "logout"] ); */
