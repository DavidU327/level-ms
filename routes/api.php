<?php

use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;
use App\Models\Rol;

Route::middleware(['auth.jwt', 'role:'.Rol::ADMIN])->group(function () {
    Route::get('levels', \App\Http\Controllers\LevelIndexController::class.'@index')->name('levels.index');
    Route::post('levels', \App\Http\Controllers\LevelStoreController::class.'@create')->name('levels.create');
    Route::put('levels/{level}', \App\Http\Controllers\LevelUpdateController::class.'@update')->name('levels.update');
    Route::patch('update-user-level', \App\Http\Controllers\UserLevelController::class.'@updateLevelUser')->name('levels.updateLevelUser'); //Actualizar nivel
    Route::get("level-user-dashboard", \App\Http\Controllers\DashboardController::class.'@levelDashboard')->name('levels.dashboard'); //Nivel dashboard
});

Route::post('user-level-init', \App\Http\Controllers\UserLevelController::class.'@storeInit')->name('userLevel.init'); //Nivel solo cuando se registra

Route::middleware(['auth.jwt', 'role:'.Rol::USER])->group(function () {
    Route::post('user-levels', [UserLevelController::class, 'store']);
});

Route::middleware('auth.jwt')->group(function () {
    Route::get('user-levels', [UserLevelController::class, 'index']);
    Route::delete('user-levels', [UserLevelController::class, 'destroy']);
});
