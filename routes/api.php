<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

// Protect all routes with API key authorization middleware
Route::middleware('api_key')->group(function () {
    // Task resource routes
    Route::apiResource('tasks', TaskController::class);
});

Route::get('/status', function () {
    return response()->json(['status' => 'API is running']);
});
