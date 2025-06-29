<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Kanenus College VC</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="about-page-body">
    <!-- Header with consistent styling -->
    <nav class="navbar">
        <div class="navbar-brand">
            <a href="index.php">Kanenus College VC</a>
        </div>
        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php" class="active">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
        </div>
    </nav>

    <!-- The main container for our new About Us page styling -->
    <div class="about-us-page">

        <!-- 1. Hero Section with Background Image and Text Overlay -->
        <section class="about-hero">
            <div class="hero-overlay"></div>
            <div class="hero-text">
                <p class="hero-subtitle">ABOUT OUR PLATFORM</p>
                <h1>A Modern Approach to Learning</h1>
                <div class="hero-divider"></div>
                <p class="hero-description">Empowering students and educators through innovative digital solutions</p>
            </div>
        </section>

        <!-- 2. Main Content Section with Two Columns -->
        <section class="about-content">
            <div class="content-grid">
                <!-- Left Column -->
                <div class="content-column">
                    <p class="content-subtitle">WHAT WE STAND FOR</p>
                    <h2 class="content-heading">We are dedicated to modern education.</h2>
                    
                    <div class="mission-vision-box">
                        <div class="mission-icon">🎯</div>
                        <h3>OUR MISSION</h3>
                        <h4>To Create a Seamless Digital Learning Environment</h4>
                        <p>Our goal is to provide a centralized platform where students can easily access course materials, teachers can manage their sections effectively, and administrators can oversee the entire academic ecosystem.</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="content-column">
                    <h2 class="content-heading-alt">Empowering Our College Community</h2>
                    <p>We believe every user deserves a simple, powerful, and efficient tool to make their academic life easier. This platform is designed to reduce confusion and improve communication for everyone at Kanenus College.</p>
                    
                    <div class="mission-vision-box">
                        <div class="mission-icon">✨</div>
                        <h3>OUR KEY FEATURES</h3>
                        <h4>Built with a Focus on Functionality and User Experience</h4>
                        <ul class="features-list">
                            <li><span class="feature-icon">👥</span> Role-based access for Administrators, Teachers, and Students.</li>
                            <li><span class="feature-icon">📝</span> Full assignment and automated quizzing workflows.</li>
                            <li><span class="feature-icon">💬</span> Private messaging and an interactive events calendar.</li>
                            <li><span class="feature-icon">📊</span> An advanced analytics dashboard for administrators.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Team Section (New) -->
        <section class="about-team">
            <div class="team-container">
                <h2 class="team-heading">Meet Our Development Team</h2>
                <p class="team-subheading">The talented individuals behind our virtual classroom platform</p>
                
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-image"></div>
                        <h3>John Doe</h3>
                        <p class="member-role">Lead Developer</p>
                        <p class="member-bio">Experienced full-stack developer with a passion for educational technology.</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image"></div>
                        <h3>Jane Smith</h3>
                        <p class="member-role">UX Designer</p>
                        <p class="member-bio">Creating intuitive and accessible interfaces for all users.</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image"></div>
                        <h3>Michael Johnson</h3>
                        <p class="member-role">Database Architect</p>
                        <p class="member-bio">Building robust and scalable data solutions for educational platforms.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Call to Action (New) -->
        <section class="about-cta">
            <div class="cta-container">
                <h2>Ready to Experience Modern Learning?</h2>
                <p>Join thousands of students and educators already using our platform</p>
                <a href="login.php" class="cta-button">Get Started Today</a>
            </div>
        </section>
    </div>

    <!-- Footer -->
   
<style>
/* About Page Specific Styles */
.about-page-body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    background-color: #fff;
}

/* Header Styling - Consistent with contact.php */
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

.btn-primary-hero {
    background-color: #0275d8;
    padding: 8px 20px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
}

/* Hero Section Styling - Improved clarity */
.about-hero {
    position: relative;
    height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    background-image: url('hero-background.jpg');
    background-size: cover;
    background-position: center;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 51, 102, 0.3); /* Consistent with contact.php */
}

.hero-text {
    position: relative;
    z-index: 10;
    max-width: 800px;
    padding: 0 20px;
}

.hero-subtitle {
    font-size: 1em;
    font-weight: 600;
    letter-spacing: 3px;
    color: #ffd700; /* Bright gold color consistent with contact.php */
    margin-bottom: 10px;
}

.hero-text h1 {
    font-size: 3.5em;
    margin: 10px 0;
    font-weight: 700;
    line-height: 1.2;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Add shadow for better readability */
}

.hero-divider {
    width: 80px;
    height: 4px;
    background-color: #ffd700; /* Bright gold color */
    margin: 25px auto;
}

.hero-description {
    font-size: 1.2em;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5); /* Add shadow for better readability */
}

/* Content Section Styling */
.about-content {
    background-color: #f8f9fa;
    padding: 100px 5%;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto;
}

.content-subtitle {
    color: #003366;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.9em;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.content-heading {
    color: #003366;
    font-size: 2.5em;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 30px;
    line-height: 1.2;
}

.content-heading-alt {
    color: #003366;
    font-size: 2em;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 20px;
}

.content-column p {
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
}

.mission-vision-box {
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    margin-top: 20px;
    transition: transform 0.3s ease;
}

.mission-vision-box:hover {
    transform: translateY(-5px);
}

.mission-icon {
    font-size: 2.5em;
    margin-bottom: 15px;
}

.mission-vision-box h3 {
    font-size: 0.9em;
    color: #003366;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 0;
    margin-bottom: 10px;
    font-weight: 600;
}

.mission-vision-box h4 {
    color: #003366;
    font-size: 1.4em;
    margin-top: 0;
    margin-bottom: 15px;
    font-weight: 600;
}

.mission-vision-box p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 0;
}

.features-list {
    padding-left: 0;
    list-style-type: none;
}

.features-list li {
    padding: 10px 0;
    display: flex;
    align-items: center;
    color: #555;
    line-height: 1.6;
}

.feature-icon {
    margin-right: 15px;
    font-size: 1.2em;
}

/* Team Section Styling */
.about-team {
    padding: 100px 5%;
    background-color: white;
}

.team-container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.team-heading {
    color: #003366;
    font-size: 2.5em;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 15px;
}

.team-subheading {
    color: #555;
    font-size: 1.2em;
    max-width: 600px;
    margin: 0 auto 50px;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
}

.team-member {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    transition: transform 0.3s ease;
}

.team-member:hover {
    transform: translateY(-10px);
}

.member-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto 20px;
    background-image: url('hero-background.jpg');
    background-size: cover;
    background-position: center;
}

.team-member h3 {
    color: #003366;
    font-size: 1.3em;
    margin-top: 0;
    margin-bottom: 5px;
}

.member-role {
    color: #003366;
    font-weight: 600;
    margin-top: 0;
    margin-bottom: 15px;
}

.member-bio {
    color: #555;
    line-height: 1.6;
    margin: 0;
}

/* Call to Action Styling */
.about-cta {
    background-color: transparent;
    color: white;
    padding: 80px 5%;
    text-align: center;
    background-image: url('hero-background.jpg');
    background-size: cover;
    background-position: center;
    position: relative;
}

.about-cta::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Simple dark overlay */
    z-index: 1;
}

.cta-container {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.about-cta h2 {
    font-size: 2.5em;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 15px;
}

.about-cta p {
    font-size: 1.2em;
    margin-bottom: 30px;
    opacity: 0.9;
}

.cta-button {
    display: inline-block;
    background-color: #ffd700;
    color: #003366;
    font-weight: 600;
    padding: 15px 30px;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1.1em;
}

.cta-button:hover {
    background-color: white;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

/* Footer Styling - Consistent with header */
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

/* Responsive Adjustments */
@media (max-width: 992px) {
    .content-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .hero-text h1 {
        font-size: 2.8em;
    }
    
    .about-hero {
        height: 60vh;
    }
}

@media (max-width: 768px) {
    .hero-text h1 {
        font-size: 2.2em;
    }
    
    .content-heading {
        font-size: 2em;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .about-cta h2 {
        font-size: 2em;
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
    
    .hero-text h1 {
        font-size: 1.8em;
    }
    
    .about-hero {
        height: 50vh;
    }
}
</style>

</body>
<?php require_once 'includes/footer.php'; ?>
