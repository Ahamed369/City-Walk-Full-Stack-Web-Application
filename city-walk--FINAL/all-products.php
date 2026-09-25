<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - City Walk</title>
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
        <section class="page-hero all-products-hero">
            <div class="hero-content">
                <h1 class="hero-title">All Products</h1>
                <p class="hero-subtitle">Browse our complete collection of premium footwear</p>
            </div>
        </section>

        <!-- Filter and Sort Section -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-header">
                    <h3>All Footwear Collection</h3>
                    <div class="results-count">
                        <span id="results-count">Loading products...</span>
                    </div>
                </div>
                
                <!-- Product Filters -->
                <div class="filters-container">
                    <div class="filter-group">
                        <label for="category-filter">Category:</label>
                        <select id="category-filter">
                            <option value="">All Categories</option>
                            <option value="men">Men's Footwear</option>
                            <option value="women">Women's Footwear</option>
                            <option value="kids">Kids' Footwear</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="subcategory-filter">Type:</label>
                        <select id="subcategory-filter">
                            <option value="">All Types</option>
                            <option value="formal">Formal</option>
                            <option value="casual">Casual</option>
                            <option value="athletic">Athletic</option>
                            <option value="boots">Boots</option>
                            <option value="sandals">Sandals</option>
                            <option value="heels">Heels</option>
                            <option value="flats">Flats</option>
                            <option value="sneakers">Sneakers</option>
                            <option value="wedges">Wedges</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="price-filter">Price Range:</label>
                        <select id="price-filter">
                            <option value="">All Prices</option>
                            <option value="0-5000">Under LKR 5,000</option>
                            <option value="5000-10000">LKR 5,000 - 10,000</option>
                            <option value="10000-15000">LKR 10,000 - 15,000</option>
                            <option value="15000+">Above LKR 15,000</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="brand-filter">Brand:</label>
                        <select id="brand-filter">
                            <option value="">All Brands</option>
                            <option value="City Walk Premium">City Walk Premium</option>
                            <option value="City Walk Casual">City Walk Casual</option>
                            <option value="City Walk Sport">City Walk Sport</option>
                            <option value="City Walk Elegance">City Walk Elegance</option>
                            <option value="City Walk Summer">City Walk Summer</option>
                            <option value="City Walk Kids">City Walk Kids</option>
                            <option value="City Walk School">City Walk School</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="sort-filter">Sort by:</label>
                        <select id="sort-filter">
                            <option value="name">Name A-Z</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="rating">Highest Rated</option>
                            <option value="newest">Newest First</option>
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <button class="btn-clear-filters" id="clear-filters">Clear Filters</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- All Products Section -->
        <section class="products-section">
            <div class="container">
                <!-- Products Grid -->
                <div class="products-grid" id="products-grid">
                    <!-- Products will be populated by JavaScript -->
                </div>
                
                <!-- No Results Message -->
                <div id="no-results" style="display: none; text-align: center; padding: 60px 20px;">
                    <i class="fas fa-search" style="font-size: 64px; color: #86868b; margin-bottom: 20px;"></i>
                    <h3 style="color: #1d1d1f; margin-bottom: 12px;">No products found</h3>
                    <p style="color: #86868b;">Try adjusting your filters to see more results</p>
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
    <script src="js/allproducts.js"></script>
</body>
</html>