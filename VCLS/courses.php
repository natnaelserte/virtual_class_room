<?php
// Assuming your standard header is included here or structure is consistent
// For this page, we will use the consistent navbar as requested
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Courses - Kanenus College VC</title>
    <!-- Keep your existing stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
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
            background-color: #f8f9fa; /* Light background for the body */
            color: #333; /* Default text color */
        }

        /* Navbar styling - KEEP AS IS */
        .navbar {
            background-color: #003366;
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


        /* --- New CSS for Course Listing Page Body --- */

        /* Page Title Section */
        .page-title-section {
            background-color: #e9ecef; /* Light grey background */
            padding: 40px 5%; /* Adjust padding as needed */
            text-align: center;
        }

        .page-title-section h1 {
            font-size: 2.5em;
            color: #003366; /* Your brand primary color */
            margin-bottom: 10px;
            font-weight: 700;
        }

         .page-title-section p {
             font-size: 1.1em;
             color: #555;
             margin-bottom: 0;
         }

         /* Container for content sections */
         .container {
             max-width: 1200px;
             margin: 0 auto;
             padding: 0 15px; /* Add horizontal padding */
         }


        /* Department Section */
        .department-section {
            padding: 60px 0; /* Vertical padding */
             /* Optional: Add a visual separator between departments if needed */
             /* border-bottom: 1px solid #ddd; */
        }

        .department-section:last-child {
             border-bottom: none; /* Remove border from last department */
             padding-bottom: 80px; /* Add more space below the last department */
        }


        .department-section h2 {
            font-size: 2em;
            color: #003366; /* Your brand primary color */
            margin-top: 0;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center; /* Center department heading */
        }

        /* Course Grid */
        .course-grid {
            display: grid;
            /* Responsive grid: 3 columns on large, wrap below */
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px; /* Space between cards */
            /* Max width handled by parent .container */
        }

        /* Course Card */
        .course-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden; /* Ensure image/content respects border-radius */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* Subtle shadow */
            display: flex; /* Use flexbox for vertical layout */
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animation on hover */
            text-decoration: none; /* Remove underline from link */
            color: inherit; /* Inherit text color */
        }

        .course-card:hover {
            transform: translateY(-5px); /* Lift effect */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12); /* Enhanced shadow */
        }

        .card-image {
            background-color: #3e5a75; /* Dark blue-grey from example image */
            height: 120px; /* Fixed height for the image area */
            display: flex;
            flex-direction: column; /* Stack icon and logo text */
            justify-content: center;
            align-items: center;
            padding: 15px;
            text-align: center;
            /* If you have different images per course, replace the background-color and flex properties with an <img> tag */
             /* Example if using images: */
             /* position: relative; */
             /* img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; } */
             /* .icon, .logo-text { position: relative; z-index: 1; } */
             /* You might add an overlay to the image like the hero if needed */
        }

         .card-image .icon {
             font-size: 3.5em; /* Size of the graduation cap icon */
             color: #ff8c00; /* Orange color from example image */
             margin-bottom: 5px;
         }

         .card-image .logo-text {
             font-size: 1.1em;
             font-weight: 600;
             color: white; /* White text */
         }


        .card-content {
            padding: 20px;
            flex-grow: 1; /* Allow content area to take remaining space */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Push the 'Courses' text to the bottom */
        }

        .card-content h3 {
            font-size: 1.1em;
            color: #003366; /* Your brand primary color */
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 600;
            line-height: 1.4;
        }

        .card-content .description {
            font-size: 0.9em;
            color: #555;
            line-height: 1.5;
            margin-bottom: 15px;
        }

         .card-content .category {
             font-size: 0.85em;
             color: #777;
             text-transform: uppercase;
             font-weight: 500;
             margin-top: 15px; /* Space above */
             align-self: flex-end; /* Align category to the bottom right */
         }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-title-section {
                padding: 30px 15px;
            }
            .page-title-section h1 {
                font-size: 2em;
            }
             .page-title-section p {
                 font-size: 1em;
             }

            .department-section {
                padding: 40px 0;
            }

            .department-section h2 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }

            .course-grid {
                 gap: 20px; /* Slightly less gap on smaller screens */
                 grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Adjust min-width if needed */
             }

             .card-image {
                 height: 100px; /* Slightly smaller image area */
             }

             .card-image .icon {
                 font-size: 3em;
             }

             .card-content {
                 padding: 15px;
             }

             .card-content h3 {
                 font-size: 1em;
             }

             .card-content .description {
                 font-size: 0.85em;
             }
        }

        @media (max-width: 480px) {
             .page-title-section h1 {
                 font-size: 1.8em;
             }
             .department-section h2 {
                 font-size: 1.5em;
             }
             .course-grid {
                 grid-template-columns: 1fr; /* Stack cards on very small screens */
             }

             .card-image {
                 height: 80px;
             }
             .card-image .icon {
                 font-size: 2.5em;
             }
        }

        /* --- END New CSS for Course Listing Page Body --- */

    </style>
</head>
<body>

<!-- Keep your existing Fixed Navbar - DO NOT TOUCH -->
<nav class="navbar">
    <div class="navbar-brand">
        <a href="index.php">Kanenus College VC</a> <!-- Keep your site title -->
    </div>
    <div class="navbar-links">
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
        <a href="courses.php" class="active">Courses</a> <!-- Added link for this page -->
    </div>
</nav>
<!-- End of existing Navbar -->

<!-- Page Title Section -->
<section class="page-title-section">
    <div class="container">
        <h1>Explore Our Courses</h1>
        <p>Browse the training packages available at Kanenus College Virtual Classroom.</p>
    </div>
</section>

<!-- Main Content Area for Departments and Courses -->
<main class="course-page-content">

    <!-- Department: Technology & IT -->
    <section class="department-section">
        <div class="container">
            <h2>Technology & IT Department</h2>
            <div class="course-grid">
                <!-- Sample Course Card 1.1 -->
                <a href="#" class="course-card"> <!-- Use <a> for clickable card -->
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div> <!-- Graduation Cap Icon -->
                         <div class="logo-text">Kanenus College VC</div> <!-- Your site name/logo text -->
                    </div>
                    <div class="card-content">
                        <div>
                            <h3>Introduction to Web Development</h3>
                            <p class="description">Learn the fundamentals of HTML, CSS, and JavaScript to build your first websites.</p>
                        </div>
                        <p class="category">Courses</p> <!-- Category label -->
                    </div>
                </a>
                <!-- Sample Course Card 1.2 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>PHP & MySQL for Beginners</h3>
                            <p class="description">Understand server-side scripting and database management for dynamic web applications.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 1.3 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Digital Marketing Fundamentals</h3>
                            <p class="description">Explore key concepts in SEO, content marketing, social media, and online advertising.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                <!-- Add more courses in this department -->
            </div>
        </div>
    </section>

     <!-- Department: Business & Management -->
    <section class="department-section">
        <div class="container">
            <h2>Business & Management Department</h2>
            <div class="course-grid">
                 <!-- Sample Course Card 2.1 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Introduction to Financial Accounting</h3>
                            <p class="description">Master the basics of financial statements, reporting, and analysis.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 2.2 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Project Management Essentials</h3>
                            <p class="description">Learn the principles and practices for planning, executing, and closing projects successfully.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 2.3 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Human Resource Management</h3>
                            <p class="description">Understand key HR functions like recruitment, training, performance management, and employee relations.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Add more courses in this department -->
            </div>
        </div>
    </section>

     <!-- Department: Science & Mathematics (New Department 3) -->
    <section class="department-section">
        <div class="container">
            <h2>Science & Mathematics Department</h2>
            <div class="course-grid">
                <!-- Sample Course Card 3.1 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Calculus I</h3>
                            <p class="description">Fundamental concepts of limits, derivatives, integrals, and their applications.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                <!-- Sample Course Card 3.2 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>General Chemistry</h3>
                            <p class="description">Introduction to the basic principles of chemistry, atomic structure, bonding, and reactions.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 3.3 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Physics I: Mechanics</h3>
                            <p class="description">Study of motion, forces, energy, and momentum in physical systems.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Add more courses in this department -->
            </div>
        </div>
    </section>

     <!-- Department: Arts & Humanities (New Department 4) -->
    <section class="department-section">
        <div class="container">
            <h2>Arts & Humanities Department</h2>
            <div class="course-grid">
                 <!-- Sample Course Card 4.1 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Introduction to Literature</h3>
                            <p class="description">Analysis of various literary genres, critical approaches, and major works.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 4.2 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>World History Survey</h3>
                            <p class="description">Overview of major historical events and developments from ancient times to the present.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 4.3 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Foundations of Philosophy</h3>
                            <p class="description">Exploration of fundamental philosophical questions, thinkers, and movements.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Add more courses in this department -->
            </div>
        </div>
    </section>

     <!-- Department: Social Sciences (New Department 5) -->
    <section class="department-section">
        <div class="container">
            <h2>Social Sciences Department</h2>
            <div class="course-grid">
                 <!-- Sample Course Card 5.1 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Introduction to Sociology</h3>
                            <p class="description">Examination of social structures, institutions, and human behavior in groups.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 5.2 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Principles of Psychology</h3>
                            <p class="description">Study of the mind, behavior, and mental processes, including development and disorders.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 5.3 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Introduction to Economics</h3>
                            <p class="description">Basic concepts of microeconomics and macroeconomics, markets, and economic systems.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Add more courses in this department -->
            </div>
        </div>
    </section>

      <!-- Department: Health Sciences (New Department 6 - More than 5 now) -->
    <section class="department-section">
        <div class="container">
            <h2>Health Sciences Department</h2>
            <div class="course-grid">
                 <!-- Sample Course Card 6.1 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Human Anatomy & Physiology I</h3>
                            <p class="description">Study of the structure and function of the human body systems.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 6.2 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Medical Terminology</h3>
                            <p class="description">Learn the language of medicine, including roots, prefixes, and suffixes.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Sample Course Card 6.3 -->
                <a href="#" class="course-card">
                    <div class="card-image">
                         <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                         <div class="logo-text">Kanenus College VC</div>
                    </div>
                    <div class="card-content">
                         <div>
                            <h3>Nutrition Basics</h3>
                            <p class="description">Understanding essential nutrients, dietary guidelines, and healthy eating patterns.</p>
                         </div>
                        <p class="category">Courses</p>
                    </div>
                </a>
                 <!-- Add more courses in this department -->
            </div>
        </div>
    </section>


</main>

<!-- Footer Include - KEEP AS IS -->
<?php require_once 'includes/footer.php'; ?>

</body>
</html>