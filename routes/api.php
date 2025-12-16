<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrackingController;

// Track brochure download (no auth required for public downloads)
Route::post('/track-brochure-download', [TrackingController::class, 'trackBrochureDownload']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
