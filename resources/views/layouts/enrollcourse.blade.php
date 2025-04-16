@include('user_header_footer.header')
<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>My Course</h3>
                    {{-- <p class="text-subtitle text-muted">For Admin Manage Courses</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Course</li>
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
    </div>

    <div class="section">
        @if (Auth::user()->role !== 'admin')
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
                @elseif ($lecturerEnrollCourses->count())
                <ul class="list-group">
                    @foreach ($lecturerEnrollCourses as $course)
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enrollCourse">
                    <span>Select Course</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="modal fade text-left" id="enrollCourse" tabindex="-1" role="dialog" aria-labelledby="createGroupLabel"
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
                            <span class="d-none d-sm-block">Select Course</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('user_header_footer.footer')
