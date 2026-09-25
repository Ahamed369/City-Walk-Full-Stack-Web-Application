<aside class="admin-sidebar" id="admin-sidebar">
    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li>
                <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="sidebar-section">
                <h4 class="sidebar-section-title">Product Management</h4>
            </li>
            <li>
                <a href="products.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="add-product.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'add-product.php' ? 'active' : ''; ?>">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="categories.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="brands.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'brands.php' ? 'active' : ''; ?>">
                    <i class="fas fa-copyright"></i>
                    <span>Brands</span>
                </a>
            </li>
            
            <li class="sidebar-section">
                <h4 class="sidebar-section-title">Order Management</h4>
            </li>
            <li>
                <a href="orders.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-cart"></i>
                    <span>All Orders</span>
                </a>
            </li>
            
            <li class="sidebar-section">
                <h4 class="sidebar-section-title">User Management</h4>
            </li>
            <li>
                <a href="customers.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'customers.php' ? 'active' : ''; ?>">
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="admins.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'admins.php' ? 'active' : ''; ?>">
                    <i class="fas fa-user-shield"></i>
                    <span>Administrators</span>
                </a>
            </li>
            
            <li class="sidebar-section">
                <h4 class="sidebar-section-title">Content Management</h4>
            </li>
            <li>
                <a href="faqs.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'faqs.php' ? 'active' : ''; ?>">
                    <i class="fas fa-question-circle"></i>
                    <span>FAQs</span>
                </a>
            </li>
            <li>
                <a href="cms-pages.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'cms-pages.php' ? 'active' : ''; ?>">
                    <i class="fas fa-file-alt"></i>
                    <span>CMS Pages</span>
                </a>
            </li>
            <li>
                <a href="banners.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'banners.php' ? 'active' : ''; ?>">
                    <i class="fas fa-image"></i>
                    <span>Banners</span>
                </a>
            </li>
            <li>
                <a href="promotions.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'promotions.php' ? 'active' : ''; ?>">
                    <i class="fas fa-percent"></i>
                    <span>Promotions</span>
                </a>
            </li>
            
            <li class="sidebar-section">
                <h4 class="sidebar-section-title">Other</h4>
            </li>
            <li>
                <a href="reviews.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'reviews.php' ? 'active' : ''; ?>">
                    <i class="fas fa-star"></i>
                    <span>Reviews</span>
                </a>
            </li>
            <li>
                <a href="newsletter.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'newsletter.php' ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Newsletter</span>
                </a>
            </li>
            <li>
                <a href="activity-log.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'activity-log.php' ? 'active' : ''; ?>">
                    <i class="fas fa-history"></i>
                    <span>Activity Log</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>