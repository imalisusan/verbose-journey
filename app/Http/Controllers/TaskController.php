<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->project_id = $request->project_id;
        $task->priority = Task::where('project_id', $request->project_id)->max('priority') + 1;
        $task->save();

        return redirect()->back();
    }

    public function reorder(Request $request)
    {
        $tasks = Task::where('project_id', $request->project_id)->get();

        foreach ($tasks as $task) {
            $task->priority = array_search($task->id, $request->order) + 1;
            $task->save();
        }

        return response()->json(['success' => true]);
    }

}
