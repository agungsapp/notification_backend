<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MemoController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::resource('/user', UserController::class);
    Route::get('/evaluasi-score', [UserController::class, 'getEvaluasi']);
    Route::resource('/memo', MemoController::class);
});
