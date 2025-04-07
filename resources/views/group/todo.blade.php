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
                <div class="mb-3">
                    <label for="required-skills" class="form-label">Required Skills</label>
                    <input type="text" id="skillsInput" class="form-control" placeholder="Type a skill and press Enter">
                    <div id="skillsContainer" class="mt-2">
                        <!-- Chips will be dynamically added here -->
                    </div>
                </div>
                <input type="hidden" name="required_skills" id="requiredSkillsInput">
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>

    {{-- Pending Tasks --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Tasks</h5>
        </div>
        <div class="card-body">
            @if ($tasks->count())
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item">
                            <strong>{{ $task->name }}</strong>
                            @if ($task->description)
                                <p>{{ $task->description }}</p>
                            @endif
                            @if ($task->required_skills)
                                <p><strong>Required Skills:</strong> {{ implode(', ', json_decode($task->required_skills)) }}</p>
                                <p><strong>Matching Users:</strong></p>
                                <ul>
                                    @foreach ($users as $user)
                                        @if ($user->hasSkills(json_decode($task->required_skills, true)))
                                            <li>{{ $user->name }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>

                            {{-- Change Status Form --}}
                            <form action="{{ route('group.change-status', [$group->id, $task->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                    <option value="not_complete" {{ $task->status === 'not_complete' ? 'selected' : '' }}>Not Complete</option>
                                    <option value="ongoing" {{ $task->status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No tasks available. Add a new task to get started!</p>
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
<script>
    $(document).ready(function () {
        const skillsInput = $('#skillsInput');
        const skillsContainer = $('#skillsContainer');
        const requiredSkillsInput = $('#requiredSkillsInput');
        let requiredSkills = [];

        // Add skill when pressing Enter
        skillsInput.on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                const skill = skillsInput.val().trim();
                if (skill && !requiredSkills.includes(skill)) {
                    requiredSkills.push(skill);
                    addSkillChip(skill);
                    skillsInput.val('');
                }
            }
        });

        // Add skill chip to the container
        function addSkillChip(skill) {
            const chip = $(`
                <span class="badge bg-primary me-2 skill-chip">
                    ${skill} <i class="bi bi-x-circle ms-1 remove-skill" style="cursor: pointer;"></i>
                </span>
            `);
            chip.find('.remove-skill').on('click', function () {
                removeSkill(skill);
                chip.remove();
            });
            skillsContainer.append(chip);
            updateRequiredSkillsInput();
        }

        // Remove skill from the array
        function removeSkill(skill) {
            requiredSkills = requiredSkills.filter(s => s !== skill);
            updateRequiredSkillsInput();
        }

        // Update the hidden input with the required skills
        function updateRequiredSkillsInput() {
            requiredSkillsInput.val(JSON.stringify(requiredSkills));
        }
    });
</script>
@include('user_header_footer.footer')

