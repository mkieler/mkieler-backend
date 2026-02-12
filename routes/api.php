<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\V1\ComponentController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::post('/contact', [ContactController::class, 'send']);

Route::prefix('v1')->group(function () {
    Route::get('/pages/{slug}', [PageController::class, 'show']);

    Route::get('/components/{name}', [ComponentController::class, 'show']);

    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/featured', [ServiceController::class, 'featured']);
    Route::get('/services/{slug}', [ServiceController::class, 'show']);

    Route::get('/testimonials', [TestimonialController::class, 'index']);
});
