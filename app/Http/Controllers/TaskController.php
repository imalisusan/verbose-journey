<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('priority', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all(); 
        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'project_id' => 'required|exists:projects,id',
    ]);

    $task = new Task();
    $task->name = $validatedData['name'];
    $task->project_id = $validatedData['project_id'];
    $task->priority = Task::where('project_id', $validatedData['project_id'])->max('priority') + 1;
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}

public function reorder(Request $request)
{
    $order = $request->order;

    foreach ($order as $item) {
        Task::where('id', $item['id'])
            ->update(['priority' => $item['priority']]);
    }

    return response()->json(['success' => true]);
}


    public function edit(Task $task)
    {
        $projects = Project::all(); 
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task->name = $validatedData['name'];
        $task->project_id = $validatedData['project_id'];
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }


}
