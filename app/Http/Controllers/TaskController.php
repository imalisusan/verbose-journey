<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        $selectedProject = $request->input('project');

        $tasks = Task::when($selectedProject, function ($query, $selectedProject) {
            return $query->where('project_id', $selectedProject);
        })->orderBy('priority', 'asc')->get();

        return view('tasks.index', compact('tasks', 'projects', 'selectedProject'));
    }

    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validatedData = $request->validated();

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

    public function edit($slug)
    {
        $task = Task::where('slug', $slug)->firstOrFail();
        $projects = Project::all();

        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(UpdateTaskRequest $request, $slug)
    {
        $task = Task::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validated();

        $task->name = $validatedData['name'];
        $task->project_id = $validatedData['project_id'];
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy($slug)
    {
        $task = Task::where('slug', $slug)->firstOrFail();
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
