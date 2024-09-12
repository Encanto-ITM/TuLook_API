<?php

use App\Http\Controllers\Api\AcounttypeController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BenefitController;
use App\Http\Controllers\Api\ProfessionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServicehasbenefitController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::Resource('servicehasbenefits', ServicehasbenefitController::class);
Route::Resource('appointments', AppointmentController::class);
Route::Resource('professions', ProfessionController::class);
Route::Resource('acounttypes', AcounttypeController::class);
Route::Resource('services', ServiceController::class);
Route::Resource('benefits', BenefitController::class);
Route::Resource('users', UserController::class);