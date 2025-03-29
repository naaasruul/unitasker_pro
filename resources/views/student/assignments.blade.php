@include('user_header_footer.header')
<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>My Assignments</h3>
                    <p class="text-subtitle text-muted">Manage your assignments and tasks</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Assignments</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Assignments Section -->
        <section class="assignments">
            <div class="row">
                <!-- Accordion for Assignment List -->
                <div class="col-lg-7">
                    <div class="accordion" id="assignmentAccordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Assignment 1: UI Design
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#assignmentAccordion">
                                <div class="card-body">
                                    <p>Description: Design the user interface for the project.</p>
                                    <p>Due Date: 2025-04-10</p>
                                    <p>Priority: High</p>
                                    <ul>
                                        <li>Task 1: Create wireframes</li>
                                        <li>Task 2: Design mockups</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Assignment 2: Backend Development
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#assignmentAccordion">
                                <div class="card-body">
                                    <p>Description: Develop the backend for the project.</p>
                                    <p>Due Date: 2025-04-15</p>
                                    <p>Priority: Medium</p>
                                    <ul>
                                        <li>Task 1: Set up database</li>
                                        <li>Task 2: Create APIs</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Add more assignments as needed -->
                    </div>
                </div>

                <!-- Form to Add Assignment -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Assignment</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <!-- Assignment Name -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="assignment-name">Assignment Name</label>
                                                    <input type="text" id="assignment-name" 
                                                        class="form-control" name="assignment-name" 
                                                        placeholder="Enter assignment name">
                                                </div>
                                            </div>
                                
                                            <!-- Description -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="assignment-desc">Description</label>
                                                    <textarea id="assignment-desc" 
                                                        class="form-control" name="assignment-desc" 
                                                        placeholder="Enter assignment description"></textarea>
                                                </div>
                                            </div>
                                
                                            <!-- Due Date -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="due-date">Due Date</label>
                                                    <input type="date" id="due-date" 
                                                        class="form-control" name="due-date">
                                                </div>
                                            </div>
                                
                                            <!-- Priority -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="assignment-priority">Priority</label>
                                                    <select id="assignment-priority" 
                                                        class="form-control" name="assignment-priority">
                                                        <option value="low">Low</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="high">High</option>
                                                    </select>
                                                </div>
                                            </div>
                                
                                            <!-- Submit and Reset Buttons -->
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" 
                                                    class="btn btn-primary me-1 mb-1">Add Assignment</button>
                                                <button type="reset" 
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@include('user_header_footer.footer')
