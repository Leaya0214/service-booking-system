<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Services
    Route::get('/services', [ServiceController::class, 'index']);
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{service}', [ServiceController::class, 'update']);
    Route::delete('/services/{service}', [ServiceController::class, 'destroy']);

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);

    // Admin bookings
    Route::get('/admin/bookings', [BookingController::class, 'index']);
});