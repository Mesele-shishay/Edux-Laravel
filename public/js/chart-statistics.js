
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("studentsPieChart");
var male = $('#Males').val();
var female = $('#Females').val();


// TRANSACTIONS
var myCanvas = document.getElementById("transactions");
if (myCanvas) {
    myCanvas.height = "330";
    var myCanvasContext = myCanvas.getContext("2d");
    var gradientStroke1 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke1.addColorStop(0, 'rgba(108, 95, 252, 0.8)');
    gradientStroke1.addColorStop(1, 'rgba(108, 95, 252, 0.2) ');

    var gradientStroke2 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke2.addColorStop(0, 'rgba(5, 195, 251, 0.8)');
    gradientStroke2.addColorStop(1, 'rgba(5, 195, 251, 0.2) ');
}

if (document.getElementById('transactions')) {
    document.getElementById('transactions').innerHTML = '';
}
var myChart;

var chardDataStudents = JSON.parse($('#chardDataStudents').val());
var chardDataTeachers = JSON.parse($('#chardDataTeachers').val());

var chartKeys = {
    'students' : [],
    'teachers' : [],
};
var chartVals = {
    'students' : [],
    'teachers' : [],
};

Object.entries(chardDataStudents).forEach( entry => {
    const [key, value ] = entry;
    chartKeys['students'].push(key);
    chartVals['students'].push(value);
})

Object.entries(chardDataTeachers).forEach( entry => {
    const [key, value ] = entry;
    chartKeys['teachers'].push(key);
    chartVals['teachers'].push(value);
})


myChart = new Chart(myCanvas, {

    type: 'line',
    data: {
        labels: Object.values(chartKeys.students),
        type: 'line',
        datasets: [{
            label: 'Total Students',
            data: Object.values(chartVals.students),
            backgroundColor: gradientStroke1,
            borderColor: "#05c3fb",
            pointBackgroundColor: '#fff',
            pointHoverBackgroundColor: gradientStroke1,
            pointBorderColor: "#05c3fb",
            pointHoverBorderColor: gradientStroke1,
            pointBorderWidth: 0,
            pointRadius: 0,
            pointHoverRadius: 0,
            borderWidth: 3,
            fill: 'origin',
            lineTension: 0.3
        }, {
            label: 'Total Teachers',
            data: Object.values(chartVals.teachers),
            backgroundColor: 'transparent',
            borderColor: "#05c3fb",
            pointBackgroundColor: '#fff',
            pointHoverBackgroundColor: gradientStroke2,
            pointBorderColor: "#05c3fb",
            pointHoverBorderColor: gradientStroke2,
            pointBorderWidth: 0,
            pointRadius: 0,
            pointHoverRadius: 0,
            borderWidth: 3,
            fill: 'origin',
            lineTension: 0.3

        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
                labels: {
                    usePointStyle: false,
                }
            },
            tooltip: {
                enabled: false
            }
        },
        scales: {
            x: {
                display: true,
                grid: {
                    display: false,
                    drawBorder: false,
                    color: 'rgba(119, 119, 142, 0.08)'
                },
                ticks: {
                    autoSkip: true,
                    color: '#b0bac9'
                },
                scaleLabel: {
                    display: false,
                    labelString: 'Month',
                    fontColor: 'transparent'
                }
            },
            y: {
                ticks: {
                    min: 0,
                    max: 1050,
                    stepSize: 150,
                    color: "#b0bac9",
                },
                display: true,
                grid: {
                    display: true,
                    drawBorder: false,
                    zeroLineColor: 'rgba(142, 156, 173,0.1)',
                    color: "rgba(142, 156, 173,0.1)",
                },
                scaleLabel: {
                    display: false,
                    labelString: 'Students',
                    fontColor: 'transparent'
                }
            }
        },
        title: {
            display: false,
            text: 'Normal Legend'
        }
    }
});



/* Pie Chart*/
var datapie = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
    datasets: [{
        data: [20, 20, 30, 5, 25],
        backgroundColor: ['#6c5ffc', '#05c3fb', '#09ad95', '#1170e4', '#e82646']
    }]
};
var optionpie = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
        display: true,
    },
    animation: {
        animateScale: true,
        animateRotate: true
    }
};

/* Doughbut Chart*/
var ctx6 = document.getElementById('chartPie');
var myPieChart6 = new Chart(ctx6, {
    type: 'doughnut',
    data: datapie,
    options: optionpie
});