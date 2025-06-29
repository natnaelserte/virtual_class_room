<?php
// Ensure this script is accessed via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and basic sanitization of form data
    $fullName = htmlspecialchars(trim($_POST['full_name']));
    $studentEmail = htmlspecialchars(trim($_POST['student_email']));
    $studentId = htmlspecialchars(trim($_POST['student_id']));
    $courseInterest = htmlspecialchars(trim($_POST['course_interest']));
    $requestMessage = htmlspecialchars(trim($_POST['request_message']));

    // --- Server-side Validation (Add more as needed) ---
    if (empty($fullName) || empty($studentEmail) || empty($requestMessage)) {
        // Handle validation error (e.g., redirect back with an error message)
        header("Location: index.php?status=error&message=Please fill in all required fields.");
        exit;
    }

    if (!filter_var($studentEmail, FILTER_VALIDATE_EMAIL)) {
         // Handle invalid email format error
        header("Location: index.php?status=error&message=Invalid email format.");
        exit;
    }
    // --- End Validation ---


    // Define recipient email addresses
    $adminEmail = 'your_admin_email@yourcollege.edu'; // <-- CHANGE THIS to the actual admin email
    $teacherEmail = 'the_teacher_email@yourcollege.edu'; // <-- CHANGE THIS to the actual teacher email

    // Subject for the email
    $subject = "New Classroom Access Request from " . $fullName;

    // Email body content
    $emailBody = "You have received a new classroom access request:\n\n";
    $emailBody .= "Full Name: " . $fullName . "\n";
    $emailBody .= "Email Address: " . $studentEmail . "\n";
    $emailBody .= "Student ID: " . ($studentId ?: 'Not provided') . "\n"; // Show 'Not provided' if empty
    $emailBody .= "Course(s) of Interest: " . ($courseInterest ?: 'Not specified') . "\n\n"; // Show 'Not specified' if empty
    $emailBody .= "Message:\n" . $requestMessage . "\n";

    // Email headers
    // IMPORTANT: For security, you must sanitize or disallow newlines in headers
    // The htmlspecialchars() above helps, but for 'From' and 'Reply-To',
    // specifically preventing newline injection is crucial.
    // A safer approach uses dedicated libraries or mail services.
    $headers = "From: Kanenus College VC <noreply@yourcollege.edu>\r\n"; // Change noreply@... to a valid sender email if needed
    $headers .= "Reply-To: " . $studentEmail . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";


    // --- Send Email to Admin ---
    // mail($adminEmail, $subject, $emailBody, $headers); // Uncomment this line to send email to admin

    // --- Send Email to Teacher ---
    // mail($teacherEmail, $subject, $emailBody, $headers); // Uncomment this line to send email to teacher

    // You would typically add error handling here to check if mail() returned true/false
    // However, mail() returning true doesn't guarantee delivery.

    // --- Optional: Save to Database ---
    // Include database connection code here
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    // if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
    // Prepare and execute SQL query to insert request into a table
    // $sql = "INSERT INTO access_requests (full_name, email, student_id, course_interest, message) VALUES (?, ?, ?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("sssss", $fullName, $studentEmail, $studentId, $courseInterest, $requestMessage);
    // $stmt->execute();
    // $stmt->close();
    // $conn->close();
    // --- End Save to Database ---


    // Redirect the user to a success page or the homepage with a success message
    header("Location: index.php?status=success&message=Your request has been submitted successfully.");
    exit;

} else {
    // If accessed directly (not via POST), redirect to homepage
    header("Location: index.php");
    exit;
}
?>