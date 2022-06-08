<?php

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


Route::post('login', [\App\Http\Controllers\Api\v1\AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('authenticated', [\App\Http\Controllers\Api\v1\AuthController::class, 'authenticated']);

    Route::apiResource('employees', \App\Http\Controllers\Api\v1\EmployeeController::class);
    Route::prefix('employees/{employee}/actions')->group(function () {
        Route::patch('activate', [\App\Http\Controllers\Api\v1\EmployeeController::class, 'activate']);
        Route::patch('deactivate', [\App\Http\Controllers\Api\v1\EmployeeController::class, 'deactivate']);
    });

    Route::apiResource('roles', \App\Http\Controllers\Api\v1\RoleController::class);
    Route::apiResource('permissions', \App\Http\Controllers\Api\v1\PermissionController::class);
    Route::apiResource('countries', \App\Http\Controllers\Api\v1\CountryController::class);
    Route::apiResource('positions', \App\Http\Controllers\Api\v1\PositionController::class);

    Route::post('logout', [\App\Http\Controllers\Api\v1\AuthController::class, 'logout']);
});

