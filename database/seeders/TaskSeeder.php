<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // First, create some projects to associate tasks with
        $project1 = Project::create(['name' => 'Project Alpha']);
        $project2 = Project::create(['name' => 'Project Beta']);

        // Seed tasks for Project Alpha
        $tasks = [
            ['name' => 'Design the homepage', 'priority' => 1, 'project_id' => $project1->id],
            ['name' => 'Develop the API', 'priority' => 2, 'project_id' => $project1->id],
            ['name' => 'Set up CI/CD pipeline', 'priority' => 3, 'project_id' => $project1->id],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }

        // Seed tasks for Project Beta
        $tasks = [
            ['name' => 'Create database schema', 'priority' => 1, 'project_id' => $project2->id],
            ['name' => 'Develop authentication module', 'priority' => 2, 'project_id' => $project2->id],
            ['name' => 'Test application', 'priority' => 3, 'project_id' => $project2->id],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
