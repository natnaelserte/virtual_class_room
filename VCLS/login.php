<?php
session_start();

$success_message = '';
if (isset($_SESSION['registration_success'])) {
    $success_message = $_SESSION['registration_success'];
    unset($_SESSION['registration_success']);
}

if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];
    header("Location: " . $role . "/" . $role . "_dashboard.php");
    exit();
}

require_once 'includes/db_connect.php';
$error_message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password, full_name, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password, $full_name, $role);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['role'] = $role;
            $log_stmt = $conn->prepare("INSERT INTO login_logs (user_id) VALUES (?)");
            $log_stmt->bind_param("i", $id);
            $log_stmt->execute();
            $log_stmt->close();
            header("Location: " . $role . "/" . $role . "_dashboard.php");
            exit();
        } else { $error_message = "Invalid username or password."; }
    } else { $error_message = "Invalid username or password."; }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kanenus College VC</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset and basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }
        
        /* Navbar styling - consistent with contact.php */
        .navbar {
            background-color: #003366;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand a {
            color: white;
            font-size: 1.5em;
            font-weight: 700;
            text-decoration: none;
        }
        
        .navbar-links a {
            color: white;
            font-weight: 500;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.3s;
        }
        
        .navbar-links a.active {
            text-decoration: underline;
        }
        
        .navbar-links a:hover {
            color: #ffd700;
        }
        
        /* Login page specific styles */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 140px); /* Account for header and footer */
            padding: 40px 20px;
        }
        
        .login-page-card {
            display: flex;
            width: 900px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .login-image-section {
            width: 50%;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        
        .login-image-section img {
            max-width: 100%;
            height: auto;
        }
        
        .login-form-section {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-form-header {
            margin-bottom: 30px;
        }
        
        .login-form-header h2 {
            font-size: 2em;
            color: #003366;
            margin: 0;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .input-group label {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
            transition: border-color 0.3s;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #003366;
        }
        
        .btn-login-submit {
            background-color: #003366;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        
        .btn-login-submit:hover {
            background-color: #002244;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
        }
        
        .create-account-link {
            color: #003366;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .create-account-link:hover {
            color: #0056b3;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .message.success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        /* Footer styling - consistent with contact.php */
        footer {
            background-color: #003366;
            text-align: center;
            padding: 20px 0;
            color: white;
            margin-top: 0;
        }
        
        footer p {
            margin: 0;
            font-weight: 500;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .login-page-card {
                width: 100%;
                max-width: 700px;
            }
        }
        
        @media (max-width: 768px) {
            .login-page-card {
                flex-direction: column;
            }
            
            .login-image-section, .login-form-section {
                width: 100%;
            }
            
            .login-image-section {
                padding: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .navbar {
                flex-direction: column;
                align-items: center;
            }
            
            .navbar-brand {
                margin-bottom: 15px;
            }
            
            .navbar-links a {
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar (consistent with contact.php) -->
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="index.php">Kanenus College VC</a>
        </div>
        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="login.php" class="active">Login</a>
        </div>
    </nav>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-page-card">
            <!-- Left Side: Image -->
            <div class="login-image-section">
                <img src="login-illustration.png" alt="Illustration of a person with a laptop">
            </div>

            <!-- Right Side: Form -->
            <div class="login-form-section">
                <div class="login-form-header">
                    <h2>Log In</h2>
                </div>

                <?php if (!empty($error_message)): ?><div class="error-message"><?php echo $error_message; ?></div><?php endif; ?>
                <?php if (!empty($success_message)): ?><div class="message success"><?php echo $success_message; ?></div><?php endif; ?>

                <form action="login.php" method="post">
                    <div class="input-group">
                        <label for="username">Your Name</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn-login-submit">Log In</button>
                </form>

                <!-- Removed the login-footer div with the register.php link -->
            </div>
        </div>
    </div>

    <!-- Footer (consistent with contact.php) -->
    <footer>
        <p>© <?php echo date("Y"); ?> Kanenus College. All Rights Reserved.</p>
    </footer>
</body>
</html>
