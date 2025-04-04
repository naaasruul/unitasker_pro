@include('user_header_footer.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="main">
    @include('layouts.side_menu')
    <div class="page-heading">
        <div class="page-title">
            <h3>Welcome {{ Auth::user()->name }}!</h3>
        </div>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <main class="calendar-contain">
                            {{-- Sidebar for Personal To-Do List --}}
                            <aside class="calendar__sidebar">
                                <div class="sidebar__nav">
                                    <!-- Button to Open Modal -->
                                    <button class="btn btn-primary" id="addTaskButton" data-bs-toggle="modal"
                                        data-bs-target="#addTaskModal">
                                        <i class="bi bi-plus-circle"></i> Add Task
                                    </button>
                                </div>

                                {{-- Current Date --}}
                                <h2 class="sidebar__heading" id="currentDate"></h2>

                                {{-- To-Do List --}}
                                <ul class="sidebar__list" id="todoList">
                                    <!-- Tasks will be dynamically populated here -->
                                </ul>
                            </aside>

                            {{-- Calendar Section --}}
                            <section class="calendar__days">
                                <section class="calendar__top-bar">
                                    <span class="top-bar__days">Mon</span>
                                    <span class="top-bar__days">Tue</span>
                                    <span class="top-bar__days">Wed</span>
                                    <span class="top-bar__days">Thu</span>
                                    <span class="top-bar__days">Fri</span>
                                    <span class="top-bar__days">Sat</span>
                                    <span class="top-bar__days">Sun</span>
                                </section>

                                <section class="calendar__weeks" id="calendarWeeks">
                                    <!-- Calendar days will be dynamically populated here -->
                                </section>
                            </section>
                        </main>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

{{-- Add Task Modal --}}
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addTaskForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="taskName" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="taskName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Task Description</label>
                        <textarea class="form-control" id="taskDescription" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="taskDate" class="form-label">Task Date</label>
                        <input type="date" class="form-control" id="taskDate" name="date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('user_header_footer.footer')

<script>
    $(document).ready(function () {
        const currentDateElement = $('#currentDate');
        const todoListElement = $('#todoList');
        const calendarWeeksElement = $('#calendarWeeks');

        const today = new Date();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();

        // Display current date in the sidebar
        const options = { weekday: 'long', month: 'long', day: 'numeric' };
        currentDateElement.text(today.toLocaleDateString('en-US', options));

        // Fetch tasks for the selected date
        function fetchTasksByDate(date) {
            $.get('{{ route('tasks.by-date') }}', { date }, function (tasks) {
                todoListElement.empty();
                if (tasks.length > 0) {
                    tasks.forEach(task => {
                        const listItem = $(`
                            <li class="sidebar__list-item ${task.is_completed ? 'sidebar__list-item--complete' : ''}">
                                <span class="list-item__time">${task.name}</span> ${task.description || ''}
                            </li>
                        `);
                        todoListElement.append(listItem);
                    });
                } else {
                    todoListElement.append('<li class="sidebar__list-item">No tasks for this date.</li>');
                }
            });
        }

        // Fetch task counts for the calendar
        function fetchTaskCounts() {
            $.get('{{ route('tasks.counts') }}', function (taskCounts) {
                generateCalendar(currentMonth, currentYear, taskCounts);
            });
        }

        // Generate calendar days dynamically
        function generateCalendar(month, year, taskCounts = []) {
            calendarWeeksElement.empty();

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let date = 1;

            for (let i = 0; i < 6; i++) {
                const weekRow = $('<section class="calendar__week"></section>');

                for (let j = 0; j < 7; j++) {
                    const dayCell = $('<div class="calendar__day"></div>');

                    if (i === 0 && j < firstDay) {
                        dayCell.addClass('inactive');
                    } else if (date > daysInMonth) {
                        dayCell.addClass('inactive');
                    } else {
                        const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                        const taskCount = taskCounts.find(tc => tc.date === fullDate)?.count || 0;

                        dayCell.html(`<span class="calendar__date">${date}</span>`);
                        if (taskCount > 0) {
                            dayCell.append(`<span class="calendar__task">${taskCount} tasks</span>`);
                        }

                        if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                            dayCell.addClass('today');
                        }

                        dayCell.on('click', function () {
                            fetchTasksByDate(fullDate);
                        });

                        date++;
                    }

                    weekRow.append(dayCell);
                }

                calendarWeeksElement.append(weekRow);

                if (date > daysInMonth) {
                    break;
                }
            }
        }

                $('#addTaskForm').on('submit', function (e) {
            e.preventDefault();
        
            const formData = $(this).serialize();
        
            $.ajax({
                url: '{{ route('tasks.store') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $('#addTaskModal').modal('hide');
                        fetchTaskCounts();
                    }
                },
                error: function (xhr) {
                    alert('An error occurred while adding the task. Please try again.');
                }
            });
        });

        // Initialize the calendar and fetch task counts
        fetchTaskCounts();
    });
</script>