
    // Function to generate a pie chart
// Function to generate a pie chart
function generatePieChart(canvasId, labels, data ,project_title) {
    const chartData = {
        labels: labels,
        datasets: [{
            label: 'Task Count',
            data: data,
            backgroundColor: [
                '#59498c',
                '#aa96d7',
                '#e296bd',
                '#fda5df'
            ]
            
        }]
    };

    const config = {
        type: 'pie',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                     position: 'top',
                     labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 14
                        }
                    }
                    
                },
                title: {
                    display: true,
                    text: project_title,
                   
                        // This more specific font property overrides the global property
                    font: {
                       size: 20// change piechart title(myo)
                 },
                 color : '#59498c'
                    
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById(canvasId),
        config
    );
}


function generateLineChart(canvasId, labels, data, project_title) {
    const chartData = {
        labels: labels,
        datasets: [{
            // label: 'Done %',
            data: data,
            backgroundColor: [
                '#59498c',
                '#aa96d7',
                '#e296bd',
                '#fda5df'
            ],
            fill: false,
            borderColor: '#9d94b8',
            tension: 0.1
        }]
    };

    const config = {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: project_title
                }
            },
            scales: {
                y: {
                    ticks: {
                        stepSize: 10,
                        // callback: function(value, index, values) {
                        //     const percentage = 10 + index * 10;
                        //     return percentage + '%';
                        // }
                        callback: function(value, index, values) {
                            return value + '%';
                        }
                    }
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById(canvasId),
        config
    );
}




function generateBarChart(canvasId, data) {

    const labels = data.map(item => item.stage);
    const tasks = data.map(item => item.task);

    const chartData = {
        labels: labels,
        datasets: [{
            label: 'Overall Tasks',
            data: tasks,
            // backgroundColor: [
            //   'rgba(255, 99, 132, 0.2)',
            //   'rgba(255, 159, 64, 0.2)',
            //   'rgba(255, 205, 86, 0.2)',
            //   'rgba(75, 192, 192, 0.2)',
            //   'rgba(54, 162, 235, 0.2)',
            //   'rgba(153, 102, 255, 0.2)',
            //   'rgba(201, 203, 207, 0.2)'
            // ],
            // borderColor: [
            //   'rgb(255, 99, 132)',
            //   'rgb(255, 159, 64)',
            //   'rgb(255, 205, 86)',
            //   'rgb(75, 192, 192)',
            //   'rgb(54, 162, 235)',
            //   'rgb(153, 102, 255)',
            //   'rgb(201, 203, 207)'
            // ],

            backgroundColor: [
                '#eb6ccc47',
                '#d290ff42',
                '#a8d5ff6e',
                '#c1ffffa1',

                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
              ],
              borderColor: [
                '#eb6ccc',
                '#c064ff',
                '#8ab6dd',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    
                     labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 18
                        }
                    }
                    
                }
               
            },
            
            scales: {
                y: {
                  beginAtZero: true
                }
              }
        },
    };

    const myChart = new Chart(
        document.getElementById(canvasId),
        config
    );
}




function generateLineChart_for_member(canvasId, labels, data) {
    const chartData = {
        labels: labels,
        datasets: [{
            data: data,
            fill: false,
            borderColor: '#9787b5',
            tension: 0.1
        }]
    };

    Chart.defaults.color = '#725e9d';
    const config = {
        type: 'line',
        data: chartData,
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            },
            beforeDraw: function(c) {
                var chartHeight = c.chart.height;
                var size = chartHeight * 5 / 100;
                c.scales['y-axis-0'].options.ticks.minor.fontSize = size;
            },
            responsive :true,
            maintainAspectRatio : false,
        }
    };

    const myChart = new Chart(
        document.getElementById(canvasId),
        config
    );
}

