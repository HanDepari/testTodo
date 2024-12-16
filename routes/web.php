<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware(['authmiddleware'])->group(function() {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/dashboard', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('landing');
});
