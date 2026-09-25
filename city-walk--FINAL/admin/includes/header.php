<header class="admin-header">
    <div class="admin-header-content">
        <div class="admin-logo">
            <a href="index.php">
                <span>City Walk Admin</span>
            </a>
            <div style="display: flex; gap: 6px; margin-left: 25px;">
                <img src="../assets/icons/womens.png" alt="Women" style="width: 20px; height: 20px; object-fit: contain;">
                <img src="../assets/icons/flat-shoes.png" alt="Shoes" style="width: 20px; height: 20px; object-fit: contain;">
                <img src="../assets/icons/slippers.png" alt="Slippers" style="width: 20px; height: 20px; object-fit: contain;">
                <img src="../assets/icons/sandal.png" alt="Sandals" style="width: 20px; height: 20px; object-fit: contain;">
            </div>
        </div>
        
        <div class="admin-header-actions">
            <a href="../index.php" class="btn-view-site" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>View Site</span>
            </a>
            
            <div class="admin-user-menu">
                <button class="admin-user-btn" id="admin-user-btn">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="admin-user-dropdown" id="admin-user-dropdown">
                    <a href="profile.php"><i class="fas fa-user"></i> My Profile</a>
                    <a href="change-password.php"><i class="fas fa-key"></i> Change Password</a>
                    <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                    <hr>
                    <a href="#" onclick="logoutAdmin()"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
