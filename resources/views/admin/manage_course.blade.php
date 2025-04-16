@include('user_header_footer.header')
<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manage Course</h3>
                    <p class="text-subtitle text-muted">For Admin Manage Courses</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Course</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            Course
                        </div>
                        <div class="col-2">
                            <button data-bs-toggle="modal" data-bs-target="#createGroupCourseModal" class='btn '>+ Add
                                Course</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Credit Hours</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->course_credit_hours }} Hours</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button data-bs-toggle="modal" data-bs-target="#edit_{{ $course->id }}" class="btn btn-primary">Edit</button>
                                    <!-- Delete Button -->
                                    <button data-bs-toggle="modal" data-bs-target="#delete_{{ $course->id }}" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade text-left" id="edit_{{ $course->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editCourseLabel_{{ $course->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editCourseLabel_{{ $course->id }}">Edit Course: {{ $course->course_name }}</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <!-- Course Name -->
                                                <label for="course-name-{{ $course->id }}">Course Name:</label>
                                                <div class="form-group">
                                                    <input type="text" id="course-name-{{ $course->id }}" name="course_name"
                                                        value="{{ $course->course_name }}" class="form-control" required>
                                                </div>

                                                <!-- Course Code -->
                                                <label for="course-code-{{ $course->id }}">Course Code:</label>
                                                <div class="form-group">
                                                    <input type="text" id="course-code-{{ $course->id }}" name="course_code"
                                                        value="{{ $course->course_code }}" class="form-control" required>
                                                </div>

                                                <!-- Credit Hours -->
                                                <label for="credit-hours-{{ $course->id }}">Credit Hours:</label>
                                                <div class="form-group">
                                                    <input type="number" id="credit-hours-{{ $course->id }}" name="course_credit_hours"
                                                        value="{{ $course->course_credit_hours }}" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Save Changes</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade text-left" id="delete_{{ $course->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteCourseLabel_{{ $course->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="deleteCourseLabel_{{ $course->id }}">Delete Course</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the course <strong>{{ $course->course_name }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Cancel</span>
                                                </button>
                                                <button type="submit" class="btn btn-danger ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Delete</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <!-- Create New Group Chat Modal -->
    <div class="modal fade text-left" id="createGroupCourseModal" tabindex="-1" role="dialog"
        aria-labelledby="createGroupChatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="createGroupChatLabel">Create New Course</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.courses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Course Name -->
                        <label for="course-name">Course Name:</label>
                        <div class="form-group">
                            <input type="text" id="course-name" name="course_name" placeholder="Enter course name"
                                class="form-control" required>
                        </div>

                        <!-- Course Code -->
                        <label for="course-code">Course Code:</label>
                        <div class="form-group">
                            <input type="text" id="course-code" name="course_code"
                                placeholder="Enter course code (unique)" class="form-control" required>
                        </div>

                        <!-- Credit Hours -->
                        <label for="credit-hours">Credit Hours:</label>
                        <div class="form-group">
                            <input type="number" id="credit-hours" name="course_credit_hours"
                                placeholder="Enter credit hours" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Create Course</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user_header_footer.footer')