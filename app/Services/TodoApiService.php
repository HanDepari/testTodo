<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TodoApiService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.todo_api.base_url');
        $this->token = session('api_token');
    }

    public function login($username, $password)
    {
        try {
            $response = Http::post("{$this->baseUrl}/login", [
                'username' => $username,
                'password' => $password
            ]);

            if ($response->successful()) {
                // Store the Bearer token
                session(['api_token' => $response->json('token')]);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Login API Error: ' . $e->getMessage());
            return false;
        }
    }

    public function register($username, $password, $no_telp)
    {
        try {
            $response = Http::post("{$this->baseUrl}/register", [
                'username' => $username,
                'password' => $password,
                'no_telp' => $no_telp
            ]);
            Log::info($response);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Register API Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getTasks()
    {
        try {
            $response = Http::withToken($this->token)
                ->get("{$this->baseUrl}/tasks");

            return $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            Log::error('Get Tasks API Error: ' . $e->getMessage());
            return [];
        }
    }

    public function createTask($title, $due_date)
    {
        try {
            $response = Http::withToken($this->token)
                ->post("{$this->baseUrl}/tasks", [
                    'title' => $title,
                    'due_date' => $due_date
                ]);

            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('Create Task API Error: ' . $e->getMessage());
            return null;
        }
    }

    public function updateTask($taskId, $title, $due_date)
    {
        try {
            $response = Http::withToken($this->token)
                ->put("{$this->baseUrl}/tasks/{$taskId}", [
                    'title' => $title,
                    'due_date' => $due_date
                ]);

            return $response->successful() ? $response->json() : null;
        } catch (\Exception $e) {
            Log::error('Update Task API Error: ' . $e->getMessage());
            return null;
        }
    }

    public function completeTask($taskId)
    {
        try {
            $response = Http::withToken($this->token)
                ->patch("{$this->baseUrl}/tasks/{$taskId}/complete");

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Complete Task API Error: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteTask($taskId)
    {
        try {
            $response = Http::withToken($this->token)
                ->delete("{$this->baseUrl}/tasks/{$taskId}");

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Delete Task API Error: ' . $e->getMessage());
            return false;
        }
    }

    public function logout()
    {
        try {
            $response = Http::withToken($this->token)
                ->post("{$this->baseUrl}/logout");

            // Clear the token regardless of API response
            session()->forget('api_token');

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Logout API Error: ' . $e->getMessage());
            session()->forget('api_token');
            return false;
        }
    }
}