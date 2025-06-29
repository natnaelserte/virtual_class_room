<?php
require_once '../includes/auth_check.php';
require_role('admin');
$page_title = 'Admin Dashboard';
require_once '../includes/db_connect.php'; 
ob_start();
?>
<!-- Widget Cards -->
<section class="widgets-grid">
    <div class="widget-card">
        <h4>Total Users</h4>
        <p id="total-users">0</p>
    </div>
    <div class="widget-card">
        <h4>Total Sections</h4>
        <p id="total-sections">0</p>
    </div>
    <div class="widget-card">
        <h4>Total Assignments</h4>
        <p id="total-assignments">0</p>
    </div>
    <div class="widget-card">
        <h4>Submissions</h4>
        <p id="total-submissions">0</p>
    </div>
</section>

<!-- Charts Area -->
<section class="charts-grid">
    <div class="chart-card large">
        <h4>Logins (Last 7 Days)</h4>
        <canvas id="loginsChart"></canvas>
    </div>
    <div class="chart-card small">
        <h4>User Demographics</h4>
        <canvas id="genderChart"></canvas>
    </div>
</section>

<!-- THE FIX: Use the official Chart.js CDN link -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Using a relative path which is robust for this file's location.
    fetch('api_reports.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok. Status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error('API Error:', data.error);
                return;
            }
            // Populate Widgets
            document.getElementById('total-users').textContent = data.total_users || 0;
            document.getElementById('total-sections').textContent = data.total_sections || 0;
            document.getElementById('total-assignments').textContent = data.total_assignments || 0;
            document.getElementById('total-submissions').textContent = data.total_submissions || 0;

            // Logins Chart (Area Chart)
            if (data.daily_logins && document.getElementById('loginsChart')) {
                const loginsCtx = document.getElementById('loginsChart').getContext('2d');
                new Chart(loginsCtx, {
                    type: 'line',
                    data: {
                        labels: data.daily_logins.labels.map(date => new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })),
                        datasets: [{
                            label: 'Logins',
                            data: data.daily_logins.data,
                            backgroundColor: 'rgba(0, 51, 102, 0.2)',
                            borderColor: 'rgba(0, 51, 102, 1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: { 
                        maintainAspectRatio: false, 
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } 
                    }
                });
            }

            // Gender Chart (Doughnut Chart)
            if (data.user_gender && document.getElementById('genderChart')) {
                const genderCtx = document.getElementById('genderChart').getContext('2d');
                new Chart(genderCtx, {
                    type: 'doughnut',
                    data: {
                        labels: data.user_gender.labels,
                        datasets: [{
                            data: data.user_gender.data,
                            backgroundColor: ['#00a9ff', '#ff4d6d', '#80ed99', '#6c757d'],
                        }]
                    },
                    options: { 
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error loading dashboard data:', error);
            const chartGrid = document.querySelector('.charts-grid');
            if(chartGrid) {
                chartGrid.innerHTML = `<p style="color:red; text-align:center; width: 100%;">Could not load chart data. Please check the browser console (F12) for errors.</p>`;
            }
        });
});
</script>

<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
?>