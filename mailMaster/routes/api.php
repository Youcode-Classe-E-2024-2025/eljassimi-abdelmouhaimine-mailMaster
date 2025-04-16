<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NewsletterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('newsletters', NewsletterController::class);

});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
