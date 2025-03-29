@include('user_header_footer.header')

<div class="" id="app">
    <div id="main">
        @include('layouts.side_menu')
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <div class="page-heading">
                <h3>Welcome Lect. Miya !</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body py-4 px-5">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Face 1">
                                            </div>
                                            <div class="ms-3 name">
                                                <h5 class="font-bold">Miya</h5>
                                                <h6 class="text-muted mb-0">Lecturer</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Students assignments</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Table with outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Student</th>
                                                    <th>Assignment</th>
                                                    <th>Due Date</th>
                                                    <th>Progress</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-lg bg-primary">
                                                            <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Student Photo">
                                                        </div>
                                                        <span class="ms-2">Michael Right</span>
                                                    </td>
                                                    <td>Math Homework</td>
                                                    <td>Jan 10, 2025</td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-lg bg-secondary">
                                                            <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Student Photo">
                                                        </div>
                                                        <span class="ms-2">Sarah Johnson</span>
                                                    </td>
                                                    <td>Science Project</td>
                                                    <td>Jan 15, 2025</td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-lg bg-success">
                                                            <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Student Photo">
                                                        </div>
                                                        <span class="ms-2">James Smith</span>
                                                    </td>
                                                    <td>History Essay</td>
                                                    <td>Jan 20, 2025</td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="media d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" srcset="">
                                        <span class="avatar-status bg-success"></span>
                                    </div>
                                    <div class="name flex-grow-1">
                                        <h6 class="mb-0">Group 1</h6>
                                        <span class="text-xs">23 Members</span>
                                    </div>
                                    <button class="btn btn-sm">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body pt-4 bg-grey">
                                <div class="chat-content">
                                    <div class="chat">
                                        <div class="chat-body">
                                            <div class="chat-message">
                                                Hi Alfy, how can i help you?
                                                <div class="avatar ms-3">
                                                    <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" srcset="">
                                                    <span class="avatar-status bg-success"></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="chat chat-left">
                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" srcset="">
                                                    <span class="avatar-status bg-success"></span>
                                                </div>
                                                I'm looking for the best admin dashboard
                                                template</div>
                                            <div class="chat-message">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" srcset="">
                                                    <span class="avatar-status bg-success"></span>
                                                </div>With bootstrap certainly</div>
                                        </div>
                                    </div>
                                    <div class="chat">
                                        <div class="chat-body">
                                            <div class="chat-message">I recommend you to use Mazer Dashboard
                                                <div class="avatar ms-3">
                                                    <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" srcset="">
                                                    <span class="avatar-status bg-success"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-left">
                                        <div class="chat-body">
                                            <div class="chat-message">
                                                <div class="avatar me-3">
                                                    <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="" srcset="">
                                                    <span class="avatar-status bg-success"></span>
                                                </div>That"s great! I like it so much :)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="message-form d-flex flex-direction-column align-items-center">
                                    <a href="http://" class="black"><i data-feather="smile"></i></a>
                                    <div class="d-flex flex-grow-1 ml-4">
                                        <input type="text" class="form-control" placeholder="Type your message..">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

        </div>
    </div>
 

</div>    
@include('user_header_footer.footer')