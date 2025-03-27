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

                <li class="sidebar-item active ">
                    {{-- To Dashboard --}}
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role === 'student')
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Task Management</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="task.html">Assigments</a>
                        </li>
                    </ul>
                </li>
                @elseif (Auth::user()->role === 'lecturer')
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Create</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a data-bs-toggle="modal" data-bs-target="#createGroupChatModal">New group</a>
                            
                        </li>
                    </ul>
                </li>
                
                @elseif (Auth::user()->role === 'admin')
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>User</span>
                    </a>
                </li>
                @endif
                




                <li class="sidebar-title">Chatroom</li>

                <li class="sidebar-item  ">
                     <a href="chatroom.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Subject 001</span>
                    </a>
                </li>


                <li class="sidebar-item  ">
                    <a href="chatroom.html" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Subject 002</span>

                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="chatroom.html" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Subject 003</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a id="password" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>+ Join Group</span>
                    </a>
                </li>

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