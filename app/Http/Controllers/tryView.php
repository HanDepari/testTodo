<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tryView extends Controller
{
    public function index()
    {
        // return view('welcome', ['name' => 'John Doe']);
        return view('welcome');
    }
}
