# Eduix - E-Learning & Online Education Platform

Eduix is a dynamic, responsive web application designed for online education. The platform features user authentication, a personalized dashboard, interactive courses, certifications, a dynamic profile management system, user feedback submissions, and support channels.

---

## 🚀 Features

- **User Authentication:** Secure sign-up and login functionality with password hashing (`password_verify` / `password_hash`).
- **Interactive Dashboard:** 
  - Statistics overview (enrolled courses, certifications, learning hours, and achievements).
  - "Continue Learning" & "Recommended for You" course panels.
- **Course Center:** Dynamic learning hub showcasing courses in Advanced Web Development, Data Science, UI/UX Design, Machine Learning, JavaScript, and Python.
- **Video Player:** Custom video player page (`watch_video.php`) that streams MP4 lectures from the local video store.
- **Profile Customization:** Interactive inline editing of "About Me", "Skills", and "Education" fields, synced dynamically with the MySQL database via AJAX.
- **Certifications Portlet:** View and review student certificates (`certificates/` folder) representing completed learning paths.
- **Feedback & Support System:** Review previous feedback logs, submit new rating reviews, and contact support through an interactive contact form and live chat mockup.

---

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3 (Custom Grid layouts, FontAwesome), Vanilla JavaScript
- **Backend:** PHP (Session-based auth, Prepared statements, MySQLi connection)
- **Database:** MySQL

---

## 📂 Project Directory Structure

```text
eduix/
├── README.md                 # Project documentation (this file)
└── eduix/                    # Main application directory
    ├── SQL quaries.txt       # Original database schema queries
    ├── index.html            # Landing / welcome page
    ├── login.HTML            # Main authentication login portal
    ├── login.CSS             # Styles for the login/signup wrapper
    ├── login.JS              # Frontend switching logic for Login / Sign Up
    ├── signup.php            # Handles user account registration
    ├── login.php             # Handles user session initiation
    ├── dashbord.php          # Main dashboard portal (PHP rendering, dynamic user information)
    ├── dashbord.css          # Core layout styles for sidebar, cards, forms, and profiles
    ├── dashbord.js           # Client-side dynamic state, tabs, stars, and AJAX requests
    ├── update_profile.php    # REST endpoint updating user profile details via AJAX
    ├── submit_feedback.php   # Handles saving user reviews & ratings
    ├── watch_video.php       # Dynamic script resolving video streaming locations
    ├── contact.php           # Processes Contact Us form submissions
    ├── certificates/         # Directory containing cert templates and asset files
    │   ├── advc.html         # Advanced Web Development Certificate Page
    │   ├── data.html         # Data Science Certificate Page
    │   ├── javacer.html      # JavaScript Mastery Certificate Page
    │   ├── python.html       # Python Programming Certificate Page
    │   ├── ux.html           # UI/UX Design Principles Certificate Page
    │   └── *.png             # Images of certificates
    ├── images/               # Image assets (course banners, user icons)
    └── videos/               # Video assets (.mp4 files and HTML video players)
```

---

## 🗄️ Database Setup

To run Eduix, you must set up a MySQL database named `user_auth`. Run the following queries in your MySQL console (or phpMyAdmin):

```sql
-- 1. Create and select the database
CREATE DATABASE IF NOT EXISTS `user_auth`;
USE `user_auth`;

-- 2. Create the users table (includes profile columns and auto-increment 'id')
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `about_me` TEXT DEFAULT NULL,
    `skills` TEXT DEFAULT NULL,
    `education` TEXT DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Create the feedback table
CREATE TABLE IF NOT EXISTS `feedback` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `feedback_type` VARCHAR(100) NOT NULL,
    `course_name` VARCHAR(150) DEFAULT NULL,
    `rating` INT DEFAULT 0,
    `feedback_title` VARCHAR(255) NOT NULL,
    `feedback_message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Create the videos table
CREATE TABLE IF NOT EXISTS `videos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `video_name` VARCHAR(255) NOT NULL UNIQUE,
    `video_path` VARCHAR(255) NOT NULL
);

-- 5. Seed some sample videos (Optional)
INSERT INTO `videos` (`video_name`, `video_path`) VALUES
('Advanced Web Development', 'videos/adv wd.mp4'),
('Introduction to Data Science', 'videos/ds.mp4'),
('UX Design Fundamentals', 'videos/ux.mp4'),
('Machine Learning Fundamentals', 'videos/ml.mp4'),
('Advanced JavaScript Concepts', 'videos/js.mp4'),
('Python for Data Analysis', 'videos/pythonv.mp4')
ON DUPLICATE KEY UPDATE `video_path`=VALUES(`video_path`);
```

---

## ⚙️ How to Run Locally

### 1. Prerequisites
- A local PHP/MySQL environment like **XAMPP**, **WAMP**, or **MAMP**.

### 2. Deployment Steps
1. Move the `eduix` project folder into your server's web root directory (e.g., `C:/xampp/htdocs/eduix` on Windows/XAMPP).
2. Start the **Apache** and **MySQL** services from your server dashboard.
3. Import the SQL queries above into your MySQL server via **phpMyAdmin** (`http://localhost/phpmyadmin`).
4. Verify database credentials in the following PHP files and change them if your MySQL server uses a password:
   - `dashbord.php` (line 5)
   - `latest_user.php` (line 5)
   - `signup.php` (line 4)
   - `login.php` (line 5)
   - `update_profile.php` (line 7)
   - `submit_feedback.php` (line 5)
   - `watch_video.php` (line 5)
5. Open your web browser and navigate to:
   ```text
   http://localhost/eduix/eduix/index.html
   ```

---

## 🔒 Security & Improvement Recommendations

- **Connection Settings:** Extract database connection credentials into a single unified config file (e.g., `db_config.php`) and include it using `require_once` to avoid repetitive declarations.
- **Prepared Statements:** Ensure all incoming parameters, particularly in `contact.php`, are validated and sanitized to protect against SQL injections and Cross-Site Scripting (XSS).
- **Session Authentication:** Add user session validation checks at the beginning of `dashbord.php` to prevent unauthenticated access. (e.g., `if(!isset($_SESSION['username'])){ header('Location: login.HTML'); exit(); }`).
