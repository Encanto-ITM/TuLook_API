<?php

use App\Http\Controllers\Api\AcounttypeController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BenefitController;
use App\Http\Controllers\Api\ProfessionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServicehasbenefitController;
use App\Http\Controllers\Api\UserController;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/benefits/{serviceId}/services', [BenefitController::class, 'getBenefitsByService']);
Route::get('/benefits/search', [BenefitController::class, 'getBenefitsByName']);

Route::get('/services/{ownerId}/owner', [ServiceController::class, 'getServicesByOwner']);
Route::get('/services/search', [ServiceController::class, 'getServicesByName']);

Route::Resource('appointments', AppointmentController::class);
Route::Resource('professions', ProfessionController::class);
Route::Resource('acounttypes', AcounttypeController::class);
Route::Resource('services', ServiceController::class);
Route::Resource('benefits', BenefitController::class);
Route::Resource('users', UserController::class);