@include('user_header_footer.header')

<div id="app">
    <div id="main">
        @include('layouts.side_menu')

        <div class="page-heading">
            <h3>Welcome, {{ Auth::user()->name }}!</h3>
        </div>

        <div class="page-content">
            <section class="row">
                {{-- Lecturer Profile --}}
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-6">
                            <div class="card">
                                <div class="card-body py-4 px-5">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Lecturer Photo">
                                        </div>
                                        <div class="ms-3 name">
                                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                            <h6 class="text-muted mb-0">{{ Auth::user()->role }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Student Task Completion --}}
               <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Student Task Completion</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>Group</th>
                                            <th>Task</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupData as $group)
                                            <tr>
                                                <td rowspan="{{ $group['tasks']->count() + 1 }}">
                                                    <strong>{{ $group['group_name'] }}</strong>
                                                </td>
                                            </tr>
                                            @foreach ($group['tasks'] as $task)
                                                <tr>
                                                    <td>{{ $task['task_name'] }}</td>
                                                    <td>{{ $task['description'] }}</td>
                                                    <td>
                                                        @if ($task['status'] == 'completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @elseif ($task['status'] == 'ongoing')
                                                            <span class="badge bg-warning">Ongoing</span>    
                                                        @else
                                                            <span class="badge bg-danger">Not Completed</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </section>
        </div>
    </div>
</div>

@include('user_header_footer.footer')