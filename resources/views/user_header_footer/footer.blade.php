

<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/extensions/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="{{ asset('assets/js/extensions/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ui-chartjs.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Default view
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [ // Sample events
                {
                    title: 'Math Exam',
                    start: '2025-01-10',
                },
                {
                    title: 'Project Deadline',
                    start: '2025-01-15',
                    end: '2025-01-16',
                },
                {
                    title: 'Group Meeting',
                    start: '2025-01-20T14:30:00',
                }
            ]
        });

        calendar.render();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Default view
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [ // Sample events
                {
                    title: 'Math Exam',
                    start: '2025-01-10',
                },
                {
                    title: 'Project Deadline',
                    start: '2025-01-15',
                    end: '2025-01-16',
                },
                {
                    title: 'Group Meeting',
                    start: '2025-01-20T14:30:00',
                }
            ]
        });

        calendar.render();
    });
</script>

<script>
    // Function to print specific report
function printReport(elementId) {
console.log('triggered');
var content = document.getElementById(elementId);

// Print the current page
window.print();
}
</script>

</body>

</html>