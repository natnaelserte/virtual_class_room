<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Kanenus College VC</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Keep your existing stylesheet -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
     <!-- Add Font Awesome for icons (Using a later version for more options) -->
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


        /* Footer Styling - KEEP AS IS */
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


        /* --- Enhanced Body Content Styling --- */

        /* Hero section styling - CONSISTENT WITH HOMEPAGE HERO */
        .hero-section {
            height: 400px; /* Keep original height */
            /* Use the same gradient background as the homepage hero */
            background: linear-gradient(to right, #004d99, #003366);
            color: white;
            padding: 80px 20px; /* Use padding consistent with homepage hero */
            text-align: center;
            position: relative;
            overflow: hidden; /* Hide background overflow */
            display: flex; /* Use flexbox to center content */
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Use a pseudo-element for the subtle, filtered background image, consistent with homepage */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* Use your existing hero image */
            background-image: url('hero-background.jpg'); /* Or use 'hero-background.jpg' if you prefer that one */
            background-size: cover;
            background-position: center;
           /* Make the image semi-transparent */
            z-index: 0; /* Behind content */
            /* Apply the same filter as the homepage hero to reduce blue */
      
        }

         /* Remove the separate hero-overlay div, its function is replaced by the gradient + ::before */
        /* .hero-overlay { display: none; } */


        .hero-content {
            position: relative;
            z-index: 2; /* Above the pseudo-element background */
            max-width: 800px;
            padding: 0 20px;
             /* Add initial state for animation */
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.8s ease forwards; /* Animation */
        }

        .hero-subtitle {
            font-size: 1em;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #ffd700; /* Your brand accent color */
            margin-bottom: 10px;
        }

        .hero-title {
            font-size: 3.5em; /* Keep size consistent with homepage hero h1 */
            font-weight: 700;
            margin: 0 0 15px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
        }

        /* Hide the divider if not needed in this hero */
        .hero-divider {
            display: none;
        }

         /* Hide the description if not needed in this hero */
        .hero-description {
            display: none;
        }


        /* Keyframes for hero content animation - KEEP AS IS */
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* Content Section Styling - ENHANCED (FROM PREVIOUS STEP) */
        .contact-content {
            padding: 80px 5%;
            background-color: #f8f9fa; /* Light background */
        }

        .main-contact-area {
            max-width: 1200px;
            margin: 0 auto;
        }

        .info-header {
            text-align: center;
            margin-bottom: 60px;
        }
        .info-header .content-subtitle {
            color: #007bff; /* Standard blue or your brand blue */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        .info-header .content-heading {
            color: #003366; /* Your brand primary color */
            font-size: 2.5em;
            margin: 0;
            font-weight: 700;
        }

        .contact-info-box {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .contact-method {
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-method:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }


        .contact-icon {
            font-size: 2.5em;
            margin-bottom: 15px;
            color: #007bff;
            width: 60px;
            height: 60px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

         .contact-method:hover .contact-icon {
             color: white;
             background-color: #007bff;
         }


        .contact-method h3 {
            color: #003366;
            font-size: 1.4em;
            margin: 0 0 8px;
            font-weight: 600;
        }

        .contact-method p, .contact-method a {
            color: #555;
            margin: 5px 0;
            line-height: 1.6;
            text-decoration: none;
            font-weight: 400;
            transition: color 0.3s ease;
        }

         .contact-method a:hover {
             color: #007bff;
         }


        /* Map Section Styling - ENHANCED (FROM PREVIOUS STEP) */
        .contact-map {
            padding: 60px 5% 80px;
            background-color: white;
            text-align: center;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .map-container h2 {
            color: #003366;
            font-size: 2.5em;
            margin-bottom: 40px;
            font-weight: 700;
        }

        .map-placeholder {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 0;
        }

        .map-image {
            height: 400px;
            background-color: #e9ecef;
            border-radius: 8px;
             /* Keeping the background image, but note it's behind the placeholder content */
            background-image: url('hero-background.jpg'); /* Keep your image */
            background-size: cover;
            background-position: center;
            opacity: 0.5;
            margin-bottom: 0;
        }

        /* Responsive adjustments - KEEP AS IS */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3em;
            }

            .contact-info-box {
                 gap: 20px;
            }

             .contact-method {
                 min-width: 200px;
                 max-width: none;
             }

             .info-header .content-heading {
                 font-size: 2em;
             }

             .map-container h2 {
                 font-size: 2em;
             }

             .map-image {
                 height: 300px;
             }
        }

        @media (max-width: 768px) {
            .hero-section {
                height: 350px;
                padding: 60px 15px; /* Adjust padding for smaller screens */
            }
            .hero-title {
                font-size: 2.5em;
            }

             .contact-content {
                 padding: 60px 15px;
             }

             .contact-info-box {
                 flex-direction: column;
                 padding: 30px;
                 gap: 30px;
             }

             .contact-method {
                 min-width: 95%;
                 padding: 15px 0;
                 border-right: none;
                 border-bottom: 1px solid #eee;
             }
             .contact-method:last-child {
                 border-bottom: none;
             }

             .info-header {
                 margin-bottom: 40px;
             }

             .info-header .content-heading {
                 font-size: 1.8em;
             }

             .contact-map {
                 padding: 40px 15px 60px;
             }

             .map-image {
                 height: 250px;
             }
        }

        @media (max-width: 480px) {
             .hero-section {
                 height: 300px;
                 padding: 40px 10px; /* Adjust padding for smallest screens */
             }
            .hero-title {
                font-size: 2em;
            }
            .hero-subtitle {
                font-size: 0.9em;
            }
        }

        /* --- END Enhanced Body Content Styling --- */

    </style>
</head>
<body>
    <!-- Navbar (separate from hero) - KEEP AS IS -->
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="index.php">Kanenus College VC</a>
        </div>
        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php" class="active">Contact</a>
            <a href="login.php">Login</a>
        </div>
    </nav>

    <!-- Hero Section - CONSISTENT WITH HOMEPAGE HERO -->
    <section class="hero-section">
        <!-- The hero-overlay div is no longer needed with the new background technique -->
        <!-- <div class="hero-overlay"></div> -->
        <div class="hero-content">
            <p class="hero-subtitle">GET IN TOUCH</p>
            <h1 class="hero-title">Contact Our Team</h1>
            <!-- Kept the divider and description commented out as they weren't in the original contact hero -->
            <!-- <div class="hero-divider"></div> -->
            <!-- <p class="hero-description">Find out how to reach us and learn more about Kanenus College.</p> -->
        </div>
    </section>

    <!-- Main Contact Page Content - ENHANCED -->
    <div class="contact-us-page">
        <section class="contact-content">
            <div class="main-contact-area">

                <div class="info-header">
                    <p class="content-subtitle">REACH OUT TO US</p>
                    <h2 class="content-heading">We'd love to hear from you</h2>
                </div>

                <div class="contact-info-box">
                    <div class="contact-method">
                        <!-- Replaced Emoji with Font Awesome Icon -->
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <h3>Email Us</h3>
                        <p>For general inquiries and support:</p>
                        <a href="mailto:admin@kanenuscollege.edu">admin@kanenuscollege.edu</a>
                    </div>
                    <div class="contact-method">
                        <!-- Replaced Emoji with Font Awesome Icon -->
                        <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                        <h3>Call Us</h3>
                        <p>Mon-Fri, 8am-5pm:</p>
                        <p><strong>(123) 456-7890</strong></p>
                    </div>
                    <div class="contact-method">
                         <!-- Replaced Emoji with Font Awesome Icon -->
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h3>Visit Us</h3>
                        <p>Main Administration Building</p>
                        <p>Room 101, Kanenus College</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- Map Section - ENHANCED -->
        <section class="contact-map">
            <div class="map-container">
                <h2>Find Us On Campus</h2>
                <div class="map-placeholder">
                    <div class="map-image">
                        <!-- Potential place for Google Map Embed or similar -->
                        <!-- <iframe src="YOUR_GOOGLE_MAP_EMBED_URL" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- Footer Include - KEEP AS IS -->
<?php require_once 'includes/footer.php'; ?>
</body>
</html>