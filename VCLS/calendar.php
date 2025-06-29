<?php
require_once 'includes/auth_check.php';
if (!isset($_SESSION['user_id'])) { header("Location: index.php"); exit(); }
$role = $_SESSION['role'];
$page_title = 'My Calendar';

ob_start();
?>
<style>
.calendar-container { height: calc(100vh - 160px); background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
.fc .fc-toolbar-title { font-size: 1.5em; color: #003366; }
.fc .fc-button-primary { background-color: #003366; border-color: #003366; }
.fc .fc-button-primary:hover { background-color: #004080; border-color: #004080; }
.fc .fc-daygrid-day.fc-day-today { background-color: rgba(0, 51, 102, 0.1); }
</style>

<div class="calendar-container">
    <div id="calendar" style="height:100%;"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        height: '100%',
        events: 'api_calendar.php',
        eventClick: function(info) {
            if (info.event.url) {
                window.location.href = info.event.url;
                info.jsEvent.preventDefault();
            }
        }
    });
    calendar.render();
});
</script>

<?php
$page_content = ob_get_clean();
require_once $role . '/includes/' . $role . '_template.php';
?>