var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    info: '#41B1F9',
    blue: '#3245D1',
    purple: 'rgb(153, 102, 255)',
    grey: '#EBEFF6'
};

// Use the dynamic data passed from the backend
var studentBar = document.getElementById("student_bar").getContext("2d");

// Labels and data are dynamically passed from the backend
var myBar = new Chart(studentBar, {
    type: 'bar',
    data: {
        labels: labels, // Use the labels array from the Blade view
        datasets: [{
            label: 'Students',
            backgroundColor: labels.map((_, index) => {
                // Dynamically assign colors based on the index
                return index % 2 === 0 ? chartColors.info : chartColors.blue;
            }),
            data: studentData // Use the data array from the Blade view
        }]
    },
    options: {
        responsive: true,
        barRoundness: 1,
        title: {
            display: true,
            text: "Students Registered Per Month"
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    padding: 10,
                },
                gridLines: {
                    drawBorder: false,
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false
                }
            }]
        }
    }
});


// Use the dynamic data passed from the backend
var lecturerBar = document.getElementById("lecturer_bar").getContext("2d");
// Labels and data are dynamically passed from the backend
var myBar = new Chart(lecturerBar, {
    type: 'bar',
    data: {
        labels: labels, // Use the labels array from the Blade view
        datasets: [{
            label: 'Lecturers',
            backgroundColor: labels.map((_, index) => {
                // Dynamically assign colors based on the index
                return index % 2 === 0 ? chartColors.red
                 : chartColors.orange;
            }),
            data: lecturerData // Use the data array from the Blade view
        }]
    },
    options: {
        responsive: true,
        barRoundness: 1,
        title: {
            display: true,
            text: "Lecturers Registered Per Month"
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    padding: 10,
                },
                gridLines: {
                    drawBorder: false,
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false
                }
            }]
        }
    }
});

