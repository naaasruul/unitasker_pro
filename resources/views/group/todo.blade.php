@include('user_header_footer.header')

<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <h3>Group To-Do List: {{ $group->group_name ?? 'No Group Found' }}</h3>
            <p class="text-subtitle text-muted">Manage your assignments and tasks</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Task Form --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Add a New Task</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('group-tasks.store', $group->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Task Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Task Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>

    {{-- Pending Tasks --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Pending Tasks</h5>
        </div>
        <div class="card-body">
            @if ($tasks->where('is_completed', false)->count())
                <ul class="list-group">
                    @foreach ($tasks->where('is_completed', false) as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $task->name }}</strong>
                                @if ($task->description)
                                    <p class="mb-0">{{ $task->description }}</p>
                                @endif
                            </div>
                            <form action="{{ route('group-tasks.mark-completed', [$group->id, $task->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No pending tasks. Add a new task to get started!</p>
            @endif
        </div>
    </div>

    {{-- Completed Tasks --}}
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class=" text-white">Completed Tasks</h5>
        </div>
        <div class="card-body">
            @if ($tasks->where('is_completed', true)->count())
                <ul class="list-group">
                    @foreach ($tasks->where('is_completed', true) as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $task->name }}</strong>
                                @if ($task->description)
                                    <p class="mb-0">{{ $task->description }}</p>
                                @endif
                            </div>
                            <span class="badge bg-success">Completed</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No completed tasks yet.</p>
            @endif
        </div>
    </div>
</div>

@include('user_header_footer.footer')