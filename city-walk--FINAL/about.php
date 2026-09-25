<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - City Walk</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/about.css">
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
                <li><a href="about.php" class="nav-link active">About</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
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
        <section class="page-hero about-hero">
            <div class="hero-content">
                <h1 class="hero-title">About City Walk</h1>
                <p class="hero-subtitle">Your trusted partner in premium footwear since day one</p>
            </div>
        </section>

        <!-- Company Story Section -->
        <section class="company-story">
            <div class="container">
                <div class="story-content">
                    <div class="story-text">
                        <h2 class="section-title">Our Story</h2>
                        <p>City Walk began with a simple vision: to provide premium footwear that combines style, comfort, and durability for every member of the family. Founded with a passion for craftsmanship and an unwavering commitment to quality, we have grown from a small footwear retailer to a trusted brand serving customers across Sri Lanka.</p>
                        
                        <p>Our journey started when we recognized a gap in the market for high-quality, affordable footwear that doesn't compromise on style or comfort. We believe that great shoes are more than just accessories – they're the foundation of confidence, the companion to your adventures, and the support for your daily journey.</p>
                        
                        <p>Today, City Walk continues to evolve, embracing modern e-commerce while maintaining our core values of quality, customer service, and innovation in footwear design.</p>
                    </div>
                    <div class="story-image">
                        <div class="placeholder-image">
                            <i class="shop-image"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision Section -->
        <section class="mission-vision">
            <div class="container">
                <div class="mv-grid">
                    <div class="mv-card">
                        <i class="fas fa-bullseye"></i>
                        <h3>Our Mission</h3>
                        <p>To provide exceptional footwear that enhances every step of our customers' journeys, combining premium quality, innovative design, and outstanding value to create lasting relationships built on trust and satisfaction.</p>
                    </div>
                    <div class="mv-card">
                        <i class="fas fa-eye"></i>
                        <h3>Our Vision</h3>
                        <p>To become the most trusted footwear destination in Sri Lanka, known for our commitment to quality, customer service excellence, and our ability to help every customer find their perfect pair.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="values-section">
            <div class="container">
                <h2 class="section-title">Our Values</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <i class="fas fa-medal"></i>
                        <h3>Quality First</h3>
                        <p>We never compromise on quality. Every product in our collection meets our strict standards for materials, construction, and durability.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-heart"></i>
                        <h3>Customer Care</h3>
                        <p>Our customers are at the heart of everything we do. We strive to exceed expectations in service, support, and satisfaction.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-handshake"></i>
                        <h3>Integrity</h3>
                        <p>We conduct business with honesty, transparency, and ethical practices. Our word is our bond, and trust is our foundation.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-lightbulb"></i>
                        <h3>Innovation</h3>
                        <p>We continuously evolve our products, services, and shopping experience to meet changing customer needs and preferences.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-users"></i>
                        <h3>Community</h3>
                        <p>We're proud to be part of the Sri Lankan business community and committed to contributing positively to our society.</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-leaf"></i>
                        <h3>Responsibility</h3>
                        <p>We're committed to responsible business practices that consider our impact on the environment and future generations.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <div class="container">
                <h2 class="section-title">Meet Our Team</h2>
                <p class="section-subtitle">The passionate professionals behind City Walk</p>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-image">
                            <i class="image-mr-ahamed"></i>
                        </div>
                        <h3>M.R. Ahamed</h3>
                        <p class="member-role">Founder & CEO</p>
                        <p>With over 10 years in the footwear industry, Ahamed founded City Walk with a vision to revolutionize how Sri Lankans shop for shoes.</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <i class="image-Priya-Silva"></i>
                        </div>
                        <h3>Priya Silva</h3>
                        <p class="member-role">Head of Product Development</p>
                        <p>Priya ensures every shoe meets our high standards for comfort, style, and durability. She leads our quality assurance and product sourcing.</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <i class="image-Kamal-Fernando"></i>
                        </div>
                        <h3>Kamal Fernando</h3>
                        <p class="member-role">Customer Experience Manager</p>
                        <p>Kamal oversees our customer service operations, ensuring every interaction with City Walk exceeds expectations.</p>
                    </div>
                    <div class="team-member">
                        <div class="member-image">
                            <i class="image-mohamed-fahad"></i>
                        </div>
                        <h3>Mohamed Fahad</h3>
                        <p class="member-role">E-commerce Director</p>
                        <p>Fahad leads our digital transformation, making online shopping seamless and enjoyable for our customers.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Awards & Recognition Section -->
        <section class="awards-section">
            <div class="container">
                <h2 class="section-title">Awards & Recognition</h2>
                <div class="awards-grid">
                    <div class="award-card">
                        <i class="fas fa-trophy"></i>
                        <h4>Best Footwear Retailer 2024</h4>
                        <p>Sri Lanka Retail Awards</p>
                    </div>
                    <div class="award-card">
                        <i class="fas fa-star"></i>
                        <h4>Customer Choice Award</h4>
                        <p>E-commerce Excellence Awards 2024</p>
                    </div>
                    <div class="award-card">
                        <i class="fas fa-certificate"></i>
                        <h4>Quality Excellence Certificate</h4>
                        <p>Sri Lanka Standards Institute</p>
                    </div>
                    <div class="award-card">
                        <i class="fas fa-heart"></i>
                        <h4>Top Rated Service</h4>
                        <p>Customer Satisfaction Survey 2024</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="stats-section">
            <div class="container">
                <h2 class="section-title">Our Impact</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">50,000+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">100,000+</div>
                        <div class="stat-label">Shoes Sold</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Product Varieties</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">99%</div>
                        <div class="stat-label">Customer Satisfaction</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Commitment Section -->
        <section class="commitment-section">
            <div class="container">
                <h2 class="section-title">Our Commitment</h2>
                <div class="commitment-grid">
                    <div class="commitment-item">
                        <i class="fas fa-shipping-fast"></i>
                        <h4>Fast Delivery</h4>
                        <p>Island-wide delivery within 3-5 business days with tracking support</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fas fa-undo-alt"></i>
                        <h4>Easy Returns</h4>
                        <p>Hassle-free 30-day return policy with full refund guarantee</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fas fa-phone-alt"></i>
                        <h4>24/7 Support</h4>
                        <p>Round-the-clock customer service via phone, email, and live chat</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fas fa-shield-alt"></i>
                        <h4>Secure Shopping</h4>
                        <p>Safe and secure payment processing with data protection guarantee</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fas fa-tools"></i>
                        <h4>Expert Fitting</h4>
                        <p>Professional size guidance and fitting consultation available</p>
                    </div>
                    <div class="commitment-item">
                        <i class="fas fa-gem"></i>
                        <h4>Authentic Products</h4>
                        <p>100% genuine products with manufacturer warranty and quality assurance</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Location Section -->
         
        <section class="location-section">
            <div class="container">
                <h2 class="section-title">Visit Our Store</h2>
                <div class="location-content">
                    <div class="location-info">
                        <h3>City Walk Flagship Store</h3>
                        <div class="location-details">
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>Address:</strong><br>
                                    475, Kandy Road<br>
                                    Peradeniya, Sri Lanka
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <strong>Store Hours:</strong><br>
                                    Monday - Friday: 9:00 AM - 8:00 PM<br>
                                    Saturday: 9:00 AM - 9:00 PM<br>
                                    Sunday: 10:00 AM - 6:00 PM
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>Phone:</strong><br>
                                    +94 72 076 0214<br>
                                    <strong>WhatsApp:</strong> +94 72 076 0214
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <strong>Email:</strong><br>
                                    info@citywalk.lk<br>
                                    support@citywalk.lk
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="location-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.204595712788!2d80.57409807485254!3d7.226351214597146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae36eef50564313%3A0x6496ca6dc63c8083!2sCity%20Walk!5e1!3m2!1sen!2slk!4v1766083795650!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Join Us Section -->
        <section class="join-us-section">
            <div class="container">
                <div class="join-content">
                    <h2>Join the City Walk Family</h2>
                    <p>Experience the difference that quality footwear makes. Browse our collection and discover your perfect pair today.</p>
                    <div class="join-actions">
                        <a href="index.php" class="btn-primary">Start Shopping</a>
                        <a href="contact.php" class="btn-secondary">Get in Touch</a>
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

    <!-- JavaScript -->
    <script src="js/app.js"></script>
</body>
</html>
