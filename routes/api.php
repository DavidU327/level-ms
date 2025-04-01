<?php


use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.jwt')->group(function () {
    Route::apiResource('levels', LevelController::class);
    Route::get('user-levels', [UserLevelController::class, 'index']);
    Route::post('user-levels', [UserLevelController::class, 'store']);
    Route::delete('user-levels', [UserLevelController::class, 'destroy']);
});
