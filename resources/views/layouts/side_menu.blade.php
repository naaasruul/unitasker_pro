{{--  --}}

<div id="sidebar" class="active">
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

                 {{-- Dashboard --}}
<li class="sidebar-item 
    @if (Auth::user()->role === 'admin' && Request::routeIs('admin.dashboard')) active 
    @elseif (Auth::user()->role === 'lecturer' && Request::routeIs('lecturer.dashboard')) active 
    @elseif (Auth::user()->role === 'student' && Request::routeIs('student.dashboard')) active 
    @endif">
    <a href="
        @if (Auth::user()->role === 'admin')
            {{ route('admin.dashboard') }}
        @elseif (Auth::user()->role === 'lecturer')
            {{ route('lecturer.dashboard') }}
        @elseif (Auth::user()->role === 'student')
            {{ route('student.dashboard') }}
        @endif
    " class='sidebar-link'>
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>
</li>

                {{-- Student Menu --}}
                @if (Auth::user()->role === 'student')
                <li class="sidebar-item has-sub {{ Request::routeIs('student.assignment') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Task Management</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ Request::routeIs('student.assignment') ? 'active' : '' }}">
                            <a href="{{ route('student.assignment') }}">Assignments</a>
                        </li>
                    </ul>
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
                            <a data-bs-toggle="modal" data-bs-target="#createGroupChatModal">New Group</a>
                        </li>
                    </ul>
                </li>
                @endif
                
               {{-- Admin Menu --}}
               @if (Auth::user()->role === 'admin')
               <li class="sidebar-item has-sub {{ Request::routeIs('admin.manage-course') ? 'active' : '' }}">
                   <a href="#" class='sidebar-link'>
                       <i class="bi bi-stack"></i>
                       <span>User</span>
                   </a>
                   <ul class="submenu">
                       <li class="submenu-item">
                           <a href="allStudent.html">Students</a>
                       </li>
                       <li class="submenu-item">
                           <a href="allLecturer.html">Lecturers</a>
                       </li>
                       <li class="submenu-item">
                           <a href="performance.html">Performance</a>
                       </li>
                   </ul>
               </li>

               <li class="sidebar-item {{ Request::routeIs('admin.manage-course') ? 'active' : '' }}">
                <a href="{{ route('admin.manage-course') }}" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Manage Course</span>
                </a>
            </li>
            @endif
                



                {{-- Chatroom Section --}}
                @if (Auth::user()->role === 'student' || Auth::user()->role === 'lecturer')
                <li class="sidebar-title">Chatroom</li>

                <li class="sidebar-item {{ Request::is('chatroom/subject-001') ? 'active' : '' }}">
                    <a href="chatroom.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Subject 001</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('chatroom/subject-002') ? 'active' : '' }}">
                    <a href="chatroom.html" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Subject 002</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('chatroom/subject-003') ? 'active' : '' }}">
                    <a href="chatroom.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Subject 003</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a id="password" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>+ Join Group</span>
                    </a>
                </li>
                @endif

                <hr>
                
                    <li class="sidebar-item  ">
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
</div>