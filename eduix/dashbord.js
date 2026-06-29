document.addEventListener('DOMContentLoaded', function() {
    // Navigation
    const navItems = document.querySelectorAll('.nav-item');
    const contentSections = document.querySelectorAll('.content-section');
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked nav item
            this.classList.add('active');
            
            // Hide all content sections
            contentSections.forEach(section => section.classList.remove('active'));
            
            // Show the corresponding content section
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });
    
    // Toggle Sidebar
    const toggleSidebar = document.querySelector('.toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');
    
    toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
    
    // Star Rating
    const stars = document.querySelectorAll('.star-rating i');
    const ratingValue = document.querySelector('.rating-value');
    let currentRating = 0;
    
    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            highlightStars(rating);
        });
        
        star.addEventListener('mouseout', function() {
            highlightStars(currentRating);
        });
        
        star.addEventListener('click', function() {
            currentRating = this.getAttribute('data-rating');
            ratingValue.textContent = currentRating + '/5';
            highlightStars(currentRating);
        });
    });
    
    function highlightStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-rating') <= rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }
    
    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            faqItem.classList.toggle('active');
        });
    });
    
    // Filter Buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Form Submission
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Your message has been sent successfully!');
            this.reset();
        });
    }
    
    const feedbackForm = document.querySelector('.feedback-form');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Your feedback has been submitted successfully!');
            this.reset();
            currentRating = 0;
            highlightStars(0);
            ratingValue.textContent = '0/5';
        });
    }
    
    // Course Progress Animation
    const progressCircles = document.querySelectorAll('.circle');
    
    progressCircles.forEach(circle => {
        const dashArray = circle.getAttribute('stroke-dasharray').split(',');
        const percentage = parseInt(dashArray[0]);
        
        // Animate the progress
        let currentPercentage = 0;
        const interval = setInterval(() => {
            if (currentPercentage >= percentage) {
                clearInterval(interval);
            } else {
                currentPercentage += 1;
                circle.setAttribute('stroke-dasharray', `${currentPercentage}, 100`);
            }
        }, 20);
    });
    
    // Bookmark Functionality
    const bookmarkButtons = document.querySelectorAll('.bookmark-btn');
    
    bookmarkButtons.forEach(button => {
        button.addEventListener('click', function() {
            const icon = this.querySelector('i');
            icon.classList.toggle('fas');
            icon.classList.toggle('far');
            
            if (icon.classList.contains('fas')) {
                alert('Course bookmarked!');
            } else {
                alert('Bookmark removed!');
            }
        });
    });
    
    // Certificate Actions
    const viewCertButtons = document.querySelectorAll('.view-cert-btn');
    const downloadCertButtons = document.querySelectorAll('.download-cert-btn');
    const shareCertButtons = document.querySelectorAll('.share-cert-btn');
    
    viewCertButtons.forEach(button => {
        button.addEventListener('click', function() {
            alert('Certificate viewer opening...');
        });
    });
    
    downloadCertButtons.forEach(button => {
        button.addEventListener('click', function() {
            alert('Certificate download started...');
        });
    });
    
    shareCertButtons.forEach(button => {
        button.addEventListener('click', function() {
            alert('Share options opening...');
        });
    });
    
    // Live Chat Button
    const startChatBtn = document.querySelector('.start-chat-btn');
    if (startChatBtn) {
        startChatBtn.addEventListener('click', function() {
            alert('Connecting to a support agent...');
        });
    }
    
    // File Upload Preview
    const fileInput = document.getElementById('attachment');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const fileInfo = document.querySelector('.file-info');
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024).toFixed(2) + ' KB';
                fileInfo.textContent = `Selected file: ${fileName} (${fileSize})`;
            } else {
                fileInfo.textContent = 'Max file size: 5MB. Supported formats: jpg, png, pdf';
            }
        });
    }
    
    // Course Search Functionality
    const searchInput = document.querySelector('.search-bar input');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                alert(`Searching for: ${this.value}`);
                this.value = '';
            }
        });
    }
    
    // Notification and Message Dropdowns (Placeholder)
    const notificationIcon = document.querySelector('.notification');
    const messageIcon = document.querySelector('.message');
    
    if (notificationIcon) {
        notificationIcon.addEventListener('click', function() {
            alert('Notifications panel opening...');
        });
    }
    
    if (messageIcon) {
        messageIcon.addEventListener('click', function() {
            alert('Messages panel opening...');
        });
    }
    
    // Logout Functionality
    const logoutBtn = document.querySelector('.logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logging out...');
            }
        });
    }
    
    // Edit Profile Button
    const editProfileBtn = document.querySelector('.edit-profile-btn');
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', function() {
            alert('Edit profile form opening...');
        });
    }
    
    // Continue Learning Buttons
    const continueButtons = document.querySelectorAll('.continue-btn');
    continueButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseName = this.closest('.course-details').querySelector('h3').textContent;
            alert(`Continuing course: ${courseName}`);
        });
    });
    
    // Review Buttons
    const reviewButtons = document.querySelectorAll('.review-btn');
    reviewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courseName = this.closest('.course-details').querySelector('h3').textContent;
            alert(`Opening review for course: ${courseName}`);
        });
    });
    
    // Mobile Detection
    function isMobile() {
        return window.innerWidth <= 768;
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (isMobile() && sidebar.classList.contains('active')) {
            if (!sidebar.contains(e.target) && e.target !== toggleSidebar) {
                sidebar.classList.remove('active');
            }
        }
    });
    
    // Resize Handler
    window.addEventListener('resize', function() {
        if (!isMobile()) {
            sidebar.classList.remove('active');
        }
    });
});
function loadLatestUser() {
    fetch("latest_user.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("latestUser").innerText = `${data}`;
        });
}

window.onload = loadLatestUser;


    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star-rating .fa-star");
        const ratingInput = document.getElementById("rating-value-hidden");
        const ratingText = document.querySelector(".rating-value");

        stars.forEach(star => {
            star.addEventListener("click", function () {
                const rating = parseInt(this.getAttribute("data-rating"));
                ratingInput.value = rating;
                ratingText.textContent = `${rating}/5`;

                // Highlight stars
                stars.forEach(s => {
                    const currentRating = parseInt(s.getAttribute("data-rating"));
                    if (currentRating <= rating) {
                        s.classList.add("checked");
                    } else {
                        s.classList.remove("checked");
                    }
                });
            });
        });
    });
   
function editSection(section) {
    if (section === 'about-me') {
        const textEl = document.getElementById('about-me-text');
        const textarea = textEl.querySelector('textarea');

        if (textarea) {
            // Save new text to database
            const newText = textarea.value.trim();
            saveToDatabase('about-me', newText);

            // Replace textarea with text after saving
            textEl.innerHTML = newText.replace(/\n/g, '<br>');
        } else {
            const currentText = textEl.innerText.trim();
            textEl.innerHTML = `
                <textarea rows="5" style="width: 100%;">${currentText}</textarea>
                <br><button onclick="editSection('about-me')" class="submit-btn">Save</button>
            `;
        }
    }

    if (section === 'skills') {
        const container = document.getElementById('skills-container');
        const textarea = container.querySelector('textarea');

        if (textarea) {
            const newSkills = textarea.value.trim();
            saveToDatabase('skills', newSkills);

            const skillsArray = newSkills.split(',').map(skill => skill.trim());
            container.innerHTML = skillsArray.map(skill => `<span class="skill-tag">${skill}</span>`).join(' ');
        } else {
            const skills = Array.from(container.querySelectorAll('.skill-tag')).map(el => el.innerText).join(', ');
            container.innerHTML = `
                <textarea rows="3" style="width: 100%;">${skills}</textarea>
                <br><button onclick="editSection('skills')" class="submit-btn">Save</button>
            `;
        }
    }

    if (section === 'education') {
        const container = document.getElementById('education-container');
        const textarea = container.querySelector('textarea');

        if (textarea) {
            const newEducation = textarea.value.trim();
            saveToDatabase('education', newEducation);

            const lines = newEducation.split('\n\n');
            container.innerHTML = lines.map(line => {
                const parts = line.trim().split('\n');
                return `
                    <div class="education-item">
                        <h4>${parts[0] || ''}</h4>
                        <p>${parts[1] || ''}</p>
                        <p>${parts[2] || ''}</p>
                    </div>`;
            }).join('');
        } else {
            const items = Array.from(container.querySelectorAll('.education-item')).map(item => {
                const title = item.querySelector('h4')?.innerText || '';
                const school = item.querySelectorAll('p')[0]?.innerText || '';
                const years = item.querySelectorAll('p')[1]?.innerText || '';
                return `${title}\n${school}\n${years}`;
            }).join('\n\n');
            container.innerHTML = `
                <textarea rows="8" style="width: 100%;">${items}</textarea>
                <br><button onclick="editSection('education')" class="submit-btn">Save</button>
            `;
        }
    }
}

// ✅ This function actually saves data to the database
function saveToDatabase(section, value) {
    fetch('update_profile.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `section=${encodeURIComponent(section)}&value=${encodeURIComponent(value)}`
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server Response:', data);
        if (data.status === 'success') {
            showSavedMessage(section, '✅ Saved successfully!');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error saving data:', error);
        alert('Failed to save data. Check console for details.');
    });
}

// ✅ Optional small success message
function showSavedMessage(section, message) {
    const sectionEl = document.getElementById(section + '-section');
    let msg = sectionEl.querySelector('.saved-msg');
    if (!msg) {
        msg = document.createElement('p');
        msg.className = 'saved-msg';
        msg.style.color = 'green';
        msg.style.fontSize = '0.9em';
        msg.style.marginTop = '5px';
        sectionEl.appendChild(msg);
    }
    msg.textContent = message;

    setTimeout(() => msg.remove(), 2500);
}
