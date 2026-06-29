<?php
// Database config
$host = "localhost";
$user = "root";
$password = ""; // your DB password
$dbname = "user_auth";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the latest user (based on highest ID or latest timestamp)
$sql = "SELECT username, email FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestUsername = "No users found.";
$latestEmail = "";
session_start();

// Get username from session
if (isset($_SESSION['username'])) {
    $latestUsername = $_SESSION['username'];
} else {
    $latestUsername = "Guest"; // default if not logged in
}

// If you also stored email in session during signup/login
if (isset($_SESSION['email'])) {
    $latestEmail = $_SESSION['email'];
} else {
    $latestEmail = "No email"; // default if not logged in
}
// Simulated database values — no DB connection used

// This mimics the structure of your original code safely
$result = true; // pretend the query worked
if ($result === false) {
    echo "Database query failed: Simulation error.";
} else {
    // pretend we got user data
    $row = [
        'username' => $latestUsername,
        'email' => $latestEmail
    ];
    $latestUsername = $row['username'];
    $latestEmail = $row['email'];
}
$user = $latestUsername;

$sql = "SELECT email FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $latestEmail = $row['email']; // store email in a variable
}
// Fetch profile data from database
$about_me = "I am a passionate web developer with 5 years of experience in creating responsive and user-friendly websites. I love learning new technologies and improving my skills.";
$skills = "HTML, CSS, JavaScript";
$education = "Bachelor of Science in Computer Science - New York University (2015-2019)\nMaster of Science in Web Development - Columbia University (2019-2021)";

// Query to get user profile details
$sql = "SELECT about_me, skills, education FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $latestUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['about_me'])) $about_me = $row['about_me'];
    if (!empty($row['skills'])) $skills = $row['skills'];
    if (!empty($row['education'])) $education = $row['education'];
}


$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn Dashboard</title>
    <link rel="stylesheet" href="dashbord.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="logo">
                <h2>Eduix</h2>
            </div>
            <div class="profile-brief">
                <div class="profile-image">
                    <img src="images/profile.jpg" alt="Profile Image">
                </div>
                <h3><?php echo htmlspecialchars($latestUsername); ?></h3>
                <p>Web Developer</p>
            </div>
            <ul class="nav-links">
                <li class="nav-item active" data-target="dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </li>
                <li class="nav-item" data-target="profile">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </li>
                <li class="nav-item" data-target="courses">
                    <i class="fas fa-book"></i>
                    <span>Courses</span>
                </li>
                <li class="nav-item" data-target="certifications">
                    <i class="fas fa-certificate"></i>
                    <span>Certifications</span>
                </li>
                <li class="nav-item" data-target="feedback">
                    <i class="fas fa-comment"></i>
                    <span>Feedback</span>
                </li>
                <li class="nav-item" data-target="contact">
                    <i class="fas fa-envelope"></i>
                    <span>Contact Us</span>
                </li>
            </ul>
            <div class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <a href="login.html">
                <span>Logout</span>
</a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <div class="top-bar">
                <div class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </div>
                
                
            </div>

            <!-- Dashboard Section -->
            <div class="content-section active" id="dashboard">
                <h1>Dashboard</h1>
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3>12</h3>
                            <p>Enrolled Courses</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Certifications</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>48h</h3>
                            <p>Learning Hours</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-info">
                            <h3>15</h3>
                            <p>Achievements</p>
                        </div>
                    </div>
                </div>

                <div class="recent-courses">
                    <div class="section-header">
                        <h2>Continue Learning</h2>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="courses-container">
                        <div class="course-card">
                            <div class="course-image">
                                <img src="images/advwdt.jpg" alt="Web Development">
                               
                            </div>
                            <a href="wallpaper2.jpg"></a>
                            <div class="course-info">
                                <h3>Advanced Web Development</h3>
                                <form action="watch_video.php" method="get">
                                <a href="videos/adv dw.html" name="Advanced Web Development">get started</a>
                           </form>
                                <p class="instructor">By John Smith</p>
                                <div class="course-meta">
                                </a>
                                    <span><i class="fas fa-star"></i> 4.8</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-card">
                            <div class="course-image">
                                <img src="images/ds.jpg" alt="Data Science">
                              
                            </div>
                            <div class="course-info">
                                <h3>Introduction to Data Science</h3>
                                <form action="watch_video.php" method="get">
                                <a href="videos/ds.html">get started</a>
                                <p class="instructor">By Sarah Johnson</p>
                                <div class="course-meta">
                                    
                                    <span><i class="fas fa-star"></i> 4.6</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-card">
                            <div class="course-image">
                                <img src="images/ux.jpg" alt="UX Design">
                                
                            </div>
                            <div class="course-info">
                                <h3>UX Design Fundamentals</h3>
                                <form action="watch_video.php" method="get">
                                <a href="videos/uxv.html">get started</a>
                                <p class="instructor">By Michael Brown</p>
                                <div class="course-meta">
                                    
                                    <span><i class="fas fa-star"></i> 4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recommended-courses">
                    <div class="section-header">
                        <h2>Recommended For You</h2>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="courses-container">
                        <div class="course-card">
                            <div class="course-image">
                                <img src="images/ml.jpg" alt="Machine Learning">
                                <div class="course-badge">Hot</div>
                            </div>
                            <div class="course-info">
                                <h3>Machine Learning Fundamentals</h3>
                                <form action="watch_video.php" method="get">
                                <a href="videos/mlv.html">get started</a>
                                <p class="instructor">By David Wilson</p>
                                <div class="course-meta">
                                    <span><i class="fas fa-users"></i> 12,345 students</span>
                                    <span><i class="fas fa-star"></i> 4.7</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-card">
                            <div class="course-image">
                                <img src="images/js.jpg" alt="JavaScript">
                                <div class="course-badge">New</div>
                            </div>
                            <div class="course-info">
                                <h3>Advanced JavaScript Concepts</h3>
                                <form action="watch_video.php" method="get">
                                <a href="videos/jsv.html">get started</a>
                                <p class="instructor">By Emily Clark</p>
                                <div class="course-meta">
                                    <span><i class="fas fa-users"></i> 8,765 students</span>
                                    <span><i class="fas fa-star"></i> 4.9</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-card">
                            <div class="course-image">
                                <img src="images/pythonda.jpg" alt="Python">
                            </div>
                            <div class="course-info">
                                <h3>Python for Data Analysis</h3>
                                <form action="watch_video.php" method="get">
                                <a href="videos/pythonv.html">get started</a>
                                <p class="instructor">By Robert Johnson</p>
                                <div class="course-meta">
                                    <span><i class="fas fa-users"></i> 10,532 students</span>
                                    <span><i class="fas fa-star"></i> 4.8</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <<div class="content-section" id="profile">
    <h1>My Profile</h1>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="images/profile.jpg" alt="Profile Image">
                <div class="edit-avatar">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <div class="profile-info">
                <h3><?php echo htmlspecialchars($latestUsername); ?></h3>
                <p>Web Developer</p>
                <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($latestEmail); ?></p>
            </div>
        </div>

        <div class="profile-details">
            <!-- About Me -->
            <div class="profile-section" id="about-me-section">
                <h3>About Me <button onclick="editSection('about-me')" class="submit-btn">Edit</button></h3>
                <p id="about-me-text"><?php echo nl2br(htmlspecialchars($about_me)); ?></p>
            </div>

            <!-- Skills -->
            <div class="profile-section" id="skills-section">
                <h3>Skills <button onclick="editSection('skills')" class="submit-btn">Edit</button></h3>
                <div id="skills-container" class="skills-container">
                    <?php 
                    $skillArray = array_map('trim', explode(',', $skills));
                    foreach ($skillArray as $skill) {
                        echo '<span class="skill-tag">' . htmlspecialchars($skill) . '</span>';
                    }
                    ?>
                </div>
            </div>

            <!-- Education -->
            <div class="profile-section" id="education-section">
                <h3>Education <button onclick="editSection('education')" class="submit-btn">Edit</button></h3>
                <div id="education-container">
                    <?php 
                    $eduLines = explode("\n", $education);
                    foreach ($eduLines as $edu) {
                        echo '<div class="education-item"><p>' . htmlspecialchars($edu) . '</p></div>';
                    }
                    ?>
                </div>
            </div>

            <div class="profile-section">
                <div class="experience-item"><h4></h4><p></p><p></p></div>
                <div class="experience-item"><h4></h4><p></p><p></p></div>
            </div>
        </div>
    </div>
</div>
            <!-- Courses Section -->
            <div class="content-section" id="courses">
                <h1> Courses</h1>
                <div class="courses-filter">
                    <div class="filter-options">
                        <button class="filter-btn active">All Courses</button>
                        
                    </div>
                    <div class="sort-options">
                        <label for="sort">Sort by:</label>
                        <select id="sort">
                            <option value="recent">Recently Accessed</option>
                            <option value="name">Name</option>
                            <option value="progress">Progress</option>
                            <option value="date">Date Added</option>
                        </select>
                    </div>
                </div>
                <div class="courses-grid">
                    <div class="course-item">
                        <div class="course-image">
                            <img src="images/advwdt.jpg" alt="Web Development">
                            
                        </div>
                        <div class="course-details">
                            <h3>Advanced Web Development</h3>
                            <p class="instructor">By John Smith</p>
                            <div class="course-stats">
                                <span><i class="fas fa-clock"></i> 10h total</span>
                                <span><i class="fas fa-book-open"></i> 15 lessons</span>
                            </div>
                            <div class="course-actions">
                             <form action="watch_video.php" method="get">
                                <a href="videos/adv dw.html">
                                <button class="continue-btn"><a href="adv dw.html" style="color: white;">get started</a></button>
                                   
                                
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-image">
                            <img src="images/ds.jpg" alt="Data Science">
                           
                        </div>
                        <div class="course-details">
                            <h3>Introduction to Data Science</h3>
                            <p class="instructor">By Sarah Johnson</p>
                            <div class="course-stats">
                                <span><i class="fas fa-clock"></i> 15h total</span>
                                <span><i class="fas fa-book-open"></i> 20 lessons</span>
                            </div>
                            <div class="course-actions">
                            <form action="watch_video.php" method="get">
                                
                                <button class="continue-btn"><a href="videos/ds.html" style="color: white;">get started</a></button>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-image">
                            <img src="images/ux.jpg" alt="UX Design">
                           
                        </div>
                        <div class="course-details">
                            <h3>UX Design Fundamentals</h3>
                            <p class="instructor">By Michael Brown</p>
                            <div class="course-stats">
                                <span><i class="fas fa-clock"></i> 8h total</span>
                                <span><i class="fas fa-book-open"></i> 12 lessons</span>
                            </div>
                            <div class="course-actions">
                            <form action="watch_video.php" method="get">
                                
                                <button class="continue-btn"><a href="videos/uxv.html" style="color: white;">get started</a></button>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-image">
                            <img src="images/js.jpg" alt="JavaScript">  
                           
                        </div>
                        <div class="course-details">
                            <h3>JavaScript for Beginners</h3>
                            <p class="instructor">By Emily Clark</p>
                            <div class="course-stats">
                                <span><i class="fas fa-clock"></i> 12h total</span>
                                <span><i class="fas fa-book-open"></i> 18 lessons</span>
                            </div>
                            <div class="course-actions">
                            <form action="watch_video.php" method="get">
                                
                                <button class="continue-btn"><a href="videos/jsv.html" style="color: white;">get started</a></button>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-image">
                            <img src="images/pythonda.jpg" alt="Python">
                           
                        </div>
                        <div class="course-details">
                            <h3>Python for Data Analysis</h3>
                            <p class="instructor">By Robert Johnson</p>
                            <div class="course-stats">
                            
                            </div>
                            <div class="course-actions">
                            <form action="watch_video.php" method="get">
                                
                                <button class="continue-btn"><a href="videos/pythonv.html" style="color: white;">get started</a></button>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-image">
                            <img src="images/rjs.jpg" alt="React">
                           
                        </div>
                        <div class="course-details">
                            <h3>React.js Essentials</h3>
                            <p class="instructor">By Jennifer Lee</p>
                            <div class="course-stats">
                                <span><i class="fas fa-clock"></i> 16h total</span>
                                <span><i class="fas fa-book-open"></i> 24 lessons</span>
                            </div>
                            <div class="course-actions">
                            <form action="watch_video.php" method="get">
                                
                                <button class="continue-btn"><a href="videos/jsv.html" style="color: white;">get started</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certifications Section -->
            <div class="content-section" id="certifications">
                <h1>My Certifications</h1>
                <div class="certifications-container">
                    <div class="certification-card">
                        <div class="certification-header">
                            <img src="images/clogo.png" alt="Certification Logo" class="cert-logo">
                            <div class="certification-info">
                                <h3>Advanced Web Development</h3>
                                <p>Issued by: Eduix</p>
                                <p>Date: today</p>
                            </div>
                        </div>
                        <div class="certification-actions">
                            <a href="certificates/advc.html">view certificate</a>
                        </div>
                    </div>
                    <div class="certification-card">
                        <div class="certification-header">
                        <img src="images/clogo.png" alt="Certification Logo" class="cert-logo">
                            <div class="certification-info">
                                <h3>JavaScript Mastery</h3>
                                <p>Issued by: Eduix</p>
                                <p>Date: today</p>
                            </div>
                        </div>
                        <div class="certification-actions">
                        <a href="certificates/javacer.html">view certificate</a>
                        </div>
                    </div>
                    <div class="certification-card">
                        <div class="certification-header">
                        <img src="images/clogo.png" alt="Certification Logo" class="cert-logo">
                            <div class="certification-info">
                                <h3>UI/UX Design Principles</h3>
                                <p>Issued by: Eduix</p>
                                <p>Date: today</p>
                            </div>
                        </div>
                        <div class="certification-actions">
                        <a href="certificates/ux.html">view certificate</a>
                        </div>
                    </div>
                    <div class="certification-card">
                        <div class="certification-header">
                        <img src="images/clogo.png" alt="Certification Logo" class="cert-logo">
                            <div class="certification-info">
                                <h3>Data Science Fundamentals</h3>
                                <p>Issued by: Eduix</p>
                                <p>Date: today</p>
                            </div>
                        </div>
                        
                        <div class="certification-actions">
                        <a href="certificates/data.html">view certificate</a>
                        </div>
                        
                    </div>
                    <div class="certification-card">
                        <div class="certification-header">
                        <img src="images/clogo.png" alt="Certification Logo" class="cert-logo">
                            <div class="certification-info">
                                <h3>Python Programming</h3>
                                <p>Issued by: Eduix</p>
                                <p>Date: today</p>
                            </div>
                        </div>
                        <div class="certification-actions">
                        <a href="certificates/python.html">view certificate</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Section -->
            <div class="content-section" id="feedback">
    <h1>Provide Feedback</h1>
    <div class="feedback-container">
        <form class="feedback-form" action="submit_feedback.php" method="POST">
            <div class="feedback-intro">
                <p>We value your feedback! Please share your thoughts on our courses and platform to help us improve.</p>
            </div>
            <div class="feedback-form">
                <div class="form-group">
                    <label for="feedback-type">Feedback Type</label>
                    <input type="text" id="feedback-type" name="feedback_type" placeholder="e.g., Course Feedback" required>
                </div>
                <div class="form-group">
                    <label for="course-name">Course Name (if applicable)</label>
                    <input type="text" id="course-name" name="course_name" placeholder="e.g., JavaScript for Beginners">
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <div class="star-rating">
                        <input type="hidden" name="rating" id="rating-value-hidden" value="0">
                        <i class="fas fa-star" data-rating="1"></i>
                        <i class="fas fa-star" data-rating="2"></i>
                        <i class="fas fa-star" data-rating="3"></i>
                        <i class="fas fa-star" data-rating="4"></i>
                        <i class="fas fa-star" data-rating="5"></i>
                        <span class="rating-value">0/5</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="feedback-title">Feedback Title</label>
                    <input type="text" id="feedback-title" name="feedback_title" placeholder="Enter a title for your feedback" required>
                </div>
                <div class="form-group">
                    <label for="feedback-message">Your Feedback</label>
                    <textarea id="feedback-message" name="feedback_message" rows="5" placeholder="Please share your detailed feedback here..." required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Submit Feedback</button>
                </div>
            </div>
        </form>

        <!-- Previous feedback (unchanged) -->
        <div class="previous-feedback">
            <h3>Your Previous Feedback</h3>
            <!-- Example feedback entries... -->
        </div>
    </div>
</div>

            <!-- Contact Us Section -->
            <div class="content-section" id="contact">
                <h1>Contact Us</h1>
                <div class="contact-container">
                    <div class="contact-info">
                        <h2>Get in Touch</h2>
                        <p>Have questions or need assistance? We're here to help! Reach out to us using any of the methods below.</p>
                        <div class="contact-methods">
                            <div class="contact-method">
                                <i class="fas fa-envelope"></i>
                                <div class="method-details">
                                    <h3>Email Us</h3>
                                    <p>
                                    karthikeyakumara3@gmail.com</p>
                                    <p>For general inquiries: 
                                    karthikeyakumara3@gmail.com</p>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i class="fas fa-phone-alt"></i>
                                <div class="method-details">
                                    <h3>Call Us</h3>
                                    <p>+1 (555) 123-4567</p>
                                    <p>Monday to Friday, 9:00 AM - 6:00 PM EST</p>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="method-details">
                                    <h3>Visit Us</h3>
                                    <p>MG Road, Labbipet</p>
                                    <p>Vijayawada</p>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i class="fas fa-comments"></i>
                                <div class="method-details">
                                    <h3>Live Chat</h3>
                                    <p>Chat with our support team in real-time</p>
                                    <button class="start-chat-btn">Start Chat</button>
                                </div>
                            </div>
                        </div>
                        <div class="social-media">
                            <h3>Connect With Us</h3>
                            <div class="social-icons">
                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <h2>Send Us a Message</h2>
                        <form id="contactForm" action="contact.php" method="POST">
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" required></textarea>
    </div>
    <div class="form-group">
        <label class="checkbox-container">
            <input type="checkbox" name="newsletter" id="newsletter">
            <span class="checkmark"></span>
            Subscribe to our newsletter
        </label>
    </div>
    <button type="submit" class="submit-btn" action="contact.php">Send Message</button>
</form>
                    </div>
                </div>
                <div class="faq-section">
                    <h2>Frequently Asked Questions</h2>
                    <div class="faq-container">
                        <div class="faq-item">
                            <div class="faq-question">
                                <h3>How do I reset my password?</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>To reset your password, click on the "Forgot Password" link on the login page. Enter your email address, and we'll send you instructions to reset your password.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">
                                <h3>How can I get a refund for a course?</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>We offer a 30-day money-back guarantee for all our courses. If you're not satisfied with a course, you can request a refund within 30 days of purchase by contacting our support team.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">
                                <h3>How do I download course materials?</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>Course materials can be downloaded from the course page. Look for the "Resources" or "Downloads" section in each lesson. Note that not all courses offer downloadable materials.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">
                                <h3>Can I access courses on mobile devices?</h3>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="faq-answer">
                                <p>Yes, our platform is fully responsive and works on all devices. You can also download our mobile app for iOS and Android for a better mobile learning experience.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="dashbord.js"></script>
</body>
</html>