<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// API v1 routes
Route::group([
    'prefix' => 'v1',
], function () {
    Route::apiResource('blogs', BlogController::class);
    Route::apiResource('categories', CategoryController::class)->except('show');
    Route::apiResource('tags', TagController::class)->except('show');
});
