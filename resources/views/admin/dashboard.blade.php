@include('user_header_footer.header')
<div id="app">
    <div id="main">
        <div id="sidebar" class="active no-print">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html">UNITASKER</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
        
                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
        
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>User</span>
                            </a>
                           <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="allStudent.html">Students</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="allLecturer.html">Lecturers</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="performance.html">Performance</a>
                                </li>
                            </ul>
                        </li>
                        <hr>
                        <li class="sidebar-item  ">
                            <a href="../login.html" class='sidebar-link'>
                                <span>Log out</span>
                            </a>
                        </li>
        
        
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

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
                                            <img src="assets/images/faces/2.jpg" alt="Face 1">
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
                                <h4 class="card-title">Student Performance</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="bar"></canvas>
                                <!-- Print button for performance card -->
                            </div>
                             
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
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
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="avatar avatar-lg bg-primary">
                                                    <img src="assets/images/faces/1.jpg" alt="Student Photo">
                                                </div>
                                                <span class="ms-2">Michael Right</span>
                                            </td>
                                            <td>SR12345</td>
                                            <td>michael.right@example.com</td>
                                            <td>Computer Science</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar avatar-lg bg-secondary">
                                                    <img src="assets/images/faces/2.jpg" alt="Student Photo">
                                                </div>
                                                <span class="ms-2">Sarah Johnson</span>
                                            </td>
                                            <td>SR12346</td>
                                            <td>sarah.johnson@example.com</td>
                                            <td>Biology</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar avatar-lg bg-success">
                                                    <img src="assets/images/faces/3.jpg" alt="Student Photo">
                                                </div>
                                                <span class="ms-2">James Smith</span>
                                            </td>
                                            <td>SR12347</td>
                                            <td>james.smith@example.com</td>
                                            <td>History</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar avatar-lg bg-info">
                                                    <img src="assets/images/faces/4.jpg" alt="Student Photo">
                                                </div>
                                                <span class="ms-2">Emma Watson</span>
                                            </td>
                                            <td>SR12348</td>
                                            <td>emma.watson@example.com</td>
                                            <td>Literature</td>
                                        </tr>
                                    </tbody>
                                </table>
                         
                            </div>
                                           <!-- Print button for students details -->
                        </div>
                        
            
                   
                </div>
                
            </div>
        </div>

    </div>
</div>

@include('user_header_footer.footer')