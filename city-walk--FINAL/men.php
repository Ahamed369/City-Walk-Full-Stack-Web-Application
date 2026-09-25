<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Footwear - City Walk</title>
    <link rel="stylesheet" href="./css/styles.css">
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
                <li><a href="men.php" class="nav-link active">Men</a></li>
                <li><a href="women.php" class="nav-link">Women</a></li>
                <li><a href="kids.php" class="nav-link">Kids</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
            
            <!-- Right Side Actions -->
            <div class="nav-actions">
                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" placeholder="Search men's shoes..." id="search-input">
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
        <section class="page-hero men-hero">
            <div class="hero-content">
                <h1 class="hero-title">Men's Collection</h1>
                <p class="hero-subtitle">Professional, casual, and athletic footwear for the modern man</p>
            </div>
        </section>

        <!-- Filter and Sort Section -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-header">
                    <h3>Men's Footwear</h3>
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
                            <option value="formal">Formal Shoes</option>
                            <option value="casual">Casual Shoes</option>
                            <option value="athletic">Athletic/Sports</option>
                            <option value="boots">Boots</option>
                            <option value="sandals">Sandals</option>
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
                        <label for="size-filter">Size:</label>
                        <select id="size-filter">
                            <option value="">All Sizes</option>
                            <option value="7">Size 7</option>
                            <option value="8">Size 8</option>
                            <option value="9">Size 9</option>
                            <option value="10">Size 10</option>
                            <option value="11">Size 11</option>
                            <option value="12">Size 12</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="brand-filter">Brand:</label>
                        <select id="brand-filter">
                            <option value="">All Brands</option>
                            <option value="City Walk Premium">City Walk Premium</option>
                            <option value="City Walk Casual">City Walk Casual</option>
                            <option value="City Walk Sport">City Walk Sport</option>
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

        <!-- Men's Products Section -->
        <section class="products-section">
            <div class="container">
                <!-- Products Grid -->
                <div class="products-grid" id="mens-products-grid">
                    <!-- Products will be populated by JavaScript -->
                </div>
                
                <!-- Load More Button -->
                <div class="load-more-container">
                    <button class="btn-load-more" id="load-more-btn">Load More Products</button>
                </div>
            </div>
        </section>

        <!-- Men's Categories Showcase -->
        <section class="category-showcase">
            <div class="container">
                <h2 class="section-title">Shop Men's Categories</h2>
                <div class="showcase-grid">
                    <div class="showcase-card formal-card">
                        <div class="showcase-content">
                            <i class="fas fa-user-tie"></i>
                            <h3>Formal Shoes</h3>
                            <p>Professional oxfords, dress shoes, and formal footwear for business occasions</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('formal')">Shop Formal</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card casual-card">
                        <div class="showcase-content">
                            <i class="fas fa-walking"></i>
                            <h3>Casual Shoes</h3>
                            <p>Comfortable sneakers, loafers, and everyday footwear for casual outings</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('casual')">Shop Casual</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card athletic-card">
                        <div class="showcase-content">
                            <i class="fas fa-running"></i>
                            <h3>Athletic Shoes</h3>
                            <p>Performance sneakers, running shoes, and sports footwear for active lifestyle</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('athletic')">Shop Athletic</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card boots-card">
                        <div class="showcase-content">
                            <i class="fas fa-shoe-prints"></i>
                            <h3>Boots</h3>
                            <p>Durable work boots, casual boots, and weather-resistant footwear</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('boots')">Shop Boots</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Size Guide Section -->
        <section class="size-guide-section" id="size-guide">
            <div class="container">
                <h2 class="section-title">Men's Size Guide</h2>
                <div class="size-guide-content">
                    <div class="size-chart">
                        <table class="size-table">
                            <thead>
                                <tr>
                                    <th>US Size</th>
                                    <th>UK Size</th>
                                    <th>EU Size</th>
                                    <th>Foot Length (cm)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>7</td>
                                    <td>6.5</td>
                                    <td>40</td>
                                    <td>25.4</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>7.5</td>
                                    <td>41</td>
                                    <td>26.0</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>8.5</td>
                                    <td>42</td>
                                    <td>26.7</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>9.5</td>
                                    <td>43</td>
                                    <td>27.3</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>10.5</td>
                                    <td>44</td>
                                    <td>27.9</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>11.5</td>
                                    <td>45</td>
                                    <td>28.6</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="size-tips">
                        <h4>Sizing Tips:</h4>
                        <ul>
                            <li>Measure your feet in the evening when they're at their largest</li>
                            <li>Always measure both feet and use the larger measurement</li>
                            <li>Leave about 1cm of space between your longest toe and the shoe</li>
                            <li>Consider the type of socks you'll wear with the shoes</li>
                            <li>When in doubt, contact our customer service for personalized advice</li>
                        </ul>
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
                        <li><a href="#size-guide">Size Guide</a></li>
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
    <script src="js/men.js"></script>

</body>
</html>