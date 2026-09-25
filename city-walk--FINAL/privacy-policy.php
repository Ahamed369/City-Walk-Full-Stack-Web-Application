<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - City Walk</title>
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
                <li><a href="about.php" class="nav-link">About</a></li>
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
        <section class="page-hero privacy-hero">
            <div class="hero-content">
                <h1 class="hero-title">Privacy Policy</h1>
                <p class="hero-subtitle">Your privacy is important to us</p>
            </div>
        </section>

        <!-- Privacy Policy Content -->
        <section class="company-story">
            <div class="container">
                <div class="story-content" style="grid-template-columns: 1fr;">
                    <div class="story-text">
                        <p style="color: #86868b; font-size: 14px; margin-bottom: 24px;">
                            <strong>Last Updated:</strong> October 8, 2025
                        </p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-bottom: 20px;">Introduction</h2>
                        <p>Welcome to City Walk. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our services.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">1. Information We Collect</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Personal Information</h3>
                        <p>We collect personal information that you voluntarily provide to us when you:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Register for an account</li>
                            <li>Place an order</li>
                            <li>Subscribe to our newsletter</li>
                            <li>Contact us for customer support</li>
                            <li>Participate in surveys or promotions</li>
                        </ul>
                        <p>This information may include:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Name and contact information (email, phone number, address)</li>
                            <li>Payment information (processed securely through payment gateways)</li>
                            <li>Shipping and billing addresses</li>
                            <li>Order history and preferences</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Automatically Collected Information</h3>
                        <p>When you visit our website, we automatically collect certain information about your device and browsing behavior, including:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>IP address and browser type</li>
                            <li>Device information and operating system</li>
                            <li>Pages visited and time spent on pages</li>
                            <li>Referring website addresses</li>
                            <li>Click patterns and navigation paths</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">2. How We Use Your Information</h2>
                        <p>We use the collected information for various purposes:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li><strong>Order Processing:</strong> To process and fulfill your orders, including shipping and delivery</li>
                            <li><strong>Account Management:</strong> To create and manage your account</li>
                            <li><strong>Customer Support:</strong> To respond to your inquiries and provide customer service</li>
                            <li><strong>Marketing Communications:</strong> To send you promotional offers and newsletters (with your consent)</li>
                            <li><strong>Website Improvement:</strong> To analyze usage patterns and improve our website functionality</li>
                            <li><strong>Fraud Prevention:</strong> To detect and prevent fraudulent transactions</li>
                            <li><strong>Legal Compliance:</strong> To comply with legal obligations and enforce our terms</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">3. Information Sharing and Disclosure</h2>
                        <p>We do not sell, trade, or rent your personal information to third parties. We may share your information in the following circumstances:</p>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Service Providers</h3>
                        <p>We may share information with trusted third-party service providers who assist us in:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Payment processing</li>
                            <li>Shipping and delivery services</li>
                            <li>Email marketing platforms</li>
                            <li>Website hosting and analytics</li>
                            <li>Customer support services</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Legal Requirements</h3>
                        <p>We may disclose your information if required by law or in response to valid legal requests, such as:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Court orders or subpoenas</li>
                            <li>Government investigations</li>
                            <li>Protection of our legal rights</li>
                            <li>Prevention of fraud or illegal activities</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">4. Data Storage and Security</h2>
                        <p>We implement appropriate technical and organizational security measures to protect your personal information, including:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Encryption of sensitive data during transmission (SSL/TLS)</li>
                            <li>Secure storage systems with access controls</li>
                            <li>Regular security assessments and updates</li>
                            <li>Employee training on data protection</li>
                        </ul>
                        <p>However, no method of transmission over the internet is 100% secure. While we strive to protect your information, we cannot guarantee absolute security.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">5. Cookies and Tracking Technologies</h2>
                        <p>We use cookies and similar tracking technologies to enhance your browsing experience:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li><strong>Essential Cookies:</strong> Necessary for website functionality (shopping cart, account login)</li>
                            <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our website</li>
                            <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements</li>
                            <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                        </ul>
                        <p>You can control cookie settings through your browser preferences. Note that disabling cookies may affect website functionality.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">6. Your Privacy Rights</h2>
                        <p>You have the following rights regarding your personal information:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li><strong>Access:</strong> Request a copy of the personal information we hold about you</li>
                            <li><strong>Correction:</strong> Request correction of inaccurate or incomplete information</li>
                            <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                            <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications at any time</li>
                            <li><strong>Data Portability:</strong> Request transfer of your data to another service</li>
                            <li><strong>Object:</strong> Object to certain processing of your personal information</li>
                        </ul>
                        <p>To exercise these rights, please contact us at <a href="mailto:privacy@citywalk.lk" style="color: #1d1d1f; text-decoration: underline;">privacy@citywalk.lk</a></p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">7. Children's Privacy</h2>
                        <p>Our website is not intended for children under the age of 13. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">8. Third-Party Links</h2>
                        <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to review their privacy policies before providing any personal information.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">9. International Data Transfers</h2>
                        <p>Your information may be transferred to and processed in countries other than Sri Lanka. We ensure appropriate safeguards are in place to protect your information in accordance with this Privacy Policy.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">10. Changes to This Privacy Policy</h2>
                        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Posting the new Privacy Policy on this page</li>
                            <li>Updating the "Last Updated" date</li>
                            <li>Sending an email notification for significant changes</li>
                        </ul>
                        <p>We encourage you to review this Privacy Policy periodically.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">11. Contact Us</h2>
                        <p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us:</p>
                        <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin-top: 20px;">
                            <p style="margin-bottom: 8px;"><strong>City Walk</strong></p>
                            <p style="margin-bottom: 8px;">475, Kandy Road, Peradeniya, Sri Lanka</p>
                            <p style="margin-bottom: 8px;"><strong>Email:</strong> <a href="mailto:privacy@citywalk.lk" style="color: #1d1d1f;">privacy@citywalk.lk</a></p>
                            <p style="margin-bottom: 8px;"><strong>Phone:</strong> +94 72 076 0214</p>
                            <p style="margin-bottom: 0;"><strong>Hours:</strong> Monday - Friday, 9:00 AM - 8:00 PM (IST)</p>
                        </div>

                        <div style="background: #1d1d1f; color: white; padding: 24px; border-radius: 12px; margin-top: 40px; text-align: center;">
                            <p style="margin-bottom: 12px; font-size: 18px; font-weight: 600;">Your Privacy Matters to Us</p>
                            <p style="margin-bottom: 0; color: #86868b;">We are committed to protecting your personal information and being transparent about our data practices.</p>
                        </div>
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