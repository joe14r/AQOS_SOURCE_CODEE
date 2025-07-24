<main>
    <section class="modern-admin-dashboard-section">
        <div class="modern-admin-dashboard-metrics">
            <div class="modern-admin-dashboard-metric-card">
                <div class="modern-admin-dashboard-metric-icon"><i class="fas fa-receipt"></i></div>
                <div class="modern-admin-dashboard-metric-label">Total Orders</div>
                <div class="modern-admin-dashboard-metric-value">{{ $totalOrders }}</div>
            </div>
            <div class="modern-admin-dashboard-metric-card">
                <div class="modern-admin-dashboard-metric-icon"><i class="fas fa-calendar-day"></i></div>
                <div class="modern-admin-dashboard-metric-label">New Orders Today</div>
                <div class="modern-admin-dashboard-metric-value">{{ $todayOrders }}</div>
            </div>
            <div class="modern-admin-dashboard-metric-card">
                <div class="modern-admin-dashboard-metric-icon"><i class="fas fa-bolt"></i></div>
                <div class="modern-admin-dashboard-metric-label">Live Orders</div>
                <div class="modern-admin-dashboard-metric-value">{{ $todayNewOrders }}</div>
            </div>
        </div>
        <div class="modern-admin-dashboard-chart-card">
            <div class="modern-admin-dashboard-tabs">
                <button class="modern-admin-dashboard-tablinks active" onclick="openCity(event, 'daily')">Daily</button>
                <button class="modern-admin-dashboard-tablinks" onclick="openCity(event, 'weekly')">Weekly</button>
                <button class="modern-admin-dashboard-tablinks" onclick="openCity(event, 'monthly')">Monthly</button>
            </div>
            <div id="daily" class="modern-admin-dashboard-tabcontent">
                <h3>Daily Data</h3>
                <canvas id="dailyChart" style="width:100%;"></canvas>
            </div>
            <div id="weekly" class="modern-admin-dashboard-tabcontent">
                <h3>Weekly Data</h3>
                <canvas id="weeklyChart" style="width:100%;"></canvas>
            </div>
            <div id="monthly" class="modern-admin-dashboard-tabcontent">
                <h3>Monthly Data</h3>
                <canvas id="monthlyChart" style="width:100%;"></canvas>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("modern-admin-dashboard-tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("modern-admin-dashboard-tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Optionally trigger click on first tab when page loads
document.addEventListener('DOMContentLoaded', function() {
  // Get the first tab button and click it
  document.querySelector('.modern-admin-dashboard-tablinks').click();
});

//DAILY CHART >>>>>>>>>>>>>>>>>>>>>>>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Fetch data via AJAX
    fetch('/admin/chart-data', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Add CSRF token to the header
        }
    })
    .then(response => response.json())
    .then(data => {
        // Create the chart with the response data
        new Chart("dailyChart", {
            type: "line",
            data: {
                labels: data.dates,  // Dynamic labels from AJAX data
                datasets: [{
                    label: "Orders",
                    data: data.orders,  // Dynamic data for Orders
                    borderColor: "red",
                    fill: true
                }, {
                    label: "Sells",
                    data: data.sells,  // Dynamic data for Sells
                    borderColor: "green",
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: true,  // Enable the legend
                    position: 'top',  // Position of the legend
                },
                tooltips: {
                    enabled: true,  // Enable tooltips
                    mode: 'index',  // Show tooltip for the hovered data point
                    intersect: false,  // Tooltip will be shown even if you are hovering between points
                    callbacks: {
                        label: function(tooltipItem, data) {
                            const datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            const value = tooltipItem.yLabel;
                            return datasetLabel + ': ' + value;
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching chart data:', error);
    });

    // Fetch weekly data (last 6 months)
    fetch('/admin/chart-weekly-data', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Add CSRF token to the header
        }
    })
    .then(response => response.json())
    .then(data => {
        // Create the weekly chart with the response data
        new Chart("weeklyChart", {
            type: "line",
            data: {
                labels: data.weeks,  // Dynamic labels from AJAX data (weeks)
                datasets: [{
                    label: "Orders",
                    data: data.orders,  // Dynamic data for Orders (order counts)
                    borderColor: "red",
                    fill: true
                }, {
                    label: "Sells",
                    data: data.sells,  // Dynamic data for Sales (total sales)
                    borderColor: "green",
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: true,  // Enable the legend
                    position: 'top',  // Position of the legend
                },
                tooltips: {
                    enabled: true,  // Enable tooltips
                    mode: 'index',  // Show tooltip for the hovered data point
                    intersect: false,  // Tooltip will be shown even if you are hovering between points
                    callbacks: {
                        label: function(tooltipItem, data) {
                            const datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            const value = tooltipItem.yLabel;
                            return datasetLabel + ': ' + value;
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching weekly chart data:', error);
    });


    // Fetch monthly data (last 1 year)
    fetch('/admin/chart-monthly-data', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Add CSRF token to the header
        }
    })
    .then(response => response.json())
    .then(data => {
        // Create the monthly chart with the response data
        new Chart("monthlyChart", {
            type: "line",
            data: {
                labels: data.months,  // Dynamic labels from AJAX data (months)
                datasets: [{
                    label: "Orders",
                    data: data.orders,  // Dynamic data for Orders (order counts)
                    borderColor: "red",
                    fill: true
                }, {
                    label: "Sells",
                    data: data.sells,  // Dynamic data for Sales (total sales)
                    borderColor: "green",
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: true,  // Enable the legend
                    position: 'top',  // Position of the legend
                },
                tooltips: {
                    enabled: true,  // Enable tooltips
                    mode: 'index',  // Show tooltip for the hovered data point
                    intersect: false,  // Tooltip will be shown even if you are hovering between points
                    callbacks: {
                        label: function(tooltipItem, data) {
                            const datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            const value = tooltipItem.yLabel;
                            return datasetLabel + ': ' + value;
                        }
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching monthly chart data:', error);
    });
</script>
@endpush