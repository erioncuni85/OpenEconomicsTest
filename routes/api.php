<?php

use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\SpecieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('regions', [RegionController::class, 'index']);
