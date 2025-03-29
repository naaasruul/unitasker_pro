@include('user_header_footer.header')
<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <h3>My Assignments</h3>
            <p class="text-subtitle text-muted">Manage your assignments and tasks</p>
        </div>

        <!-- Assignments Section -->
        <section class="assignments">
            <div class="row">
                <!-- Accordion for Assignment List -->
                <div class="col-lg-7">
                    <div class="accordion" id="assignmentAccordion">
                        @foreach ($assignments as $assignment)
                        <div class="card">
                            <div class="card-header" id="heading{{ $assignment->id }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $assignment->id }}" aria-expanded="true" aria-controls="collapse{{ $assignment->id }}">
                                        {{ $assignment->name }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{ $assignment->id }}" class="collapse" aria-labelledby="heading{{ $assignment->id }}" data-bs-parent="#assignmentAccordion">
                                <div class="card-body">
                                    <p><strong>Description:</strong> {{ $assignment->description }}</p>
                                    <p><strong>Due Date:</strong> {{ $assignment->due_date }}</p>
                                    <p><strong>Priority:</strong> {{ ucfirst($assignment->priority) }}</p>
                                    <ul>
                                        @foreach ($assignment->tasks as $task)
                                        <li>
                                            <input type="checkbox" {{ $task->is_completed ? 'checked' : '' }}>
                                            {{ $task->name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    <!-- Add New Task Button -->
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal{{ $assignment->id }}">Add New Task</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal to Add New Task -->
                        <div class="modal fade" id="addTaskModal{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel{{ $assignment->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTaskModalLabel{{ $assignment->id }}">Add New Task for {{ $assignment->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('student.tasks.store', $assignment) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="task-name-{{ $assignment->id }}">Task Name</label>
                                                <input type="text" id="task-name-{{ $assignment->id }}" name="name" class="form-control" placeholder="Enter task name">
                                            </div>
                                            <div class="form-group">
                                                <label for="task-desc-{{ $assignment->id }}">Task Description</label>
                                                <textarea id="task-desc-{{ $assignment->id }}" name="description" class="form-control" placeholder="Enter task description"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Add Task</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Form to Add Assignment -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Assignment</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.assignments.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="assignment-name">Assignment Name</label>
                                    <input type="text" id="assignment-name" name="name" class="form-control" placeholder="Enter assignment name">
                                </div>
                                <div class="form-group">
                                    <label for="assignment-desc">Description</label>
                                    <textarea id="assignment-desc" name="description" class="form-control" placeholder="Enter assignment description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="due-date">Due Date</label>
                                    <input type="date" id="due-date" name="due_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="assignment-priority">Priority</label>
                                    <select id="assignment-priority" name="priority" class="form-control">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Add Assignment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('user_header_footer.footer')