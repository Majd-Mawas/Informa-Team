/*
Dashboard Charts for Informa-Team
*/

import ApexCharts from "apexcharts";

// Bar Chart for Model Counts
function initModelCountsChart(statistics) {
    var colors = ["#3073F1", "#0acf97", "#f46a6a", "#f1b44c", "#556ee6", "#34c38f"];
    
    var options = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Count',
            data: [
                statistics.users || 0,
                statistics.products || 0,
                statistics.articles || 0,
                statistics.courses || 0,
                statistics.programs || 0,
                statistics.workshops || 0
            ]
        }],
        colors: colors,
        xaxis: {
            categories: ['Users', 'Products', 'Articles', 'Courses', 'Programs', 'Workshops'],
        },
        yaxis: {
            title: {
                text: 'Count',
                style: {
                    fontWeight: '500',
                },
            }
        },
        grid: {
            borderColor: '#9ca3af20',
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " items"
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#model_counts_chart"),
        options
    );

    chart.render();
}

// Pie Chart for Data Distribution
function initDataDistributionChart(statistics) {
    var colors = ["#34c38f", "#556ee6", "#f46a6a", "#50a5f1", "#f1b44c", "#6c757d"];
    
    // Calculate total for percentage
    const total = (
        statistics.users || 0) + 
        (statistics.products || 0) + 
        (statistics.articles || 0) + 
        (statistics.courses || 0) + 
        (statistics.programs || 0) + 
        (statistics.workshops || 0
    );
    
    var options = {
        chart: {
            height: 320,
            type: 'pie',
        },
        series: [
            statistics.users || 0,
            statistics.products || 0,
            statistics.articles || 0,
            statistics.courses || 0,
            statistics.programs || 0,
            statistics.workshops || 0
        ],
        labels: ["Users", "Products", "Articles", "Courses", "Programs", "Workshops"],
        colors: colors,
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            verticalAlign: 'middle',
            floating: false,
            fontSize: '14px',
            offsetX: 0,
        },
        stroke: {
            colors: ['transparent']
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " items (" + ((val / total) * 100).toFixed(1) + "%)"
                }
            }
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                },
            }
        }]
    }

    var chart = new ApexCharts(
        document.querySelector("#data_distribution_chart"),
        options
    );

    chart.render();
}

// Initialize charts when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Get statistics from the data attribute
    const statisticsElement = document.getElementById('dashboard-statistics');
    if (statisticsElement) {
        const statistics = JSON.parse(statisticsElement.dataset.statistics);
        
        // Initialize charts
        initModelCountsChart(statistics);
        initDataDistributionChart(statistics);
    }
});