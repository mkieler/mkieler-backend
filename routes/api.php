<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\V1\HomepageController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\ServiceController;
use Illuminate\Support\Facades\Route;

Route::post('/contact', [ContactController::class, 'send']);

Route::prefix('v1')->group(function () {
    Route::get('/homepage', [HomepageController::class, 'index']);

    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/page', [ServiceController::class, 'page']);
    Route::get('/services/{slug}', [ServiceController::class, 'show']);

    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{slug}', [LocationController::class, 'show']);
});
