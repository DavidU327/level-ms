<?php


use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserLevelController;
use Illuminate\Support\Facades\Route;
use App\Models\Rol;

Route::middleware(['auth.jwt', 'role:'.Rol::ADMIN])->group(function () {
    Route::get('levels', \App\Http\Controllers\LevelIndexController::class.'@index')->name('levels.index');
    Route::post('levels', \App\Http\Controllers\LevelStoreController::class.'@create')->name('levels.create');
    Route::put('levels/{level}', \App\Http\Controllers\LevelUpdateController::class.'@update')->name('levels.update');
    
});

Route::middleware('auth.jwt')->group(function () {
    Route::get('user-levels', [UserLevelController::class, 'index']);
    Route::post('user-levels', [UserLevelController::class, 'store']);
    Route::delete('user-levels', [UserLevelController::class, 'destroy']);
});
