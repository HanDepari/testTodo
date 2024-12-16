<?php

namespace App\Http\Controllers;

use App\Services\TodoApiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Modify the due_date format for each task
        $tasks = collect($tasks)->map(function ($task) {
            $task['due_date_text'] = Carbon::parse($task['due_date'])->translatedFormat('l, d-m-Y || H:i');
            return $task;
        });
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date_format:Y-m-d\TH:i',
        ]);
        
        $dueDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('due_date'))->format('Y-m-d H:i:s');
        $validated['due_date'] = $dueDate;
        $task = $this->apiService->createTask($validated['title'], $validated['due_date']);

        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'Task created successfully');
        }

        return back()->withErrors(['task' => 'Failed to create task']);
    }

    public function update(Request $request, $taskId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date_format:Y-m-d\TH:i',
        ]);
        
        $dueDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('due_date'))->format('Y-m-d H:i:s');
        $validated['due_date'] = $dueDate;

        $task = $this->apiService->updateTask($taskId, $validated['title'], $validated['due_date']);
        Log::info($task);

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
