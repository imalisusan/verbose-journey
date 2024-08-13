<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Task name" required>
    <select name="project_id">
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
    <button type="submit">Add Task</button>
</form>

<ul id="task-list">
    @foreach($tasks as $task)
        <li data-id="{{ $task->id }}">{{ $task->name }}</li>
    @endforeach
</ul>
