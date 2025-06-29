<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$unread_count = 0;
if (isset($_SESSION['user_id'])) {
    // This requires the full path to db_connect.php to work reliably from any page.
    require_once __DIR__ . '/db_connect.php'; 
    $user_id_for_messages = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("SELECT COUNT(id) AS unread_count FROM messages WHERE receiver_id = ? AND is_read = FALSE");
    $stmt->bind_param("i", $user_id_for_messages);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $unread_count = $result['unread_count'] ?? 0;
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanenus College Virtual Class</title>
    
    <!-- Link to our custom stylesheet -->
    <link rel="stylesheet" href="http://localhost/virtual_class/assets/css/style.css">
    
    <!-- NEW & CORRECTED: Direct CDN link for FullCalendar's JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="http://localhost/virtual_class/index.php">Kanenus College VC</a>
            </div>
            <div class="navbar-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Links for LOGGED IN users -->
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!</span>
                    <a href="http://localhost/virtual_class/messages.php" class="btn-messages">
                        Messages
                        <?php if ($unread_count > 0): ?>
                            <span class="notification-badge"><?php echo $unread_count; ?></span>
                        <?php endif; ?>
                    </a>
                    <a href="http://localhost/virtual_class/calendar.php" class="btn-calendar">Calendar</a>
                    <a href="http://localhost/virtual_class/profile.php" class="btn-profile">My Profile</a>
                    <a href="http://localhost/virtual_class/logout.php" class="btn-logout">Logout</a>
                <?php else: ?>
                    <!-- Links for PUBLIC visitors -->
                    <a href="http://localhost/virtual_class/index.php">Home</a>
                    <a href="http://localhost/virtual_class/about.php">About Us</a>
                    <a href="http://localhost/virtual_class/contact.php">Contact</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="container">