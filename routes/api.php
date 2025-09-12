<?php


use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;
use App\Models\Rol;

Route::middleware(['auth.jwt', 'role:'.Rol::ADMIN])->group(function () {
    Route::get('levels', [LevelController::class, 'index']);
    // Route::apiResource('levels', LevelController::class);
});

Route::middleware('auth.jwt')->group(function () {
    Route::get('user-levels', [UserLevelController::class, 'index']);
    Route::post('user-levels', [UserLevelController::class, 'store']);
    Route::delete('user-levels', [UserLevelController::class, 'destroy']);
});
