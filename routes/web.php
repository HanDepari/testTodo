<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('dashboard');
});

Route::get('/try', function () {
    $name = "John markus";
    return view('tryView', compact('name'));
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/landing', function () {
    return view('landing');
});
