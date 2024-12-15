<?php

namespace App\Http\Controllers;

use App\Services\TodoApiService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $apiService;

    public function __construct(TodoApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($this->apiService->login($credentials['username'], $credentials['password'])) {
            return redirect()->route('tasks.index')->with('success', 'Logged in successfully');
        }

        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'no_telp' => 'required|min:10|max:14',
        ]);

        if ($this->apiService->register($credentials['username'], $credentials['password'], $credentials['no_telp'])) {
            return redirect()->route('login')->with('success', 'Registration successful');
        }

        return back()->withErrors(['register' => 'Registration failed']);
    }

    public function logout()
    {
        $this->apiService->logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
