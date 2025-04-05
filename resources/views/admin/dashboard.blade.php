@include('user_header_footer.header')
<div id="app">
    <div id="main">
        @include('layouts.side_menu')

        <div class="page-heading no-print">
            <h3>Welcome Admin !</h3>
        </div>
        <div class="page-content no-print">
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-6">
                            <div class="card">
                                <div class="card-body py-4 px-5">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Face 1">
                                        </div>
                                        <div class="ms-3 name">
                                            <h5 class="font-bold">Admin</h5>
                                            <h6 class="text-muted mb-0">Administrator</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Students</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="student_bar"></canvas>
                                <!-- Print button for performance card -->
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lecturers</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="lecturer_bar"></canvas>
                                <!-- Print button for performance card -->
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Students Details</h4>
                    </div>
        
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Student ID</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <div class="avatar avatar-lg bg-primary">
                                                        <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Student Photo">
                                                    </div>
                                                    <span class="ms-2">{{ $student->name }}</span>
                                                </td>
                                                <td>STUD{{ $student->id ?? 'N/A' }}</td>
                                                <td>{{ $student->email }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>

        <!-- Lecturers Section -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Lecturers Details</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>Lecturer</th>
                                    <th>Lecturer ID</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lecturers as $lecturer)
                                <tr>
                                    <td>
                                        <div class="avatar avatar-lg bg-success">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Lecturer Photo">
                                        </div>
                                        <span class="ms-2">{{ $lecturer->name }}</span>
                                    </td>
                                    <td>LECT{{ $lecturer->id ?? 'N/A' }}</td>
                                    <td>{{ $lecturer->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>
</div>

<script>
    var labels = @json($labels);
    var studentData = @json($studentData);
    var lecturerData = @json($lecturerData);
</script>

@include('user_header_footer.footer')

