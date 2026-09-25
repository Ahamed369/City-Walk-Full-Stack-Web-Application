<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Footwear - City Walk</title>
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
                <li><a href="men.php" class="nav-link">Men</a></li>
                <li><a href="women.php" class="nav-link active">Women</a></li>
                <li><a href="kids.php" class="nav-link">Kids</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
            
            <!-- Right Side Actions -->
            <div class="nav-actions">
                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" placeholder="Search women's shoes..." id="search-input">
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
        <section class="page-hero women-hero">
            <div class="hero-content">
                <h1 class="hero-title">Women's Collection</h1>
                <p class="hero-subtitle">Elegant, comfortable, and stylish footwear designed for the modern woman</p>
            </div>
        </section>

        <!-- Filter and Sort Section -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-header">
                    <h3>Women's Footwear</h3>
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
                            <option value="heels">Heels & Pumps</option>
                            <option value="flats">Flats & Ballet</option>
                            <option value="sandals">Sandals</option>
                            <option value="boots">Boots & Booties</option>
                            <option value="sneakers">Sneakers</option>
                            <option value="wedges">Wedges</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="heel-height-filter">Heel Height:</label>
                        <select id="heel-height-filter">
                            <option value="">Any Height</option>
                            <option value="flat">Flat (0-1cm)</option>
                            <option value="low">Low Heel (1-3cm)</option>
                            <option value="medium">Medium Heel (3-7cm)</option>
                            <option value="high">High Heel (7-10cm)</option>
                            <option value="very-high">Very High (10cm+)</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="price-filter">Price Range:</label>
                        <select id="price-filter">
                            <option value="">All Prices</option>
                            <option value="0-4000">Under LKR 4,000</option>
                            <option value="4000-8000">LKR 4,000 - 8,000</option>
                            <option value="8000-12000">LKR 8,000 - 12,000</option>
                            <option value="12000+">Above LKR 12,000</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="size-filter">Size:</label>
                        <select id="size-filter">
                            <option value="">All Sizes</option>
                            <option value="5">Size 5</option>
                            <option value="6">Size 6</option>
                            <option value="7">Size 7</option>
                            <option value="8">Size 8</option>
                            <option value="9">Size 9</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="brand-filter">Brand:</label>
                        <select id="brand-filter">
                            <option value="">All Brands</option>
                            <option value="City Walk Elegance">City Walk Elegance</option>
                            <option value="City Walk Premium">City Walk Premium</option>
                            <option value="City Walk Summer">City Walk Summer</option>
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

        <!-- Women's Products Section -->
        <section class="products-section">
            <div class="container">
                <!-- Products Grid -->
                <div class="products-grid" id="womens-products-grid">
                    <!-- Products will be populated by JavaScript -->
                </div>
                
                <!-- Load More Button -->
                <div class="load-more-container">
                    <button class="btn-load-more" id="load-more-btn">Load More Products</button>
                </div>
            </div>
        </section>

        <!-- Women's Categories Showcase -->
        <section class="category-showcase">
            <div class="container">
                <h2 class="section-title">Shop Women's Categories</h2>
                <div class="showcase-grid">
                    <div class="showcase-card heels-card">
                        <div class="showcase-content">
                            <i class="fa-solid fa-person-dress"></i>
                            <h3>Heels & Pumps</h3>
                            <p>Elegant heels and pumps for office, evening events, and special occasions</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('heels')">Shop Heels</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card flats-card">
                        <div class="showcase-content">
                            <i class="fas fa-shoe-prints"></i>
                            <h3>Flats & Ballet</h3>
                            <p>Comfortable ballet flats and casual shoes for everyday elegance</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('flats')">Shop Flats</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card sandals-card">
                        <div class="showcase-content">
                            <i class="fas fa-socks"></i>
                            <h3>Sandals</h3>
                            <p>Stylish sandals for summer, casual outings, and vacation wear</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('sandals')">Shop Sandals</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card boots-card">
                        <div class="showcase-content">
                            <i class="fas fa-hiking"></i>
                            <h3>Boots & Booties</h3>
                            <p>Fashionable boots and ankle booties for fall, winter, and year-round style</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('boots')">Shop Boots</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Size Guide Section -->
        <section class="size-guide-section">
            <div class="container">
                <h2 class="section-title">Women's Size Guide</h2>
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
                                    <td>5</td>
                                    <td>2.5</td>
                                    <td>35</td>
                                    <td>22.8</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>3.5</td>
                                    <td>36</td>
                                    <td>23.5</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>4.5</td>
                                    <td>37</td>
                                    <td>24.1</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>5.5</td>
                                    <td>38</td>
                                    <td>24.8</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>6.5</td>
                                    <td>39</td>
                                    <td>25.4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="size-tips">
                        <h4>Sizing Tips for Women:</h4>
                        <ul>
                            <li>Measure feet in the afternoon when they're naturally slightly larger</li>
                            <li>Consider heel height when selecting size - higher heels may require half size up</li>
                            <li>Account for foot swelling during pregnancy or long periods of standing</li>
                            <li>Different shoe styles may fit differently - refer to specific product reviews</li>
                            <li>For heels, ensure there's minimal gap at the heel when walking</li>
                            <li>Contact our sizing experts for personalized fitting advice</li>
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
    <script src="js/women.js"></script>
</body>
</html>