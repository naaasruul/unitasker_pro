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
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                                {{-- <td>Offenburg</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td> --}}
                            </tr>
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