<?php
require_once 'config.php';
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kid's Footwear - City Walk</title>
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
                <li><a href="kids.php" class="nav-link active">Kids</a></li>
                <li><a href="about.php" class="nav-link">About</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
            
            <!-- Right Side Actions -->
            <div class="nav-actions">
                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" placeholder="Search kid's shoes..." id="search-input">
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
        <section class="page-hero kids-hero">
            <div class="hero-content">
                <h1 class="hero-title">Kid's Collection</h1>
                <p class="hero-subtitle">Fun, comfortable, and durable footwear for growing feet</p>
            </div>
        </section>

        <!-- Filter and Sort Section -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-header">
                    <h3>Kid's Footwear</h3>
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
                            <option value="athletic">Athletic & Sports</option>
                            <option value="formal">School & Formal</option>
                            <option value="sandals">Sandals & Summer</option>
                            <option value="boots">Boots & Winter</option>
                            <option value="casual">Casual & Play</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="age-group-filter">Age Group:</label>
                        <select id="age-group-filter">
                            <option value="">All Ages</option>
                            <option value="toddler">Toddler (1-3 years)</option>
                            <option value="preschool">Preschool (3-5 years)</option>
                            <option value="school">School Age (6-12 years)</option>
                            <option value="teen">Teen (13+ years)</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="price-filter">Price Range:</label>
                        <select id="price-filter">
                            <option value="">All Prices</option>
                            <option value="0-3000">Under LKR 3,000</option>
                            <option value="3000-5000">LKR 3,000 - 5,000</option>
                            <option value="5000-7000">LKR 5,000 - 7,000</option>
                            <option value="7000+">Above LKR 7,000</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="size-filter">Size:</label>
                        <select id="size-filter">
                            <option value="">All Sizes</option>
                            <option value="1">Size 1</option>
                            <option value="2">Size 2</option>
                            <option value="3">Size 3</option>
                            <option value="4">Size 4</option>
                            <option value="5">Size 5</option>
                            <option value="6">Size 6</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="brand-filter">Brand:</label>
                        <select id="brand-filter">
                            <option value="">All Brands</option>
                            <option value="City Walk Kids">City Walk Kids</option>
                            <option value="City Walk School">City Walk School</option>
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

        <!-- Kid's Products Section -->
        <section class="products-section">
            <div class="container">
                <!-- Products Grid -->
                <div class="products-grid" id="kids-products-grid">
                    <!-- Products will be populated by JavaScript -->
                </div>
                
                <!-- Load More Button -->
                <div class="load-more-container">
                    <button class="btn-load-more" id="load-more-btn">Load More Products</button>
                </div>
            </div>
        </section>

        <!-- Kid's Categories Showcase -->
        <section class="category-showcase">
            <div class="container">
                <h2 class="section-title">Shop Kid's Categories</h2>
                <div class="showcase-grid">
                    <div class="showcase-card athletic-card">
                        <div class="showcase-content">
                            <i class="fas fa-running"></i>
                            <h3>Athletic & Sports</h3>
                            <p>Active shoes for sports, playground activities, and running around</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('athletic')">Shop Athletic</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card formal-card">
                        <div class="showcase-content">
                            <i class="fas fa-graduation-cap"></i>
                            <h3>School & Formal</h3>
                            <p>Durable school shoes and formal footwear for special occasions</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('formal')">Shop School</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card sandals-card">
                        <div class="showcase-content">
                            <i class="fas fa-umbrella-beach"></i>
                            <h3>Sandals & Summer</h3>
                            <p>Breathable sandals perfect for summer fun and beach activities</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('sandals')">Shop Sandals</button>
                        </div>
                    </div>
                    
                    <div class="showcase-card boots-card">
                        <div class="showcase-content">
                            <i class="fas fa-snowflake"></i>
                            <h3>Boots & Winter</h3>
                            <p>Warm, waterproof boots to keep little feet cozy in cold weather</p>
                            <button class="btn-showcase" onclick="filterBySubCategory('boots')">Shop Boots</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kid's Size Guide Section -->
        <section class="size-guide-section">
            <div class="container">
                <h2 class="section-title">Kid's Size Guide</h2>
                <div class="size-guide-content" id="size-guide">
                    <div class="size-chart">
                        <table class="size-table" >
                            <thead>
                                <tr>
                                    <th>US Size</th>
                                    <th>UK Size</th>
                                    <th>EU Size</th>
                                    <th>Age Range</th>
                                    <th>Foot Length (cm)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>13.5</td>
                                    <td>32</td>
                                    <td>2-3 years</td>
                                    <td>19.7</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>1.5</td>
                                    <td>33</td>
                                    <td>3-4 years</td>
                                    <td>20.3</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>2.5</td>
                                    <td>34</td>
                                    <td>4-5 years</td>
                                    <td>21.0</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>3.5</td>
                                    <td>35</td>
                                    <td>5-6 years</td>
                                    <td>21.6</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>4.5</td>
                                    <td>36</td>
                                    <td>6-7 years</td>
                                    <td>22.2</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>5.5</td>
                                    <td>37</td>
                                    <td>7-8 years</td>
                                    <td>22.9</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="size-tips">
                        <h4>Kid's Sizing Tips:</h4>
                        <ul>
                            <li>Check both feet - children's feet can vary significantly</li>
                            <li>Allow 1-1.5cm growing room for developing feet</li>
                            <li>Measure feet regularly as kids grow quickly</li>
                            <li>Consider the thickness of socks your child wears</li>
                            <li>Look for adjustable features like velcro or laces</li>
                            <li>Replace shoes when they become too tight or worn</li>
                            <li>Prioritize comfort and foot health over fashion</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Foot Health Section -->
        <section class="foot-health-section">
            <div class="container">
                <h2 class="section-title">Healthy Feet, Happy Kids</h2>
                <div class="health-tips-grid">
                    <div class="health-tip">
                        <i class="fas fa-heart"></i>
                        <h4>Proper Development</h4>
                        <p>Well-fitted shoes support natural foot development and prevent future problems. Growing feet need room to move and breathe.</p>
                    </div>
                    <div class="health-tip">
                        <i class="fas fa-shield-alt"></i>
                        <h4>Protection & Support</h4>
                        <p>Quality shoes protect little feet from injuries while providing the right amount of support for active play.</p>
                    </div>
                    <div class="health-tip">
                        <i class="fas fa-thermometer-half"></i>
                        <h4>Breathability</h4>
                        <p>Breathable materials keep feet dry and comfortable, preventing odors and fungal infections in active children.</p>
                    </div>
                    <div class="health-tip">
                        <i class="fas fa-ruler"></i>
                        <h4>Regular Sizing</h4>
                        <p>Children's feet grow rapidly. Check shoe fit every 2-3 months to ensure proper development and comfort.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Parent Guide Section -->
        <section class="parent-guide-section">
            <div class="container">
                <h2 class="section-title">Parent's Buying Guide</h2>
                <div class="guide-content">
                    <div class="guide-section">
                        <h3>What to Look For</h3>
                        <ul class="guide-list">
                            <li><strong>Flexible Soles:</strong> Allow natural foot movement and development</li>
                            <li><strong>Breathable Materials:</strong> Keep feet dry and comfortable all day</li>
                            <li><strong>Adjustable Closures:</strong> Velcro, laces, or buckles for secure fit</li>
                            <li><strong>Rounded Toe Box:</strong> Gives toes room to move and grow naturally</li>
                            <li><strong>Non-Slip Soles:</strong> Prevent slips and falls during active play</li>
                        </ul>
                    </div>
                    <div class="guide-section">
                        <h3>When to Replace</h3>
                        <ul class="guide-list">
                            <li><strong>Tight Fit:</strong> If toes touch the front or sides of shoes</li>
                            <li><strong>Worn Soles:</strong> When tread patterns are completely worn down</li>
                            <li><strong>Damaged Structure:</strong> Holes, tears, or broken support features</li>
                            <li><strong>Regular Growth:</strong> Every 4-6 months for rapidly growing children</li>
                            <li><strong>Discomfort Signs:</strong> Blisters, red marks, or complaints of pain</li>
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
                        <li><a href="kids.php">Kid's Footwear</a></li>
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
    <script src="js/kids.js"></script>
    
</body>
</html>
