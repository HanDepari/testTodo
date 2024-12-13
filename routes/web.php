<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/', function () {
    $name = "John Doe";
    return view('dashboard', compact('name'));
});
