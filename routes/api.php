<?php

use App\Http\Controllers\apiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('api')->group(function () {
    Route::get('/urls', [apiController::class, 'index']);
    Route::get('/{shortUrl}', [apiController::class, 'show']);
});