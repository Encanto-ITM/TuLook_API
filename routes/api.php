<?php

use App\Http\Controllers\Api\AcounttypeController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ProfessionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TypeServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/services/{ownerId}/owner', [ServiceController::class, 'getServicesByOwner']);
Route::get('/services/search', [ServiceController::class, 'getServicesByName']);
Route::get('/services/{int}/filtertype', [ServiceController::class, 'getServicesByType']);
Route::Resource('services', ServiceController::class);

// Route::get('clients', [UserController::class, 'getClients']);
// Route::get('admins', [UserController::class, 'getAdmins']);
// Route::get('workers', [UserController::class, 'getWorkers']);
Route::apiResource('users', UserController::class);

Route::Resource('appointments', AppointmentController::class);
Route::get('/appointments/{ownerId}/owner', [AppointmentController::class, 'getAppointmentsByOwner']);
Route::get('/appointments/{clientId}/user', [AppointmentController::class, 'getAppointmentsByUser']);

Route::Resource('type_services', TypeServicesController::class);
Route::Resource('professions', ProfessionController::class);
Route::Resource('acounttypes', AcounttypeController::class);