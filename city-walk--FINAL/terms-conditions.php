<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions - City Walk</title>
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
        <section class="page-hero tc-hero">
            <div class="hero-content">
                <h1 class="hero-title">Terms & Conditions</h1>
                <p class="hero-subtitle">Please read these terms carefully before using our services</p>
            </div>
        </section>

        <!-- Terms & Conditions Content -->
        <section class="company-story">
            <div class="container">
                <div class="story-content" style="grid-template-columns: 1fr;">
                    <div class="story-text">
                        <p style="color: #86868b; font-size: 14px; margin-bottom: 24px;">
                            <strong>Last Updated:</strong> October 8, 2025
                        </p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-bottom: 20px;">Agreement to Terms</h2>
                        <p>Welcome to City Walk. These Terms and Conditions ("Terms") govern your use of our website and services. By accessing or using our website, you agree to be bound by these Terms. If you do not agree with any part of these Terms, you may not use our services.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">1. Definitions</h2>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li><strong>"Website"</strong> refers to City Walk's e-commerce platform</li>
                            <li><strong>"Services"</strong> includes all products, features, and functionalities offered</li>
                            <li><strong>"User," "You," "Your"</strong> refers to the person accessing our website</li>
                            <li><strong>"We," "Us," "Our"</strong> refers to City Walk</li>
                            <li><strong>"Products"</strong> refers to footwear and related items sold on our platform</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">2. User Accounts</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Account Registration</h3>
                        <p>To access certain features, you must create an account by providing:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Accurate and complete information</li>
                            <li>A valid email address</li>
                            <li>A secure password</li>
                            <li>Current contact details</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Account Responsibilities</h3>
                        <p>You are responsible for:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Maintaining the confidentiality of your account credentials</li>
                            <li>All activities that occur under your account</li>
                            <li>Notifying us immediately of any unauthorized access</li>
                            <li>Ensuring your account information remains accurate and up-to-date</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">3. Orders and Payments</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Order Process</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>All orders are subject to product availability</li>
                            <li>We reserve the right to refuse or cancel any order</li>
                            <li>Order confirmation does not guarantee acceptance</li>
                            <li>Prices are subject to change without notice</li>
                            <li>Product images are for illustration purposes and may vary from actual products</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Payment Terms</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>We accept Cash on Delivery (COD) for orders within Sri Lanka</li>
                            <li>Payment must be made in Sri Lankan Rupees (LKR)</li>
                            <li>All prices include applicable taxes unless stated otherwise</li>
                            <li>For COD orders, payment must be made upon delivery</li>
                            <li>We reserve the right to verify payment information</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Pricing</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>All prices are displayed in Sri Lankan Rupees (LKR)</li>
                            <li>Prices may change without prior notice</li>
                            <li>We are not responsible for pricing errors on our website</li>
                            <li>Shipping charges are additional unless specified as free shipping</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">4. Shipping and Delivery</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Delivery Policy</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>We deliver island-wide within Sri Lanka</li>
                            <li>Standard delivery takes 3-5 business days</li>
                            <li>Delivery times are estimates and not guaranteed</li>
                            <li>We are not liable for delays caused by courier services or unforeseen circumstances</li>
                            <li>Accurate delivery address is the customer's responsibility</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Failed Deliveries</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>If delivery fails due to incorrect address or unavailability, re-delivery charges may apply</li>
                            <li>Products refused or undelivered will be returned to us</li>
                            <li>Refunds for undelivered orders will be processed after product return</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">5. Returns and Exchanges</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Return Policy</h3>
                        <p>We offer a 30-day return policy from the date of delivery. To be eligible for a return:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Products must be unworn and in original condition</li>
                            <li>Original packaging, tags, and labels must be intact</li>
                            <li>Proof of purchase (receipt or order confirmation) is required</li>
                            <li>Products must not be damaged, altered, or washed</li>
                            <li>Sale items may have different return conditions</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Exchange Policy</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Free size exchanges within 30 days of purchase</li>
                            <li>Subject to product availability</li>
                            <li>Exchange shipping costs may apply</li>
                            <li>Only one exchange per product is allowed</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Refund Process</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Refunds will be processed within 7-10 business days after product inspection</li>
                            <li>Original shipping charges are non-refundable</li>
                            <li>Refunds will be issued to the original payment method</li>
                            <li>For COD orders, refunds will be processed via bank transfer</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">6. Product Information</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Product Descriptions</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>We strive to provide accurate product descriptions and images</li>
                            <li>Colors may vary due to screen settings and lighting</li>
                            <li>Product specifications are subject to change by manufacturers</li>
                            <li>We do not guarantee that descriptions are error-free</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Product Availability</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Product availability is updated regularly but not guaranteed</li>
                            <li>Out-of-stock items will be notified during checkout</li>
                            <li>We reserve the right to limit quantities per customer</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">7. Intellectual Property</h2>
                        <p>All content on this website, including but not limited to:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Text, graphics, logos, images, and videos</li>
                            <li>Website design and layout</li>
                            <li>Software and source code</li>
                            <li>Product descriptions and photography</li>
                            <li>Trademarks and brand names</li>
                        </ul>
                        <p>Are the property of City Walk or our licensors and are protected by intellectual property laws. You may not reproduce, distribute, or create derivative works without our written permission.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">8. User Conduct</h2>
                        <p>You agree NOT to:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Use the website for any unlawful purpose</li>
                            <li>Impersonate any person or entity</li>
                            <li>Interfere with website functionality or security</li>
                            <li>Attempt to gain unauthorized access to our systems</li>
                            <li>Upload viruses, malware, or harmful code</li>
                            <li>Harvest or collect user information</li>
                            <li>Engage in fraudulent activities</li>
                            <li>Post false, misleading, or defamatory content</li>
                            <li>Violate any applicable laws or regulations</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">9. Warranties and Disclaimers</h2>
                        
                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Product Warranties</h3>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Products come with manufacturer warranties where applicable</li>
                            <li>Warranty terms vary by product and manufacturer</li>
                            <li>We guarantee 100% authentic products</li>
                            <li>Defective products can be returned within the warranty period</li>
                        </ul>

                        <h3 style="color: #1d1d1f; font-size: 20px; margin-top: 24px; margin-bottom: 12px;">Website Disclaimer</h3>
                        <p>THE WEBSITE IS PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS. WE MAKE NO WARRANTIES, EXPRESS OR IMPLIED, REGARDING:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Website availability, reliability, or accuracy</li>
                            <li>Fitness for a particular purpose</li>
                            <li>Non-infringement of third-party rights</li>
                            <li>Freedom from errors, viruses, or harmful components</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">10. Limitation of Liability</h2>
                        <p>TO THE MAXIMUM EXTENT PERMITTED BY LAW, CITY WALK SHALL NOT BE LIABLE FOR:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Indirect, incidental, or consequential damages</li>
                            <li>Loss of profits, data, or business opportunities</li>
                            <li>Damages arising from website use or inability to use</li>
                            <li>Unauthorized access to or alteration of your data</li>
                            <li>Third-party actions or content</li>
                            <li>Delays or failures in delivery</li>
                        </ul>
                        <p>Our total liability shall not exceed the amount you paid for the product in question.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">11. Indemnification</h2>
                        <p>You agree to indemnify and hold harmless City Walk, its officers, directors, employees, and agents from any claims, damages, losses, or expenses (including legal fees) arising from:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Your violation of these Terms</li>
                            <li>Your violation of any rights of another party</li>
                            <li>Your use or misuse of the website</li>
                            <li>Your breach of any laws or regulations</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">12. Privacy Policy</h2>
                        <p>Your use of our website is also governed by our Privacy Policy. Please review our <a href="privacy-policy.php" style="color: #1d1d1f; text-decoration: underline;">Privacy Policy</a> to understand how we collect, use, and protect your personal information.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">13. Third-Party Links</h2>
                        <p>Our website may contain links to third-party websites or services. We are not responsible for:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>The content or accuracy of third-party websites</li>
                            <li>Privacy practices of external sites</li>
                            <li>Products or services offered by third parties</li>
                            <li>Any damages arising from your use of third-party sites</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">14. Termination</h2>
                        <p>We reserve the right to:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Suspend or terminate your account at any time</li>
                            <li>Refuse service to anyone for any reason</li>
                            <li>Remove or edit content without notice</li>
                            <li>Discontinue the website or services</li>
                        </ul>
                        <p>Upon termination, your right to use the website will immediately cease. All provisions that should survive termination will remain in effect.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">15. Governing Law</h2>
                        <p>These Terms shall be governed by and construed in accordance with the laws of Sri Lanka, without regard to its conflict of law provisions. Any disputes arising from these Terms shall be subject to the exclusive jurisdiction of the courts of Sri Lanka.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">16. Dispute Resolution</h2>
                        <p>In the event of any dispute or claim arising from these Terms:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>First, contact our customer service team to resolve the issue informally</li>
                            <li>If informal resolution fails, disputes may be submitted to mediation</li>
                            <li>Legal action may be taken as a last resort</li>
                            <li>You agree to resolve disputes individually, not as part of a class action</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">17. Changes to Terms</h2>
                        <p>We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting on the website. Your continued use of the website after changes constitutes acceptance of the modified Terms.</p>
                        <p>We will notify users of significant changes through:</p>
                        <ul style="color: #86868b; line-height: 1.8; margin-left: 20px; margin-bottom: 20px;">
                            <li>Email notification to registered users</li>
                            <li>Prominent notice on our website</li>
                            <li>Update of the "Last Updated" date</li>
                        </ul>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">18. Severability</h2>
                        <p>If any provision of these Terms is found to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary, and the remaining provisions will remain in full force and effect.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">19. Entire Agreement</h2>
                        <p>These Terms, together with our Privacy Policy and any other legal notices published on the website, constitute the entire agreement between you and City Walk regarding the use of our website and services.</p>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">20. Contact Information</h2>
                        <p>For questions or concerns about these Terms and Conditions, please contact us:</p>
                        <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin-top: 20px;">
                            <p style="margin-bottom: 8px;"><strong>City Walk</strong></p>
                            <p style="margin-bottom: 8px;">475, Kandy Road, Peradeniya, Sri Lanka</p>
                            <p style="margin-bottom: 8px;"><strong>Email:</strong> <a href="mailto:legal@citywalk.lk" style="color: #1d1d1f;">legal@citywalk.lk</a></p>
                            <p style="margin-bottom: 8px;"><strong>Customer Service:</strong> <a href="mailto:support@citywalk.lk" style="color: #1d1d1f;">support@citywalk.lk</a></p>
                            <p style="margin-bottom: 8px;"><strong>Phone:</strong> +94 72 076 0214</p>
                            <p style="margin-bottom: 0;"><strong>Hours:</strong> Monday - Friday, 9:00 AM - 8:00 PM (IST)</p>
                        </div>

                        <h2 class="section-title" style="text-align: left; font-size: 28px; margin-top: 40px; margin-bottom: 20px;">21. Acknowledgment</h2>
                        <p>BY USING OUR WEBSITE AND SERVICES, YOU ACKNOWLEDGE THAT YOU HAVE READ, UNDERSTOOD, AND AGREE TO BE BOUND BY THESE TERMS AND CONDITIONS.</p>

                        <div style="background: #1d1d1f; color: white; padding: 24px; border-radius: 12px; margin-top: 40px; text-align: center;">
                            <p style="margin-bottom: 12px; font-size: 18px; font-weight: 600;">Thank You for Choosing City Walk</p>
                            <p style="margin-bottom: 0; color: #86868b;">We are committed to providing you with quality products and excellent service. If you have any questions about these terms, please don't hesitate to contact us.</p>
                        </div>

                        <div style="background: #f5f5f7; padding: 20px; border-radius: 12px; margin-top: 20px;">
                            <p style="margin-bottom: 8px; font-weight: 600; color: #1d1d1f;">Quick Links:</p>
                            <p style="margin-bottom: 4px;"><a href="privacy-policy.php" style="color: #1d1d1f; text-decoration: underline;">Privacy Policy</a></p>
                            <p style="margin-bottom: 4px;"><a href="contact.php#faq" style="color: #1d1d1f; text-decoration: underline;">Frequently Asked Questions</a></p>
                            <p style="margin-bottom: 4px;"><a href="contact.php" style="color: #1d1d1f; text-decoration: underline;">Contact Customer Support</a></p>
                            <p style="margin-bottom: 0;"><a href="about.php" style="color: #1d1d1f; text-decoration: underline;">About City Walk</a></p>
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