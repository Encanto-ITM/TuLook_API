<?php

use App\Http\Controllers\Api\AcounttypeController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ProfessionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PruebasController;
use App\Http\Controllers\Api\TypeServicesController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ServicesInCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
    Route::post('/update-password', [AuthController::class, 'updatePassword']);
    Route::post('/recover-password', [AuthController::class, 'recoverPassword']);
});

Route::Resource('prueba/imagenes', PruebasController::class);

Route::get('/services/{ownerId}/owner', [ServiceController::class, 'getServicesByOwner']);
Route::get('/services/search', [ServiceController::class, 'getServicesByName']);
Route::get('/services/{int}/filtertype', [ServiceController::class, 'getServicesByType']);
Route::Resource('services', ServiceController::class);

Route::get('clients', [UserController::class, 'getClients']);
Route::get('admins', [UserController::class, 'getAdmins']);
Route::get('workers', [UserController::class, 'getWorkers']);
Route::apiResource('users', UserController::class);

Route::Resource('appointments', AppointmentController::class);
Route::get('/appointments/{ownerId}/owner', [AppointmentController::class, 'getAppointmentsByOwner']);
Route::get('/appointments/{clientId}/client', [AppointmentController::class, 'getAppointmentsByUser']);
Route::get('/appointments/{ownerId}/owner/on-time', [AppointmentController::class, 'getAppointmentsByOwneronTime']);
Route::get('/appointments/{clientId}/client/on-time', [AppointmentController::class, 'getAppointmentsByUserOnTime']);

Route::Resource('type_services', TypeServicesController::class);
Route::Resource('professions', ProfessionController::class);
Route::Resource('acounttypes', AcounttypeController::class);

Route::Resource('comments', CommentController::class);
Route::get('/comments/{serviceId}/service', [CommentController::class, 'getCommentsByService']);

Route::Resource('servicesincarts', ServicesInCartController::class);
Route::get('/servicesincarts/{userId}/user', [ServicesInCartController::class, 'getServicesInCartByUser']);
