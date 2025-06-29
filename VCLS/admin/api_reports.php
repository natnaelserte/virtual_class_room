<?php
// --- API Security & Setup ---
header('Content-Type: application/json');
require_once '../includes/auth_check.php';
require_role('admin');
require_once '../includes/db_connect.php';

/**
 * Executes a query and formats the result for a chart.
 * @param mysqli $conn The database connection object.
 * @param string $sql The SQL query to execute. It must return 'label' and 'data' columns.
 * @return array An array with 'labels' and 'data' keys.
 */
function get_chart_data(mysqli $conn, string $sql): array {
    $chart_data = ['labels' => [], 'data' => []];
    $result = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $chart_data['labels'][] = $row['label'];
            $chart_data['data'][] = (int)$row['data'];
        }
    }
    return $chart_data;
}

// Initialize the main data array
$report_data = ['error' => null];

try {
    // --- 1. Data for Widgets ---
    $report_data['total_users'] = $conn->query("SELECT COUNT(id) AS count FROM users WHERE role != 'admin'")->fetch_assoc()['count'] ?? 0;
    $report_data['total_sections'] = $conn->query("SELECT COUNT(id) AS count FROM sections")->fetch_assoc()['count'] ?? 0;
    $report_data['total_assignments'] = $conn->query("SELECT COUNT(id) AS count FROM assignments")->fetch_assoc()['count'] ?? 0;
    $report_data['total_submissions'] = $conn->query("SELECT COUNT(id) AS count FROM submissions")->fetch_assoc()['count'] ?? 0;

    // --- 2. Data for Logins Chart ---
    $logins_by_day = [];
    for ($i = 6; $i >= 0; $i--) {
        $logins_by_day[date('Y-m-d', strtotime("-$i days"))] = 0;
    }
    $logins_sql = "SELECT DATE(login_time) as login_date, COUNT(id) as login_count FROM login_logs WHERE login_time >= CURDATE() - INTERVAL 6 DAY GROUP BY login_date";
    if ($logins_result = $conn->query($logins_sql)) {
        while ($row = $logins_result->fetch_assoc()) {
            $logins_by_day[$row['login_date']] = (int)$row['login_count'];
        }
    }
    $report_data['daily_logins'] = ['labels' => array_keys($logins_by_day), 'data' => array_values($logins_by_day)];

    // --- 3. Use the helper function for other charts ---
    // Gender Demographics Data
    $gender_sql = "SELECT CONCAT(UPPER(SUBSTRING(COALESCE(gender, 'Not Specified'), 1, 1)), LOWER(SUBSTRING(COALESCE(gender, 'Not Specified'), 2))) AS label, COUNT(id) AS data FROM users WHERE role != 'admin' GROUP BY gender";
    $report_data['user_gender'] = get_chart_data($conn, $gender_sql);

    // User Roles Data - CORRECTED QUERY
    $roles_sql = "SELECT CONCAT(UPPER(SUBSTRING(role, 1, 1)), LOWER(SUBSTRING(role, 2))) AS label, COUNT(id) AS data FROM users WHERE role != 'admin' GROUP BY role";
    $report_data['user_roles'] = get_chart_data($conn, $roles_sql);
    
    // Sections per Department Data
    $depts_sql = "SELECT d.name AS label, COUNT(s.id) AS data FROM departments d LEFT JOIN sections s ON d.id = s.department_id GROUP BY d.id, d.name ORDER BY d.name";
    $report_data['sections_per_department'] = get_chart_data($conn, $depts_sql);

} catch (Exception $e) {
    http_response_code(500);
    $report_data['error'] = 'Database query failed: ' . $e->getMessage();
}

// --- Final Output ---
echo json_encode($report_data);
if ($conn) {
    $conn->close();
}
?>