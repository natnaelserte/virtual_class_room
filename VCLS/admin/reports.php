<?php
$page_title = 'System Reports';
ob_start();
?>
<p>This dashboard provides a visual overview of key metrics within the system.</p>

<div class="charts-grid">
    <!-- Chart 1: User Role Distribution -->
    <div class="chart-card large">
        <h2>User Role Distribution</h2>
        <canvas id="userRolesChart"></canvas>
    </div>

    <!-- Chart 2: Sections per Department -->
    <div class="chart-card large">
        <h2>Sections per Department</h2>
        <canvas id="sectionsPerDepartmentChart"></canvas>
    </div>
</div>

<script src="../assets/js/chart.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('api_reports.php')
        .then(response => response.json())
        .then(data => {
            if(data.error) {
                console.error("API Error:", data.error);
                document.querySelector('.charts-grid').innerHTML = `<p class="message error">Could not load report data.</p>`;
                return;
            }

            // 1. User Roles Pie Chart
            if (data.user_roles) {
                const userRolesCtx = document.getElementById('userRolesChart').getContext('2d');
                new Chart(userRolesCtx, {
                    type: 'pie',
                    data: {
                        labels: data.user_roles.labels,
                        datasets: [{
                            label: '# of Users',
                            data: data.user_roles.data,
                            backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)', 'rgba(255, 206, 86, 0.7)'],
                            borderColor: ['#fff'],
                            borderWidth: 2
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            }

            // 2. Sections per Department Bar Chart
            if (data.sections_per_department) {
                const sectionsCtx = document.getElementById('sectionsPerDepartmentChart').getContext('2d');
                new Chart(sectionsCtx, {
                    type: 'bar',
                    data: {
                        labels: data.sections_per_department.labels,
                        datasets: [{
                            label: '# of Sections',
                            data: data.sections_per_department.data,
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error fetching report data:', error);
            document.querySelector('.charts-grid').innerHTML = '<p class="message error">Could not load report data. Please check the console for details.</p>';
        });
});
</script>

<?php
$page_content = ob_get_clean();
require 'includes/admin_template.php';
?>