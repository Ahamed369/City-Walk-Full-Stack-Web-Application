<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - City Walk</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header Navigation -->
    <header class="header">
        <nav class="nav-container">
            <!-- Logo/Brand Name with Small Image Icons -->
            <div class="nav-logo-container">
                <a href="index.php" class="nav-logo">City Walk</a>
                <div class="nav-logo-icons">
                    <img src="./assets/icons/womens.png" alt="Facebook" class="logo-icon">
                    <img src="./assets/icons/flat-shoes.png" alt="Instagram" class="logo-icon">
                    <img src="./assets/icons/slippers.png" alt="Twitter" class="logo-icon">
                    <img src="./assets/icons/sandal.png" alt="YouTube" class="logo-icon">
                </div>
            </div>
            
            <!-- Main Navigation Menu -->
            <ul class="nav-menu" id="nav-menu">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="men.php" class="nav-link">Men</a></li>
                <li><a href="women.php" class="nav-link">Women</a></li>
                <li><a href="kids.php" class="nav-link">Kids</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="contact.php" class="nav-link active">Contact</a></li>
            </ul>
            
            <!-- Right Side Actions -->
            <div class="nav-actions">
                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" placeholder="Search footwear..." id="search-input">
                    <button id="search-btn"><i class="fas fa-search"></i></button>
                </div>
                
                <!-- Shopping Cart Button -->
                <button class="cart-btn" id="cart-btn">
                    <img src="./assets/icons/online-shopping.png" alt="Cart Logo" class="cart-logo">
                    <span class="cart-count" id="cart-count">0</span>
                </button>
                
                <!-- Authentication Buttons -->
                <div class="auth-buttons">
                    <button class="btn-auth" id="login-btn">Sign In</button>
                    <button class="btn-auth" id="signup-btn">Sign Up</button>
                    <!-- User Profile (hidden by default, shown when logged in) -->
                    <div class="user-profile" id="user-profile" style="display: none;">
                        <button class="profile-btn" id="profile-btn">
                            <i class="fas fa-user"></i> <span id="username">User</span>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Hamburger Menu -->
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Page Hero Section -->
        <section class="page-hero contact-hero">
            <div class="hero-content">
                <h1 class="hero-title">Get in Touch</h1>
                <p class="hero-subtitle">We're here to help with any questions or concerns</p>
            </div>
        </section>

        <!-- Contact Content Section -->
        <section class="contact-section">
            <div class="container">
                <div class="contact-grid">
                    <!-- Contact Form -->
                    <div class="contact-form-wrapper">
                        <h2>Send Us a Message</h2>
                        <p class="form-description">Have a question? Fill out the form below and we'll get back to you within 24 hours.</p>
                        
                        <form class="contact-form" id="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first-name">First Name *</label>
                                    <input 
                                        type="text" 
                                        id="first-name" 
                                        name="firstName" 
                                        required
                                        minlength="2"
                                        maxlength="50"
                                        pattern="[A-Za-z\s]+"
                                        title="Please enter a valid first name (letters only)"
                                        placeholder="Enter your first name">
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name *</label>
                                    <input 
                                        type="text" 
                                        id="last-name" 
                                        name="lastName" 
                                        required
                                        minlength="2"
                                        maxlength="50"
                                        pattern="[A-Za-z\s]+"
                                        title="Please enter a valid last name (letters only)"
                                        placeholder="Enter your last name">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    required
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    title="Please enter a valid email address"
                                    placeholder="example@email.com">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    pattern="[\+]?[0-9]{10,15}"
                                    title="Please enter a valid phone number (10-15 digits)"
                                    placeholder="+94 72 076 0214">
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="order">Order Support</option>
                                    <option value="product">Product Question</option>
                                    <option value="shipping">Shipping & Delivery</option>
                                    <option value="returns">Returns & Exchanges</option>
                                    <option value="sizing">Size Guidance</option>
                                    <option value="feedback">Feedback & Suggestions</option>
                                    <option value="partnership">Business Partnership</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="6" 
                                    required
                                    minlength="10"
                                    maxlength="1000"
                                    placeholder="Tell us how we can help you... (minimum 10 characters)"></textarea>
                            </div>
                            
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="newsletter" name="newsletter">
                                    <span>Subscribe to our newsletter for updates and exclusive offers</span>
                                </label>
                            </div>
                            
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="contact-info-wrapper">
                        <h2>Contact Information</h2>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="method-details">
                                <h3>Visit Our Store</h3>
                                <p>475, Kandy Road<br>
                                Peradeniya<br>
                                Sri Lanka</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="method-details">
                                <h3>Call Us</h3>
                                <p><strong>Phone:</strong> +94 72 076 0214<br>
                                <strong>WhatsApp:</strong> +94 72 076 0214<br>
                                <strong>Hours:</strong> Mon-Fri: 9AM - 8PM (IST)</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="method-details">
                                <h3>Email Us</h3>
                                <p><strong>General:</strong> info@citywalk.lk<br>
                                <strong>Support:</strong> support@citywalk.lk<br>
                                <strong>Business:</strong> business@citywalk.lk</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="method-details">
                                <h3>Store Hours</h3>
                                <p><strong>Mon - Fri:</strong> 9:00 AM - 8:00 PM<br>
                                <strong>Saturday:</strong> 9:00 AM - 9:00 PM<br>
                                <strong>Sunday:</strong> 10:00 AM - 6:00 PM</p>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="social-section">
                            <h3>Connect With Us</h3>
                            <div class="social-links-list">
                                <a href="#facebook" class="social-link">
                                    <i class="fab fa-facebook"></i>
                                    <span>Facebook</span>
                                </a>
                                <a href="#instagram" class="social-link">
                                    <i class="fab fa-instagram"></i>
                                    <span>Instagram</span>
                                </a>
                                <a href="#twitter" class="social-link">
                                    <i class="fab fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                <a href="#youtube" class="social-link">
                                    <i class="fab fa-youtube"></i>
                                    <span>YouTube</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section" id="faq">
            <div class="container">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <h3>How do I track my order?</h3>
                        <p>Once your order ships, you'll receive a tracking number via email. You can track your order status by logging into your account or using the tracking number on our website.</p>
                    </div>
                    <div class="faq-item">
                        <h3>What is your return policy?</h3>
                        <p>We offer a 30-day return policy for all unworn items in original condition. Returns are free for defective products. Please contact our support team to initiate a return.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Do you offer Cash on Delivery?</h3>
                        <p>Yes! We offer Cash on Delivery (COD) for all orders within Sri Lanka. Simply select this option during checkout and pay when your order arrives.</p>
                    </div>
                    <div class="faq-item">
                        <h3>How can I find my correct shoe size?</h3>
                        <p>Visit our Size Guide page for detailed sizing charts for men, women, and kids. You can also contact our customer service for personalized fitting advice.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Do you ship island-wide?</h3>
                        <p>Yes, we deliver to all areas of Sri Lanka. Delivery typically takes 3-5 business days depending on your location. Expedited shipping options are also available.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Are all products authentic?</h3>
                        <p>Absolutely! We guarantee 100% authentic products from verified brands. All items come with manufacturer warranty and quality assurance.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Can I exchange my shoes for a different size?</h3>
                        <p>Yes, we offer free size exchanges within 30 days of purchase. The shoes must be unworn and in original packaging. Contact us to arrange an exchange.</p>
                    </div>
                    <div class="faq-item">
                        <h3>Do you have a physical store I can visit?</h3>
                        <p>Yes! Our flagship store is located at 475, Kandy Road, Peradeniya. Visit us during business hours to try on shoes and get expert fitting advice.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Contact Section -->
        <section class="quick-contact">
            <div class="container">
                <h2 class="section-title">Need Immediate Help?</h2>
                <div class="quick-contact-grid">
                    <div class="quick-contact-card">
                        <i class="fas fa-comments"></i>
                        <h3>Live Chat</h3>
                        <p>Chat with our support team in real-time</p>
                        <button class="btn-contact" onclick="alert('Live chat feature coming soon!')">Start Chat</button>
                    </div>
                    <div class="quick-contact-card">
                        <i class="fab fa-whatsapp"></i>
                        <h3>WhatsApp</h3>
                        <p>Message us on WhatsApp for quick responses</p>
                        <a href="https://wa.me/94720760214" class="btn-contact">Open WhatsApp</a>
                    </div>
                    <div class="quick-contact-card">
                        <i class="fas fa-phone-alt"></i>
                        <h3>Call Now</h3>
                        <p>Speak directly with our customer service</p>
                        <a href="tel:+94720760214" class="btn-contact">+94 72 076 0214</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-section">
                    <h4>City Walk</h4>
                    <p>Premium footwear for every step of your journey. Quality, comfort, and style in every pair.</p>
                    <div class="social-links">
                        <a href="#facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#youtube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="footer-section">
                    <h4>Shop</h4>
                    <ul>
                        <li><a href="men.php">Men's Footwear</a></li>
                        <li><a href="women.php">Women's Footwear</a></li>
                        <li><a href="kids.php">Kids' Footwear</a></li>
                        
                    </ul>
                </div>
                
                <!-- Customer Service -->
                <div class="footer-section">
                    <h4>Customer Service</h4>
                    <ul>
                        <li><a href="#shipping">Shipping Info</a></li>
                        <li><a href="#returns">Returns & Exchanges</a></li>
                        
                        <li><a href="contact.php#faq">FAQ</a></li>
                        <li><a href="contact.php">Contact Support</a></li>
                    </ul>
                </div>
                
                <!-- Legal & Info -->
                <div class="footer-section">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="terms-conditions.php">Terms & Conditions</a></li>
                        <li><a href="#careers">Careers</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 City Walk. All rights reserved. | Designed for premium footwear experience</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Contact form submission handler - HTML5 validates automatically
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if form is valid
            if (this.checkValidity()) {
                // Get form data
                const formData = {
                    firstName: document.getElementById('first-name').value,
                    lastName: document.getElementById('last-name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    subject: document.getElementById('subject').value,
                    message: document.getElementById('message').value,
                    newsletter: document.getElementById('newsletter').checked
                };
                
                // In a real application, this would send data to server
                console.log('Form submitted:', formData);
                
                // Show success message
                if (typeof showNotification === 'function') {
                    showNotification('Thank you for contacting us! We will respond within 24 hours.', 'success');
                } else {
                    alert('Thank you for contacting us! We will respond within 24 hours.');
                }
                
                // Reset form
                this.reset();
            } else {
                // Trigger HTML5 validation messages
                this.reportValidity();
            }
        });
    </script>
    
    <!-- JavaScript -->
    <script src="js/app.js"></script>
</body>
</html>