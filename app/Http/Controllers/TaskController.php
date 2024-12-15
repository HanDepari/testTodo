<?php

namespace App\Http\Controllers;

use App\Services\TodoApiService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $apiService;

    public function __construct(TodoApiService $apiService)
    {
        // Assuming you have an auth middleware
        // $this->middleware('auth'); 
        $this->apiService = $apiService;
    }

    public function index()
    {
        $tasks = $this->apiService->getTasks();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $task = $this->apiService->createTask($validated['title'], $validated['description']);

        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'Task created successfully');
        }

        return back()->withErrors(['task' => 'Failed to create task']);
    }

    public function update(Request $request, $taskId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $task = $this->apiService->updateTask($taskId, $validated['title'], $validated['description']);

        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
        }

        return back()->withErrors(['task' => 'Failed to update task']);
    }

    public function complete($taskId)
    {
        if ($this->apiService->completeTask($taskId)) {
            return redirect()->route('tasks.index')->with('success', 'Task marked as complete');
        }

        return back()->withErrors(['task' => 'Failed to complete task']);
    }

    public function destroy($taskId)
    {
        if ($this->apiService->deleteTask($taskId)) {
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
        }

        return back()->withErrors(['task' => 'Failed to delete task']);
    }
}
