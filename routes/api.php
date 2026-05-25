<?php

use App\Http\Controllers\Api\ContactUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/contact-us', [ContactUsController::class, 'store']);
Route::get('/contact-us', [ContactUsController::class, 'index']);

