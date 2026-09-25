<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Walk - Premium Footwear Collection</title>
    <link rel="stylesheet" href="css/styles.css">
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
                <li><a href="index.php" class="nav-link active">Home</a></li>
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
        <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="hero-slider">
                <div class="hero-slide active" style="background-image: url('./assets/hero-images/hero-image1.png')"></div>
                <div class="hero-slide" style="background-image: url('./assets/hero-images/hero-image2.png')"></div>
                <div class="hero-slide" style="background-image: url('./assets/hero-images/hero-image3.png')"></div>
                <div class="hero-slide" style="background-image: url('./assets/hero-images/hero-image4.png')"></div>
            </div>
        
            <div class="hero-content">
                <h1 class="hero-title">Step Forward</h1>
                <p class="hero-subtitle">Discover premium footwear that defines your journey</p>
                <a href="#categories" class="hero-cta">
                    <span>Shop Collection</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        
            <!-- Slider Navigation Dots -->
            <div class="hero-dots">
                <span class="dot active" data-slide="0"></span>
                <span class="dot" data-slide="1"></span>
                <span class="dot" data-slide="2"></span>
                <span class="dot" data-slide="3"></span>
            </div>
        </section>

        <!-- Categories Section - Men, Women, Kids -->
        <section id="categories" class="categories">
            <div class="container">
                <h2 class="section-title">Shop by Category</h2>
                <div class="categories-grid">            
                    <!-- Men's Category -->
                    <a href="men.php" class="category-card men">
                        <img src="./assets/Category-images/Footwear-Men-414x320-1.png" alt="Men" class="category-icon">
                        <div class="category-texts">
                            <h3 class="category-name">Men</h3>
                            <p class="category-desc">Professional & Casual Footwear</p>
                        </div>
                    </a>
                    
                    <!-- Women's Category -->
                    <a href="women.php" class="category-card women">
                        <img src="./assets/Category-images/Footwear-Women-414x320-2.png" alt="Women" class="category-icon">
                        <div class="category-texts">
                            <h3 class="category-name">Women</h3>
                            <p class="category-desc">Elegant & Comfortable Styles</p>
                        </div>
                    </a>
                    
                    <!-- Kids' Category -->
                    <a href="kids.php" class="category-card kids">
                        <img src="./assets/Category-images/Collections-boy-shoe-1.png" alt="Kids" class="category-icon">
                        <div class="category-texts">
                            <h3 class="category-name">Kids</h3>
                            <p class="category-desc">Fun & Durable Designs</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section id="featured-products" class="featured-products">
            <div class="container">
                <h2 class="section-title">Featured Collection</h2>
                <p class="section-subtitle">Our most popular and trending footwear</p>
                <div class="products-grid" id="featured-products-grid">
                    <!-- Products will be populated by JavaScript -->
                </div>
                <div class="view-all-container">
                    <a href="all-products.php" class="btn-view-all">View All Products</a>
                </div>
            </div>
        </section>

        <!-- Brand Showcase -->
        <section class="brands-section">
            <div class="container">
                <h2 class="section-title">Our Premium Brands</h2>
                <div class="brands-grid">
                    <div class="brand-card">
                        <div class="brand-logo">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h4>City Walk Premium</h4>
                    </div>
                    <div class="brand-card">
                        <div class="brand-logo">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h4>City Walk Elegance</h4>
                    </div>
                    <div class="brand-card">
                        <div class="brand-logo">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>City Walk Kids</h4>
                    </div>
                    <div class="brand-card">
                        <div class="brand-logo">
                            <i class="fas fa-running"></i>
                        </div>
                        <h4>City Walk Sport</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section with HTML5 Validation -->
        <section class="newsletter-section">
            <div class="container">
                <div class="newsletter-content">
                    <h2>Stay Updated</h2>
                    <p>Subscribe to get the latest updates on new arrivals and exclusive offers</p>
                    <form class="newsletter-form" id="newsletter-form">
                        <input 
                            type="email" 
                            name="email"
                            required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            title="Please enter a valid email address"
                            placeholder="Enter your email address">
                        <button type="submit">Subscribe</button>
                    </form>
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
                        <li><a href="#new-arrivals">New Arrivals</a></li>
                        <li><a href="#sale">Sale Items</a></li>
                    </ul>
                </div>
                
                <!-- Customer Service -->
                <div class="footer-section">
                    <h4>Customer Service</h4>
                    <ul>
                        <li><a href="#shipping">Shipping Info</a></li>
                        <li><a href="#returns">Returns & Exchanges</a></li>
                        <li><a href="men.php#size-guide">Size Guide</a></li>
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
    <script>
    // Hero Slider functionality
    function initHeroSlider() {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;
        const slideInterval = 5000; // 5 seconds

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Auto advance slides
        let autoSlide = setInterval(nextSlide, slideInterval);

        // Dot click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
                // Reset auto-slide timer
                clearInterval(autoSlide);
                autoSlide = setInterval(nextSlide, slideInterval);
            });
        });
    }

    // Call this in your initializeApp function
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.hero-slider')) {
            initHeroSlider();
        }
    });
    
    // Newsletter form submission handler - HTML5 validates automatically
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (this.checkValidity()) {
            const email = this.querySelector('input[type="email"]').value;
            
            if (typeof showNotification === 'function') {
                showNotification('Thank you for subscribing to our newsletter!', 'success');
            } else {
                alert('Thank you for subscribing to our newsletter!');
            }
            
            this.reset();
        } else {
            this.reportValidity();
        }
    });
    </script>

</body>
</html>
