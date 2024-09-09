<?php

use App\Http\Controllers\Api\AcounttypeController;
use App\Http\Controllers\Api\ProfessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::Resource('professions', ProfessionController::class);
Route::Resource('acounttype', AcounttypeController::class);
