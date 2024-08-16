<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Task management routes
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/', [TaskController::class, 'store'])->name('store');
        Route::get('/{slug}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('/{slug}', [TaskController::class, 'update'])->name('update');
        Route::delete('/{slug}', [TaskController::class, 'destroy'])->name('destroy');
        Route::post('/reorder', [TaskController::class, 'reorder'])->name('reorder');
    });

    // Project management routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

});
