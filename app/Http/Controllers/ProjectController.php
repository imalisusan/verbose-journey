<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();

        return view('projects.index', compact('projects'));
    }
}
