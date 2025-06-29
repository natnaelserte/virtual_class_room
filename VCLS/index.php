<?php
// We are NOT using the standard header here because the homepage has a unique layout
// NOTE: User requested to KEEP their existing header structure and styling.
// This code respects that and only changes the body content between the header and footer.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanenus College VC - Homepage</title> <!-- Updated title -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Keep your existing stylesheet -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
     <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* --- Keep your existing Header and Footer CSS --- */
        /* Reset and basic styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            /* Ensure body doesn't have padding-top that conflicts with header */
            padding-top: 0 !important;
            background-color: #f8f9fa; /* Light background for some sections */
            color: #333; /* Default text color */
        }

        /* Fixed Header Styling - Consistent with other pages - KEEP AS IS */
        .navbar {
            background-color: #003366; /* Your header background color */
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative; /* Ensure it's not absolute or fixed */
            width: auto; /* Let it take natural width */
            top: auto; /* Remove any top positioning */
            left: auto; /* Remove any left positioning */
            z-index: 10; /* Keep header on top */
            box-sizing: border-box; /* Include padding in width calculation */
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


        /* Footer Styling - Consistent with header - KEEP AS IS */
        footer {
            background-color: #003366; /* Your footer background color */
            text-align: center;
            padding: 20px 0;
            color: white;
            margin-top: 0; /* Keep footer at the bottom */
            z-index: 10; /* Ensure footer is above other content if needed */
            position: relative; /* Keep footer in normal flow */
        }

        footer p {
            margin: 0;
            font-weight: 500;
        }

        /* --- END Keep your existing Header and Footer CSS --- */


        /* --- New CSS for Body Content --- */

        /* Hero Section Styles - Keep base styles */
        .new-image-hero-section {
            position: relative;
            width: 100%;
            height: 70vh; /* Or a fixed height like 500px */
            background-image: url('hero-background.jpg'); /* Use your image */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 0 5%;
            box-sizing: border-box;
            z-index: 1; /* Ensure it's above other content */
        }

         /* Optional: Add a dark overlay for better text/box contrast */
        .new-image-hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 0; /* Behind content */
        }

        .hero-content-area {
            position: relative;
            z-index: 1; /* Above overlay */
            color: white;
            text-align: left; /* Align text left */
            max-width: 60%; /* Limit text width */
        }

        .hero-content-area h1 {
            font-size: 3em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .hero-content-area p {
            font-size: 1.1em;
            margin-bottom: 20px;
            font-weight: 300;
            line-height: 1.6;
        }

        /* Request Access Box - Keep styling */
        .hero-request-box {
            position: absolute;
            top: 50%; /* Vertically center */
            right: 10%; /* Position from the right */
            transform: translateY(-50%); /* Adjust for height centering */
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            z-index: 2; /* Above hero content */
            width: 300px; /* Fixed width */
            text-align: center; /* Center content inside */
        }

         .hero-request-box h3 {
             font-size: 1.4em;
             margin-top: 0;
             margin-bottom: 15px;
             color: #003366; /* Your brand primary color */
         }

         .hero-request-box p {
             font-size: 1em;
             color: #555;
             margin-bottom: 25px;
             line-height: 1.5;
         }

        .request-buttons a {
            display: block; /* Stack buttons vertically */
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 15px; /* Space between buttons */
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .request-buttons a:last-child {
            margin-bottom: 0; /* No bottom margin on last button */
        }

        .request-buttons .btn-primary {
            background-color: #007bff; /* Standard blue or brand blue */
            color: white;
            border: 1px solid #007bff;
        }

        .request-buttons .btn-primary:hover {
             background-color: #0056b3;
             border-color: #0056b3;
             transform: translateY(-2px);
             box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .request-buttons .btn-secondary {
            background-color: transparent; /* Outlined button */
            color: #003366; /* Your brand primary color */
            border: 1px solid #003366;
        }

         .request-buttons .btn-secondary:hover {
            background-color: #003366;
            color: white;
             transform: translateY(-2px);
             box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
         }


        /* Image + Pyramid/Graph Section - Keep as before */
        .image-pyramid-section {
            background-color: #f8f9fa; /* Light background */
            padding: 60px 5%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px; /* Space between items */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }

        .pyramid-graph {
            flex: 1;
            min-width: 300px; /* Ensure minimum width */
            max-width: 500px; /* Max width for graph */
            text-align: center; /* Center graph content */
        }

        .pyramid-graph h3 {
             font-size: 1.5em;
             color: #333;
             margin-bottom: 30px;
        }
        /* Add specific styling for the pyramid graphic itself if recreating it */

        .marketing-image {
            flex: 1;
            min-width: 300px; /* Ensure minimum width */
            max-width: 500px; /* Max width for image */
        }

        .marketing-image img {
             max-width: 100%;
             height: auto;
             border-radius: 8px; /* Optional: rounded corners */
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Optional: subtle shadow */
        }


        /* Marketing/Support Section - Keep as before */
        .marketing-support-section {
            background-color: #003366; /* Dark blue background */
            color: white;
            padding: 60px 5%;
            text-align: center;
        }

        .marketing-support-section h2 {
            font-size: 2em;
            margin-bottom: 10px;
            font-weight: 700;
        }

         .marketing-support-section .subtitle {
             font-size: 1em;
             color: #ccc;
             margin-bottom: 40px;
         }


        .support-items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid */
            gap: 30px;
            max-width: 1000px; /* Limit grid width */
            margin: 0 auto;
        }

        .support-item {
            text-align: center;
        }

        .support-item .icon {
            font-size: 3em;
            color: #ff8c00; /* Orange icon color */
            margin-bottom: 15px;
        }

        .support-item h3 {
            font-size: 1.2em;
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .support-item p {
            font-size: 0.9em;
            color: #ccc;
            line-height: 1.5;
        }

        /* Contact Methods Section - Keep as before */
        .contact-methods-section {
            background-color: white; /* White background */
            padding: 60px 5%;
            text-align: center;
        }

         .contact-methods-section h2 {
             font-size: 2em;
             margin-bottom: 40px;
             color: #333;
             font-weight: 700;
         }


        .methods-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsive grid */
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .method-item {
            text-align: left; /* Align text left like the image */
            padding: 30px;
            border: 1px solid #eee; /* Subtle border */
            border-radius: 8px;
            background-color: #fefefe; /* Slightly off-white background */
        }

        .method-item .icon {
            font-size: 2em;
            color: #007bff; /* Blue icon color */
            margin-bottom: 15px;
        }

         .method-item h3 {
             font-size: 1.3em;
             color: #333;
             margin-top: 0;
             margin-bottom: 10px;
             font-weight: 600;
         }

         .method-item p {
             font-size: 0.95em;
             color: #555;
             line-height: 1.6;
             margin-bottom: 15px;
         }

         .method-item a {
             color: #ff8c00; /* Orange link color */
             text-decoration: none;
             font-weight: 600;
         }

         .method-item a:hover {
             text-decoration: underline;
         }

         .method-item strong {
             display: block; /* Make phone number block */
             font-size: 1.1em;
             color: #333;
             margin-top: 10px;
         }


        /* Call to Action Section - Link updated */
        .cta-section {
            background-color: #e9ecef; /* Light grey background */
            padding: 80px 5%; /* Ample padding */
            text-align: center;
        }

        .cta-content {
            max-width: 800px; /* Limit width */
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2.5em;
            color: #003366; /* Your brand primary color */
            margin-bottom: 15px;
            font-weight: 700;
        }

        .cta-content p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .cta-buttons a {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px; /* Pill shape */
            text-decoration: none;
            font-weight: 600;
            margin: 0 10px;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            min-width: 180px; /* Minimum width for buttons */
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .cta-buttons .btn-primary {
            background-color: #007bff; /* Standard blue or brand blue */
            color: white;
            border: 2px solid #007bff;
        }

        .cta-buttons .btn-primary:hover {
             background-color: #0056b3;
             border-color: #0056b3;
             transform: translateY(-3px); /* Lift effect */
             box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .cta-buttons .btn-secondary {
            background-color: transparent; /* Outlined button */
            color: #007bff; /* Blue text */
            border: 2px solid #007bff;
        }

         .cta-buttons .btn-secondary:hover {
             background-color: #007bff; /* Solid background on hover */
             color: white;
             transform: translateY(-3px); /* Lift effect */
             box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
         }


        /* Client Logos Section - Keep as before */
        .client-logos-section {
            background-color: #f8f9fa; /* Light background */
            padding: 60px 5%;
            text-align: center;
        }

        .client-logos-section h2 {
            font-size: 2em;
            margin-bottom: 40px;
            color: #333;
            font-weight: 700;
        }

        .logos-grid {
            display: flex; /* Use flex for a row of logos */
            flex-wrap: wrap; /* Allow wrapping */
            justify-content: center; /* Center logos */
            align-items: center;
            gap: 40px; /* Space between logos */
            max-width: 1000px;
            margin: 0 auto;
        }

        .logo-item img {
            max-height: 50px; /* Limit logo height */
            opacity: 0.7; /* Make logos slightly muted */
            transition: opacity 0.3s ease;
        }

        .logo-item img:hover {
             opacity: 1; /* Full color on hover */
        }


        /* Responsive Adjustments - Keep as before */
        @media (max-width: 992px) {
            .new-image-hero-section {
                 height: 60vh;
            }
             .hero-request-box { /* Adjusted selector */
                right: 5%;
                width: 280px;
                padding: 25px;
             }

             .hero-content-area h1 {
                 font-size: 2.5em;
             }
             .hero-content-area p {
                 font-size: 1em;
             }

             .image-pyramid-section {
                 gap: 30px;
             }

             .pyramid-graph h3, .marketing-support-section h2, .contact-methods-section h2, .cta-content h2, .client-logos-section h2 {
                 font-size: 1.8em;
             }

             .cta-section {
                 padding: 60px 5%;
             }

             .cta-content h2 {
                 font-size: 2em;
             }

             .cta-buttons a {
                 min-width: 160px;
             }
        }

        @media (max-width: 768px) {
             .new-image-hero-section {
                 height: auto; /* Auto height on small screens */
                 padding: 80px 5% 350px; /* Add padding below for box */
                 justify-content: center; /* Center content */
             }
             .hero-content-area {
                 max-width: 100%; /* Full width */
                 text-align: center; /* Center text */
                 margin-bottom: 40px; /* Space below text */
             }
             .hero-request-box { /* Adjusted selector */
                 position: static; /* Remove absolute positioning */
                 transform: none;
                 margin: -300px auto 0; /* Center below hero text, adjust margin-top to pull it up */
                 width: 90%; /* Make box wider */
                 max-width: 350px; /* Max width for box */
                 padding: 20px;
             }

             .image-pyramid-section {
                 flex-direction: column; /* Stack image and pyramid */
             }

             .marketing-support-section, .contact-methods-section, .cta-section, .client-logos-section {
                 padding: 40px 5%;
             }

             .support-items-grid, .methods-grid {
                 grid-template-columns: 1fr; /* Stack items */
             }

             .method-item {
                 text-align: center; /* Center contact method items */
                 padding: 20px;
             }
              .method-item .icon {
                 margin: 0 auto 15px; /* Center icon */
              }
             .method-item p, .method-item a {
                 text-align: center; /* Center text */
             }

             .cta-content h2 {
                 font-size: 1.8em;
             }

             .cta-content p {
                 font-size: 1em;
             }

             .cta-buttons {
                 flex-direction: column; /* Stack buttons */
                 align-items: center;
             }

             .cta-buttons a {
                 margin: 10px 0; /* Space out stacked buttons */
                 width: 80%; /* Make buttons wider */
                 max-width: 250px;
             }


             .logos-grid {
                 gap: 20px; /* Reduced gap */
             }

              .logo-item img {
                  max-height: 40px;
              }
        }

        @media (max-width: 480px) {
            .new-image-hero-section h1 {
                font-size: 2em;
            }
             .new-image-hero-section p {
                 font-size: 0.9em;
             }

             .marketing-support-section h2, .contact-methods-section h2, .cta-content h2, .client-logos-section h2 {
                 font-size: 1.5em;
             }

             .cta-buttons a {
                 min-width: unset; /* Remove min width on smallest screens */
             }
        }

        /* --- END New CSS for Body Content --- */


        /* --- Modal Styles - Keep as before --- */
        .request-modal-overlay {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 100; /* Sit on top of everything else */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.6); /* Black w/ opacity */
            backdrop-filter: blur(5px); /* Optional: blur the background */
            -webkit-backdrop-filter: blur(5px); /* Safari support */
        }

        .request-modal-content {
            background-color: #fefefe; /* White background */
            margin: 10% auto; /* 10% from the top, centered horizontally */
            padding: 30px;
            border-radius: 8px;
            width: 90%; /* Could be more specific, e.g., 400px */
            max-width: 500px; /* Max width for the modal */
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative; /* For close button positioning */
        }

        .request-modal-content h2 {
            text-align: center;
            color: #003366; /* Your brand primary color */
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.8em;
            font-weight: 600;
        }

        .request-modal-content .close-button {
            color: #aaa;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .request-modal-content .close-button:hover,
        .request-modal-content .close-button:focus {
            color: #777;
            text-decoration: none;
            cursor: pointer;
        }

        .request-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .request-form input[type="text"],
        .request-form input[type="email"],
        .request-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            font-size: 1em;
        }

        .request-form textarea {
            min-height: 100px;
            resize: vertical;
        }

        .request-form button[type="submit"] {
            display: block; /* Make button full width */
            width: 100%;
            background-color: #007bff; /* Standard blue or brand blue */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .request-form button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive adjustments for modal */
        @media (max-width: 600px) {
            .request-modal-content {
                margin: 20% auto; /* Adjust margin on smaller screens */
                padding: 20px;
                width: 95%;
            }
        }
        /* --- END Modal Styles --- */


    </style>
</head>
<body>

<!-- Keep your existing Fixed Navbar - DO NOT TOUCH -->
<nav class="navbar">
    <div class="navbar-brand">
        <a href="index.php">Kanenus College VC</a> <!-- Keep your site title -->
    </div>
    <div class="navbar-links">
        <a href="index.php" class="active">Home</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
        <a href="courses.php">Courses</a> <!-- Add or ensure Courses link exists -->
    </div>
</nav>
<!-- End of existing Navbar -->


<!-- New Hero Section (Based on the new image) -->
<section class="new-image-hero-section">
    <!-- Pseudo-element handles the background image and overlay -->
    <div class="hero-content-area">
        <h1>Welcome to Kanenus College Virtual Classroom</h1>
        <p>Your centralized hub for seamless learning, direct communication, and effective collaboration.</p>
        <!-- Add any other prominent text/elements from the left side of the hero -->
    </div>

    <!-- Request Access Box - Keep as before -->
    <div class="hero-request-box">
        <h3>Join the Classroom</h3>
        <p>Ready to start your learning journey? Request access or explore our courses.</p>
        <div class="request-buttons">
            <!-- Add a specific ID to the Request Access button for JavaScript -->
            <a href="#" class="btn-primary" id="requestAccessBtn">Request Access</a>
            <!-- This button is now linked to the courses page -->
            <a href="courses.php" class="btn-secondary">Explore Courses</a>
        </div>
    </div>
</section>
<!-- End of New Hero Section -->

<!-- New Image + Pyramid/Graph Section - Keep as before -->
<section class="image-pyramid-section">
    <div class="pyramid-graph">
        <h3>Our Student Growth Strategy</h3>
        <!-- Placeholder for the Pyramid/Graph graphic -->
        <p>Visualize our tiered approach to student engagement and growth within the virtual classroom environment.</p>
        <!-- You would likely insert an SVG, image, or canvas element here to draw the graphic -->
    </div>
    <div class="marketing-image">
        <!-- Placeholder for the image -->
        <img src="placeholder-student-reading.jpg" alt="Student reading">
         <!-- Replace with an image suitable for your context -->
    </div>
</section>
<!-- End of Image + Pyramid/Graph Section -->


<!-- New Marketing/Support Section - Keep as before -->
<section class="marketing-support-section">
    <h2>Platform Capabilities</h2>
    <p class="subtitle">Everything you need for a successful online learning journey.</p>
    <div class="support-items-grid">
        <div class="support-item">
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div> <!-- Chalkboard icon -->
            <h3>Interactive Lessons</h3>
            <p>Engage with dynamic course content, videos, and live sessions.</p>
        </div>
        <div class="support-item">
             <div class="icon"><i class="fas fa-comments"></i></div> <!-- Comments icon -->
            <h3>Real-time Chat</h3>
            <p>Communicate instantly with teachers and classmates for quick help.</p>
        </div>
        <div class="support-item">
             <div class="icon"><i class="fas fa-tasks"></i></div> <!-- Tasks icon -->
            <h3>Assignment Tracking</h3>
            <p>Submit assignments, receive feedback, and monitor your deadlines.</p>
        </div>
        <div class="support-item">
             <div class="icon"><i class="fas fa-chart-bar"></i></div> <!-- Chart icon -->
            <h3>Progress Analytics</h3>
            <p>View detailed reports on your performance and course completion.</p>
        </div>
    </div>
</section>
<!-- End of Marketing/Support Section -->

<!-- New Contact Methods Section - Keep as before -->
<section class="contact-methods-section">
    <h2>Get In Touch With Us</h2>
    <div class="methods-grid">
        <div class="method-item">
            <div class="icon"><i class="fas fa-headset"></i></div> <!-- Headset icon -->
            <h3>Online Support</h3>
            <p>Work hours: Mon-Fri, 9:00-12:00, 14:00-18:00</p>
            <p>Customer service representative provides real-time messaging.</p>
            <a href="#">Start Chat Now</a> <!-- Placeholder link -->
        </div>
        <div class="method-item">
            <div class="icon"><i class="fas fa-book-open"></i></div> <!-- Book icon -->
            <h3>General Inquiry</h3>
            <p>Submit a question related to courses, enrollment, or platform features.</p>
            <p>We will arrange for a specialist to respond within one working day.</p>
            <a href="#">Submit Inquiry Form</a> <!-- Placeholder link -->
        </div>
        <div class="method-item">
            <div class="icon"><i class="fas fa-phone-alt"></i></div> <!-- Phone icon -->
            <h3>Phone Consultation</h3>
            <p>Nationwide pre-sales and after-sales hotline. For route consultation, please choose online chat, product and service consultation.</p>
            <strong>(123) 456-7890</strong> <!-- Placeholder phone number -->
        </div>
    </div>
</section>
<!-- End of Contact Methods Section -->

<!-- Call to Action Section - Link updated -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to Enhance Your Learning?</h2>
        <p>Join Kanenus College Virtual Classroom today and unlock a world of interactive courses, dedicated support, and seamless communication.</p>
        <div class="cta-buttons">
             <!-- "Sign Up Now" button - Update href as needed, maybe link to your registration page -->
            <a href="login.php" class="btn-primary">Sign Up Now</a>
            <!-- "Explore Courses" button - LINKED TO courses.php -->
            <a href="courses.php" class="btn-secondary">Explore Courses</a>
        </div>
    </div>
</section>
<!-- End of Call to Action Section -->


<!-- Client Logos Section - Keep as before -->
<section class="client-logos-section">
    <h2>They Choose Kanenus College VC</h2> <!-- Adjusted heading -->
    <div class="logos-grid">
        <!-- Replace these 'src' attributes with the actual paths to YOUR client/partner logo images -->
        <div class="logo-item"><img src="assets/images/client-logos/client-logo-companyA.png" alt="Client Logo Company A"></div>
        <div class="logo-item"><img src="assets/images/client-logos/client-logo-companyB.png" alt="Client Logo Company B"></div>
        <div class="logo-item"><img src="assets/images/client-logos/client-logo-companyC.png" alt="Client Logo Company C"></div>
        <div class="logo-item"><img src="assets/images/client-logos/client-logo-companyD.png" alt="Client Logo Company D"></div>
        <div class="logo-item"><img src="assets/images/client-logos/client-logo-companyE.png" alt="Client Logo Company E"></div>
         <!-- Add more logo-item divs with img tags for additional logos -->
         <!-- Example: <div class="logo-item"><img src="assets/images/client-logos/client-logo-companyF.png" alt="Client Logo Company F"></div> -->
    </div>
</section>
<!-- End of Client Logos Section -->


<!-- Keep your existing Standard Footer - DO NOT TOUCH -->
<footer>
    <p>© <?php echo date("Y"); ?> Kanenus College. All Rights Reserved.</p> <!-- Keep your footer text -->
</footer>
<!-- End of existing Footer -->


<!-- Modal Structure - Keep as before -->
<div id="requestAccessModal" class="request-modal-overlay">
    <div class="request-modal-content">
        <span class="close-button">×</span> <!-- Close button -->
        <h2>Request Classroom Access</h2>
        <form class="request-form" action="process_request.php" method="post"> <!-- action="process_request.php" will be where your server-side code handles the form -->
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="student_email">Email Address:</label>
            <input type="email" id="student_email" name="student_email" required>

            <label for="student_id">Student ID (if applicable):</label>
            <input type="text" id="student_id" name="student_id">

             <label for="course_interest">Course(s) of Interest:</label>
            <input type="text" id="course_interest" name="course_interest" placeholder="e.g., Introduction to PHP, Web Design 101">


            <label for="request_message">Your Message/Reason for Request:</label>
            <textarea id="request_message" name="request_message" required></textarea>

            <button type="submit">Submit Request</button>
        </form>
    </div>
</div>
<!-- End of Modal Structure -->


<script>
// --- JavaScript for Modal - Keep as before ---
document.addEventListener('DOMContentLoaded', function() {
    // Get the modal, the button that opens it, and the element that closes it
    var modal = document.getElementById("requestAccessModal");
    var btn = document.getElementById("requestAccessBtn"); // The "Request Access" button in the hero
    var span = document.getElementsByClassName("close-button")[0]; // The close button (x)

    // When the user clicks the button, open the modal
    if (btn) { // Check if the button exists
        btn.onclick = function(event) {
            event.preventDefault(); // Prevent the default anchor link behavior (jumping to #)
            if (modal) { // Check if the modal exists
                modal.style.display = "flex"; // Use flex to help center the content
                 // Optional: Add a class to the body to prevent scrolling
                 // document.body.classList.add('modal-open');
            }
        }
    } else {
        console.error("Request Access button not found!"); // Log an error if the button is missing
    }


    // When the user clicks on <span> (x), close the modal
    if (span) { // Check if the close button exists
        span.onclick = function() {
            if (modal) {
                modal.style.display = "none";
                 // Optional: Remove the class from the body
                 // document.body.classList.remove('modal-open');
            }
        }
    } else {
         console.error("Modal close button not found!"); // Log an error if the close button is missing
    }


    // When the user clicks anywhere outside of the modal content, close it
    window.onclick = function(event) {
        if (event.target == modal) { // If the clicked element is the modal overlay itself
            if (modal) {
                modal.style.display = "none";
                 // Optional: Remove the class from the body
                 // document.body.classList.remove('modal-open');
            }
        }
    }
});
// --- END JavaScript for Modal ---
</script>

</body>
</html>