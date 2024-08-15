<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Task List</h2>

    <!-- Create New Task Button floated to the right -->
    <div class="clearfix mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary float-right">Create New Task</a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Task Table -->
    <table class="table table-bordered" id="taskTable">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Project</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sortable">
            @foreach($tasks as $task)
                <tr data-id="{{ $task->id }}">
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->project->name }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button with Form -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include Sortable.js and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
  var el = document.getElementById('sortable');
    var sortable = Sortable.create(el, {
        onEnd: function (evt) {
            var order = [];
            $('#sortable tr').each(function(index, element) {
                order.push({
                    id: $(element).data('id'),
                    priority: index + 1
                });
            });

            // Send the order array to the backend
            $.ajax({
                url: "{{ route('tasks.reorder') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    order: order
                },
                success: function(response) {
                    if(response.success) {
                        location.reload(); // Reload the page to reflect new priorities
                    }
                }
            });
        }
    });

</script>
</body>
</html>
