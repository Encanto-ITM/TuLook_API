<?php

use App\Http\Controllers\Api\AcounttypeController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ProfessionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TypeServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/services/{ownerId}/owner', [ServiceController::class, 'getServicesByOwner']);
Route::get('/services/search', [ServiceController::class, 'getServicesByName']);
Route::get('/services/{int}/filtertype', [ServiceController::class, 'getServicesByType']);

Route::get('workers', [UserController::class, 'getWorkers']);

Route::apiResource('type-services', TypeServiceController::class);
Route::Resource('appointments', AppointmentController::class); // filtrar por usuario
Route::Resource('professions', ProfessionController::class);
Route::Resource('acounttypes', AcounttypeController::class);
Route::Resource('services', ServiceController::class);
Route::Resource('users', UserController::class);