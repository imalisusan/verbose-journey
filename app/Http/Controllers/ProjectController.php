<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
{
    $projects = Project::with('tasks')->get(); // Eager load the tasks relationship
    return view('projects.index', compact('projects'));
}

}
