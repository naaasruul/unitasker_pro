@include('user_header_footer.header')

<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <h3>Profile</h3>
            <p class="text-subtitle text-muted">Manage your profile information</p>
        </div>
    </div>
    {{-- Success and Error Messages --}}
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Profile Information</h4>
        </div>
        
        <div class="card-body">


            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="password">Password <small>(Leave blank to keep current password)</small></label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" id="role" class="form-control" value="{{ ucfirst(Auth::user()->role) }}"
                        disabled>
                </div>

                {{-- Skills Section for Students --}}
                @if (Auth::user()->role === 'student')
                <div class="form-group">
                    <label for="skills">Skills</label>
                    <input type="text" id="skillsInput" class="form-control" placeholder="Type a skill and press Enter">
                    <div id="skillsContainer" class="mt-2">
                        @foreach (json_decode(Auth::user()->skills ?? '[]', true) as $skill)
                        <span class="badge bg-primary me-2 skill-chip">
                            {{ $skill }} <i class="bi bi-x-circle ms-1 remove-skill" style="cursor: pointer;"></i>
                        </span>
                        @endforeach
                    </div>
                    <input type="hidden" name="skills" id="skillsHiddenInput" value="{{ Auth::user()->skills }}">
                </div>
                @endif

                <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>My Enrolled Courses</h4>
        </div>
        <div class="card-body">
            @if ($enrolledCourses->count())
            <ul class="list-group">
                @foreach ($enrolledCourses as $course)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $course->course_name }}</strong>
                        <p class="mb-0">Code: {{ $course->course_code }}</p>
                        <p class="mb-0">Credit Hours: {{ $course->course_credit_hours }}</p>
                    </div>
                    <form action="{{ route('profile.unenroll', $course->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Unenroll</button>
                    </form>
                </li>
                @endforeach
            </ul>
            @else
            <p>You are not enrolled in any courses.</p>
            @endif
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal">
                <span>Select Course</span>
            </button>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="createGroupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createGroupLabel">Select Course</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('profile.enroll') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="course_id">Select Course</label>
                    <select name="course_id" id="course_id" class="form-control" required>
                        <option value="" disabled selected>-- Select a Course --</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Create Group</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const skillsInput = $('#skillsInput');
        const skillsContainer = $('#skillsContainer');
        const skillsHiddenInput = $('#skillsHiddenInput');
        let skills = JSON.parse(skillsHiddenInput.val() || '[]');

        // Add skill when pressing Enter
        skillsInput.on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                const skill = skillsInput.val().trim();
                if (skill && !skills.includes(skill)) {
                    skills.push(skill);
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
            updateSkillsHiddenInput();
        }

        // Remove skill from the array
        function removeSkill(skill) {
            skills = skills.filter(s => s !== skill);
            updateSkillsHiddenInput();
        }

        // Update the hidden input with the skills array
        function updateSkillsHiddenInput() {
            skillsHiddenInput.val(JSON.stringify(skills));
        }
    });
</script>

@include('user_header_footer.footer')