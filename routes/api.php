<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/typeform-integration-test', [\App\Http\Controllers\TypeformWebhookController::class, 'handle']);
