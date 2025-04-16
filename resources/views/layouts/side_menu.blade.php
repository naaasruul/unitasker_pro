{{--  --}}
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="#">UNITASKER</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                {{-- Dashboard --}}
                <li
                    class="sidebar-item 
                    @if (Auth::user()->role === 'admin' && Request::routeIs('admin.dashboard')) active 
                    @elseif (Auth::user()->role === 'lecturer' && Request::routeIs('lecturer.dashboard')) active 
                    @elseif (Auth::user()->role === 'student' && Request::routeIs('student.dashboard')) active @endif">
                    <a href="
                        @if (Auth::user()->role === 'admin') {{ route('admin.dashboard') }}
                        @elseif (Auth::user()->role === 'lecturer')
                            {{ route('lecturer.dashboard') }}
                        @elseif (Auth::user()->role === 'student')
                            {{ route('student.dashboard') }} @endif
                    "
                        class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Student Menu --}}
                @if (Auth::user()->role === 'student')
                    {{-- <li class="sidebar-item has-sub {{ Request::routeIs('student.assignment') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Task Management</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::routeIs('student.assignment') ? 'active' : '' }}">
                                <a href="{{ route('student.assignment') }}">Assignments</a>
                            </li>
                        </ul>
                    </li> --}}
                @endif
                   
                @if (Auth::user()->role !== 'admin')
                <li class="sidebar-item">
                    <a href="{{ Route('course.index') }}" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Course</span>
                    </a>
                </li>
                @endif    
                {{-- Lecturer Menu --}}
                @if (Auth::user()->role === 'lecturer')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Create</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item">
                                <a data-bs-toggle="modal" data-bs-target="#createGroupAssignmentModal">
                                    New Group Assignment
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Display Created Groups --}}
                    <li class="sidebar-title">Your Groups</li>
                    @foreach (Auth::user()->createdGroups as $group)
                        <li class="sidebar-item {{ Request::is('lecturer/groups/' . $group->id . '/chats') ? 'active' : '' }}">
                            <a href="{{ route('lecturer.groups.chats', $group->id) }}" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>{{ $group->group_name }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
             



                {{-- Admin Menu --}}
                @if (Auth::user()->role === 'admin')
                        
                    <li class="sidebar-item {{ Request::routeIs('admin.courses.index') || Request::routeIs('admin.manage-lecturers') ? 'active' : '' }}">
                        <a href="{{ route('admin.courses.index') }}" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Course</span>
                        </a>
                    </li>
                    <li class="sidebar-item has-sub {{ Request::routeIs('admin.manage-students') || Request::routeIs('admin.manage-lecturers') ? 'active' : '' }}">
                        <a href="{{ route('admin.manage-students') }}" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>User</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::routeIs('admin.manage-students') ? 'active' : '' }}">
                                <a href="{{ route('admin.manage-students') }}">Students</a>
                            </li>
                            <li class="submenu-item {{ Request::routeIs('admin.manage-lecturers') ? 'active' : '' }}">
                                <a href="{{ route('admin.manage-lecturers') }}">Lecturers</a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Chatroom Section --}}
                @if (Auth::user()->role === 'student')
                    <li class="sidebar-title">Chatroom</li>

                    @if (Auth::user()->role === 'student')
                        <li class="sidebar-item">
                            <a href="#" class='sidebar-link' data-bs-toggle="modal" data-bs-target="#joinGroupModal">
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>+ Join Group</span>
                            </a>
                        </li>
                    @endif
                    
                    @foreach (Auth::user()->groups as $group)
                        <li class="sidebar-item {{ Request::is('chat/' . $group->id) ? 'active' : '' }}">
                            <a href="{{ route('chat.index', $group) }}" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>{{ $group->group_name }}</span>
                            </a>
                        </li>
                    @endforeach

                @endif

                <hr>

                <li class="sidebar-item">
                    <a href="{{ route('profile.index') }}" class='sidebar-link'>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('logout-user') }}" class='sidebar-link'
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>Log out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout-user') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
    <!-- Create New Group Modal -->
    <div class="modal fade text-left" id="createGroupAssignmentModal" tabindex="-1" role="dialog"
        aria-labelledby="createGroupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="createGroupLabel">Create New Group</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('lecturer.groups.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Group Name -->
                        <label for="group-name">Group Name:</label>
                        <div class="form-group">
                            <input type="text" id="group-name" name="group_name" placeholder="Enter group name"
                                class="form-control" required>
                        </div>

                        <!-- Select Course Dropdown -->
                        <label for="course">Select Course:</label>
                        <div class="form-group">
                            <select id="course" name="course_id" class="form-control" required>
                                <option value="" disabled selected>-- Select a Course --</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }} ({{ $course->course_code }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unique Code (Generated Automatically) -->
                        <label for="unique-code">Unique Code:</label>
                        <div class="form-group">
                            <input type="text" id="unique-code" name="unique_code" class="form-control"
                                value="{{ strtoupper(Str::random(8)) }}" readonly>
                        </div>
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


     <!-- Join Group Modal -->
     <div class="modal fade text-left" id="joinGroupModal" tabindex="-1" role="dialog"
     aria-labelledby="joinGroupLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="joinGroupLabel">Join Group</h4>
                 <button type="button" class="close" data-bs-dismiss="modal"
                     aria-label="Close">
                     <i data-feather="x"></i>
                 </button>
             </div>
             <form action="{{ route('student.groups.join') }}" method="POST">
                 @csrf
                 <div class="modal-body">
                     <!-- Unique Code -->
                     <label for="unique-code">Enter Group Code:</label>
                     <div class="form-group">
                         <input type="text" id="unique-code" name="unique_code"
                             placeholder="Enter unique code" class="form-control" required>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-light-secondary"
                         data-bs-dismiss="modal">
                         <i class="bx bx-x d-block d-sm-none"></i>
                         <span class="d-none d-sm-block">Close</span>
                     </button>
                     <button type="submit" class="btn btn-primary ml-1">
                         <i class="bx bx-check d-block d-sm-none"></i>
                         <span class="d-none d-sm-block">Join Group</span>
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
</div>
