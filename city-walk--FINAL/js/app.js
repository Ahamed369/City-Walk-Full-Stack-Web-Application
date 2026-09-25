// City Walk - Main JavaScript Application (Database Connected with All Modals)
// Author: SA25610227 - M.H. Aazim
// Module: Web Application Development - IT1201

// Global variables for application state
let currentUser = null;
let shoppingCart = [];
let allProducts = [];
let currentPage = 1;
const productsPerPage = 8;

// API Base URL
const API_BASE_URL = window.location.origin + '/city-walk/api/';

// footwearProducts array - will be loaded from database
let footwearProducts = [];


// Get user-specific cart key
function getCartKey() {
    return currentUser ? `cart_user_${currentUser.id}` : 'cart_guest';
}

// Load products from database
async function loadProductsFromDatabase() {
    try {
        console.log('Loading products from database...');
        const response = await fetch(API_BASE_URL + 'products.php');
        const data = await response.json();
        
        if (data.success) {
            footwearProducts = data.products;
            allProducts = [...footwearProducts];
            
            // Update window.CityWalk
            if (window.CityWalk) {
                window.CityWalk.allProducts = allProducts;
            }
            
            console.log('Loaded ' + footwearProducts.length + ' products from database');
            
            // Re-render if on homepage
            if (isHomePage()) {
                renderFeaturedProducts();
            }
            
            return footwearProducts;
        } else {
            console.error('Failed to load products:', data.message);
            showNotification('Failed to load products. Please refresh.', 'error');
            return [];
        }
    } catch (error) {
        console.error('Error loading products:', error);
        showNotification('Database connection error. Please check your setup.', 'error');
        return [];
    }
}

// Initialize the application when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

// Main initialization function - Sets up the entire application
function initializeApp() {
    console.log('Initializing City Walk App...');
    
    // LOAD PRODUCTS FROM DATABASE FIRST
    loadProductsFromDatabase().then(() => {
        // Update window.CityWalk.allProducts immediately
        if (window.CityWalk) {
            window.CityWalk.allProducts = allProducts;
        }

        // Copy products to global variable
        allProducts = [...footwearProducts];
        
        // Load user and cart data from browser storage
        loadUserFromStorage();
        loadCartFromStorage();
        
        // Set up all interactive elements
        setupEventListeners();
        
        // Render products on homepage
        if (isHomePage()) {
            renderFeaturedProducts();
        }
        
        // Render category products
        if (document.getElementById('mens-products-grid')) {
            const mens = footwearProducts.filter(p => p.category === 'men');
            renderProducts(mens);
        }

        if (document.getElementById('womens-products-grid')) {
            const womens = footwearProducts.filter(p => p.category === 'women');
            renderProducts(womens);
        }

        if (document.getElementById('kids-products-grid')) {
            const kids = footwearProducts.filter(p => p.category === 'kids');
            renderProducts(kids);
        }
        
        // Update displays with current data
        updateCartDisplay();
        updateAuthDisplay();
        
        // Setup smooth scrolling for anchor links
        setupSmoothScrolling();
        
        // Export to window.CityWalk (do this last to ensure everything is initialized)
        window.CityWalk = {
            allProducts: allProducts,
            addToCart,
            viewProduct,
            showNotification,
            filterProductsByCategory,
            renderProducts,
            createProductCard,
            setupProductCardListeners,
            generateStars,
            sortProducts,
            filterByPriceRange,
            applyFilters: function() { return applyFilters(); }
        };
        
        console.log('City Walk App initialized successfully');
        console.log('Total products available:', allProducts.length);
    });
}

// Check if current page is homepage
function isHomePage() {
    return window.location.pathname.endsWith('index.html') || 
           window.location.pathname.endsWith('index.php') ||
           window.location.pathname === '/' || 
           window.location.pathname.split('/').pop() === '';
}

// Set up all event listeners for interactive elements
function setupEventListeners() {
    // Mobile hamburger menu toggle
    const hamburger = document.getElementById('hamburger');
    if (hamburger) {
        hamburger.addEventListener('click', toggleMobileMenu);
    }
    
    // Close mobile menu when clicking nav links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            const navMenu = document.querySelector('.nav-menu');
            const hamburgerBtn = document.getElementById('hamburger');
            
            if (navMenu && navMenu.classList.contains('mobile-active')) {
                navMenu.classList.remove('mobile-active');
                if (hamburgerBtn) {
                    hamburgerBtn.classList.remove('active');
                }
            }
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        const navMenu = document.querySelector('.nav-menu');
        const hamburgerBtn = document.getElementById('hamburger');
        const navContainer = document.querySelector('.nav-container');
        
        if (navMenu && navMenu.classList.contains('mobile-active') &&
            !navContainer.contains(e.target)) {
            navMenu.classList.remove('mobile-active');
            if (hamburgerBtn) {
                hamburgerBtn.classList.remove('active');
            }
        }
    });
    
    // Search functionality
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');
    if (searchBtn) searchBtn.addEventListener('click', performSearch);
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') performSearch();
        });
    }
    
    // Authentication buttons
    const loginBtn = document.getElementById('login-btn');
    const signupBtn = document.getElementById('signup-btn');
    if (loginBtn) loginBtn.addEventListener('click', () => showAuthModal('login'));
    if (signupBtn) signupBtn.addEventListener('click', () => showAuthModal('signup'));
    
    // Shopping cart
    const cartBtn = document.getElementById('cart-btn');
    if (cartBtn) cartBtn.addEventListener('click', showCartModal);
    
    // Category cards - only on homepage
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Only handle clicks that aren't already links
            if (this.tagName === 'A') return;
            
            e.preventDefault();
            const category = this.dataset.category;
            if (category) {
                // Redirect to category page
                window.location.href = `${category}.html`;
            }
        });
    });
}

// Render featured products on homepage
function renderFeaturedProducts() {
    const featuredGrid = document.getElementById('featured-products-grid');
    if (!featuredGrid) return;
    
    // Get featured products (first 6 products)
    const featuredProducts = allProducts.slice(0, 6);
    
    featuredGrid.innerHTML = featuredProducts.map(product => createProductCard(product)).join('');
    setupProductCardListeners();
}

// Updated createProductCard function to use images
function createProductCard(product) {
    return `
        <div class="product-card" data-id="${product.id}">
            <div class="product-image">
                ${product.image ? 
                    `<img src="${product.image}" alt="${product.imageAlt || product.name}" 
                          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                     <i class="fas fa-shoe-prints" style="display:none;"></i>` 
                    : 
                    `<i class="fas fa-shoe-prints"></i>`
                }
                ${product.badge ? `<div class="product-badge">${product.badge}</div>` : ''}
            </div>
            <div class="product-info">
                ${product.brand ? `<div class="product-brand">${product.brand}</div>` : ''}
                <h3>${product.name}</h3>
                <div class="product-price">LKR ${product.price.toLocaleString()}</div>
                <div class="product-rating">
                    <div class="stars">${generateStars(product.rating)}</div>
                    <span class="rating-text">(${product.reviews})</span>
                </div>
                <div class="product-actions">
                    <button class="btn-add-cart" onclick="addToCart(${product.id})">
                        Add to Cart
                    </button>
                    <button class="btn-view" onclick="viewProduct(${product.id})">
                        View Details
                    </button>
                </div>
            </div>
        </div>
    `;
}

// Render products on category pages
function renderProducts(products) {
    const productsGrid = document.getElementById('products-grid') || 
                        document.getElementById('mens-products-grid') || 
                        document.getElementById('womens-products-grid') || 
                        document.getElementById('kids-products-grid');
    
    if (!productsGrid) return;
    
    productsGrid.innerHTML = products.map(product => createProductCard(product)).join('');
    setupProductCardListeners();
    
    // Update results count
    const resultsCount = document.getElementById('results-count');
    if (resultsCount) {
        resultsCount.textContent = `Showing ${products.length} products`;
    }
}

// Add CSS styles for modals
function addModalStyles() {
    if (document.getElementById('modal-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'modal-styles';
    styles.textContent = `
        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
        }
        
        .product-brand {
            color: #86868b;
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .product-description {
            color: #86868b;
            line-height: 1.6;
            margin: 16px 0;
        }
        
        .product-options {
            margin: 24px 0;
        }
        
        .size-selector, .color-selector {
            margin-bottom: 16px;
            margin-right: 16px;
        }
        
        .size-selector label, .color-selector label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1d1d1f;
        }
        
        .size-selector select, .color-selector select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d2d2d7;
            border-radius: 8px;
            font-size: 16px;
            background: white;
        }
        
        .product-features h4 {
            color: #1d1d1f;
            margin-bottom: 12px;
        }
        
        .product-features ul {
            list-style: none;
            padding: 0;
        }
        
        .product-features li {
            padding: 4px 0;
            color: #86868b;
        }
        
        .product-features li:before {
            content: "✓ ";
            color: #1d1d1f;
            font-weight: bold;
        }
        
        .stock-info {
            margin: 16px 0;
        }
        
        .stock-count {
            color: #86868b;
            font-size: 14px;
        }
        
        .modal-actions {
            margin-top: 24px;
        }
        
        .btn-add-cart:disabled {
            background: #d2d2d7 !important;
            color: #86868b !important;
            cursor: not-allowed !important;
        }
        
        @media (max-width: 768px) {
            .product-detail-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    `;
    document.head.appendChild(styles);
}

// Close modal function
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.remove();
    }
}

// Show product details in a modal window
function showProductModal(product) {
    const modalHtml = `
        <div class="modal-overlay" id="product-modal" onclick="closeModal('product-modal')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>${product.name}</h2>
                    <button class="modal-close" onclick="closeModal('product-modal')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="product-detail-grid">
                        <div class="product-detail-image">
                            ${product.image ? 
                                `<img src="${product.image}" alt="${product.imageAlt || product.name}" 
                                      onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                 <i class="fas fa-shoe-prints" style="display:none;"></i>` 
                                : 
                                `<i class="fas fa-shoe-prints"></i>`
                            }
                        </div>
                        <div class="product-detail-info">
                            <div class="product-brand">${product.brand}</div>
                            <div class="product-price">LKR ${product.price.toLocaleString()}</div>
                            <div class="product-rating">
                                <div class="stars">${generateStars(product.rating)}</div>
                                <span>(${product.reviews} reviews)</span>
                            </div>
                            <div class="product-description">${product.description}</div>
                            
                            <div class="product-options">
                                <div class="size-selector">
                                    <label>Size:</label>
                                    <select id="size-select">
                                        ${product.sizes.map(size => `<option value="${size}">${size}</option>`).join('')}
                                    </select>
                                </div>
                                <div class="color-selector">
                                    <label>Color:</label>
                                    <select id="color-select">
                                        ${product.colors.map(color => `<option value="${color}">${color}</option>`).join('')}
                                    </select>
                                </div>
                            </div>
                            
                            <div class="product-features">
                                <h4>Features:</h4>
                                <ul>
                                    ${product.features.map(feature => `<li>${feature}</li>`).join('')}
                                </ul>
                            </div>
                            
                            <div class="stock-info">
                                <span class="stock-count">${product.stock > 0 ? `${product.stock} in stock` : 'Out of stock'}</span>
                            </div>
                            
                            <div class="modal-actions">
                                <button class="btn-add-cart" onclick="addToCart(${product.id}); closeModal('product-modal');" ${product.stock <= 0 ? 'disabled' : ''}>
                                    ${product.stock > 0 ? 'Add to Cart' : 'Out of Stock'}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    addModalStyles();
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

// View detailed product information in modal
function viewProduct(productId) {
    const product = allProducts.find(p => p.id === productId);
    if (!product) return;
    
    // Create and show product detail modal
    showProductModal(product);
}

// Generate star rating display based on numeric rating
function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    let stars = '';
    
    // Add full stars
    for (let i = 0; i < fullStars; i++) {
        stars += '<i class="fas fa-star"></i>';
    }
    
    // Add half star if needed
    if (hasHalfStar) {
        stars += '<i class="fas fa-star-half-alt"></i>';
    }
    
    // Add empty stars to complete 5-star rating
    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
        stars += '<i class="far fa-star"></i>';
    }
    
    return stars;
}

// Set up click listeners for product cards
function setupProductCardListeners() {
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Only open product details if not clicking on buttons
            if (!e.target.closest('button')) {
                const productId = parseInt(this.dataset.id);
                viewProduct(productId);
            }
        });
    });
}

// Add product to shopping cart
function addToCart(productId) {
    const product = allProducts.find(p => p.id === productId);

    //check if the product exists
    if (!product) {
        showNotification('Product not found', 'error');
        return;
    }
    
    // Check stock availability
    if (product.stock <= 0) {
        showNotification('Sorry, this item is out of stock', 'error');
        return;
    }
    
    // Check if product already exists in cart
    const existingItem = shoppingCart.find(item => item.id === productId);
    
    if (existingItem) {
        // Check if adding one more exceeds stock
        if (existingItem.quantity >= product.stock) {
            showNotification('Maximum stock quantity reached', 'warning');
            return;
        }
        // Increase quantity if product already in cart
        existingItem.quantity += 1;
    } else {
        // Add new product to cart
        shoppingCart.push({
            ...product,
            quantity: 1
        });
    }
    
    // Update displays and save to storage
    updateCartDisplay();
    saveCartToStorage();
    showNotification(`${product.name} added to cart!`, 'success');
}

// Updated showCartModal function with product images
function showCartModal() {
    if (shoppingCart.length === 0) {
        showNotification('Your cart is empty!', 'info');
        return;
    }
    
    const cartTotal = shoppingCart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    const modalHtml = `
        <div class="modal-overlay" id="cart-modal" onclick="closeModal('cart-modal')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>Shopping Cart</h2>
                    <button class="modal-close" onclick="closeModal('cart-modal')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="cart-items">
                        ${shoppingCart.map(item => `
                            <div class="cart-item">
                                <div class="cart-item-image" style="cursor: pointer;" onclick="closeModal('cart-modal'); viewProduct(${item.id});">
                                    ${item.image ? 
                                        `<img src="${item.image}" alt="${item.imageAlt || item.name}" 
                                              onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                         <i class="fas fa-shoe-prints" style="display:none;"></i>` 
                                        : 
                                        `<i class="fas fa-shoe-prints"></i>`
                                    }
                                </div>
                                <div class="cart-item-info">
                                    <h4>${item.name}</h4>
                                    <div class="cart-item-price">LKR ${item.price.toLocaleString()}</div>
                                    <div class="cart-item-brand">${item.brand}</div>
                                </div>
                                <div class="cart-item-controls">
                                    <button onclick="updateCartQuantity(${item.id}, ${item.quantity - 1})">-</button>
                                    <span>${item.quantity}</span>
                                    <button onclick="updateCartQuantity(${item.id}, ${item.quantity + 1})">+</button>
                                    <button onclick="removeFromCart(${item.id})" class="remove-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    <div class="cart-summary">
                        <div class="cart-total">
                            <strong>Total: LKR ${cartTotal.toLocaleString()}</strong>
                        </div>
                        <div class="cart-actions">
                            <button class="btn-secondary" onclick="clearCart()">Clear Cart</button>
                            <button class="btn-add-cart" onclick="checkout()">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    addCartStyles();
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

// Add cart-specific styles
function addCartStyles() {
    if (document.getElementById('cart-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'cart-styles';
    styles.textContent = `
        .modal-body {
            padding: 0 !important;
            display: flex;
            flex-direction: column;
            max-height: 70vh;
        }
        
        .cart-items {
            max-height: 400px;
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            min-height: 0;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .cart-item-image {
            width: 80px;
            height: 80px;
            background: #f5f5f7;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #86868b;
            flex-shrink: 0;
            overflow: hidden;
            padding: 8px;
        }
        
        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 4px;
        }
        
        .cart-item-image i {
            font-size: 24px;
            color: #86868b;
        }
        
        .cart-item-info {
            flex: 1;
        }
        
        .cart-item-info h4 {
            margin: 0 0 4px 0;
            color: #1d1d1f;
        }
        
        .cart-item-brand {
            font-size: 12px;
            color: #86868b;
        }
        
        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .cart-item-controls button {
            width: 32px;
            height: 32px;
            border: 1px solid #d2d2d7;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .remove-btn {
            background: #ff3b30 !important;
            color: white !important;
            border-color: #ff3b30 !important;
        }
        
        .cart-summary {
            border-top: 2px solid #f0f0f0;
            padding: 24px;
            text-align: center;
            background: white;
            flex-shrink: 0;
        }
        
        .cart-total {
            font-size: 20px;
            margin-bottom: 20px;
            color: #1d1d1f;
        }
        
        .cart-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        
        .btn-secondary {
            background: #c5bbbb;
            color: #1d1d1f;
            border: none;
            padding: 14px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }
    `;
    document.head.appendChild(styles);
}

// Update cart item quantity
function updateCartQuantity(productId, newQuantity) {
    if (newQuantity <= 0) {
        removeFromCart(productId);
        return;
    }
    
    const item = shoppingCart.find(item => item.id === productId);
    const product = allProducts.find(p => p.id === productId);
    
    if (item && product) {
        // Check stock availability
        if (newQuantity > product.stock) {
            showNotification('Not enough stock available', 'warning');
            return;
        }
        
        item.quantity = newQuantity;
        updateCartDisplay();
        saveCartToStorage();
        
        // Refresh cart modal if open
        const cartModal = document.getElementById('cart-modal');
        if (cartModal) {
            closeModal('cart-modal');
            showCartModal();
        }
    }
}

// Remove item from cart
function removeFromCart(productId) {
    shoppingCart = shoppingCart.filter(item => item.id !== productId);
    updateCartDisplay();
    saveCartToStorage();
    
    // Refresh cart modal if open
    const cartModal = document.getElementById('cart-modal');
    if (cartModal) {
        closeModal('cart-modal');
        if (shoppingCart.length > 0) {
            showCartModal();
        } else {
            showNotification('Cart is now empty', 'info');
        }
    }
}

// Clear entire shopping cart
function clearCart() {
    shoppingCart = [];
    const cartKey = getCartKey();
    localStorage.removeItem(cartKey);
    updateCartDisplay();
    closeModal('cart-modal');
    showNotification('Cart cleared', 'info');
}

// Update cart count display in header
function updateCartDisplay() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        const totalItems = shoppingCart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
    }
}

// Proceed to checkout with API
async function checkout() {
    if (shoppingCart.length === 0) {
        showNotification('Your cart is empty!', 'error');
        return;
    }
    
    if (!currentUser) {
        closeModal('cart-modal');
        showAuthModal('login');
        showNotification('Please sign in to proceed with checkout', 'info');
        return;
    }
    
    // Calculate total
    const total = shoppingCart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    try {
        // Show loading notification
        showNotification('Processing your order...', 'info');
        
        // Call API to create order
        const response = await fetch(API_BASE_URL + 'create-order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                items: shoppingCart.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    quantity: item.quantity
                })),
                total: total,
                customerName: currentUser.name,
                customerEmail: currentUser.email,
                customerPhone: currentUser.phone || '',
                shippingAddress: '',
                shippingCity: 'Colombo',
                shippingPostalCode: ''
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Create order object for local storage
            const order = {
                orderNumber: data.orderNumber,
                orderId: data.orderId,
                items: [...shoppingCart],
                total: total,
                date: new Date().toISOString(),
                status: 'Processing',
                paymentMethod: 'Cash on Delivery',
                customerEmail: currentUser.email,
                customerName: currentUser.name
            };
            
            // Add to user's order history
            addToOrderHistory(order);
            
            // Clear cart
            clearCart();
            closeModal('cart-modal');
            
            // Show success message
            showOrderConfirmation(order);
        } else {
            showNotification(data.message || 'Order placement failed', 'error');
        }
    } catch (error) {
        console.error('Checkout error:', error);
        showNotification('Failed to place order. Please try again.', 'error');
    }
}


// Save cart data to localStorage
function saveCartToStorage() {
    const cartKey = getCartKey();
    localStorage.setItem(cartKey, JSON.stringify(shoppingCart));
}

// Load cart data from localStorage
function loadCartFromStorage() {
    const cartKey = getCartKey();
    const savedCart = localStorage.getItem(cartKey);
    if (savedCart) {
        try {
            shoppingCart = JSON.parse(savedCart);
        } catch (error) {
            console.error('Error loading cart from storage:', error);
            localStorage.removeItem(cartKey);
            shoppingCart = [];
        }
    }
}

// Show order confirmation modal
function showOrderConfirmation(order) {
    const modalHtml = `
        <div class="modal-overlay" id="order-confirmation" onclick="closeModal('order-confirmation')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>Order Confirmed!</h2>
                    <button class="modal-close" onclick="closeModal('order-confirmation')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="order-success">
                        <i class="fas fa-check-circle"></i>
                        <h3>Thank you for your order!</h3>
                        <div class="order-details">
                            <p><strong>Order Number:</strong> ${order.orderNumber}</p>
                            <p><strong>Total Amount:</strong> LKR ${order.total.toLocaleString()}</p>
                            <p><strong>Payment Method:</strong> ${order.paymentMethod}</p>
                            <p><strong>Estimated Delivery:</strong> 3-5 business days</p>
                        </div>
                        <div class="order-items">
                            <h4>Items Ordered:</h4>
                            ${order.items.map(item => `
                                <div class="order-item">
                                    ${item.name} - Qty: ${item.quantity} - LKR ${(item.price * item.quantity).toLocaleString()}
                                </div>
                            `).join('')}
                        </div>
                        <div class="order-actions">
                            <button class="btn-add-cart" onclick="closeModal('order-confirmation')">Continue Shopping</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    addOrderStyles();
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

// Add order confirmation styles
function addOrderStyles() {
    if (document.getElementById('order-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'order-styles';
    styles.textContent = `
        .order-success {
            text-align: center;
            padding: 20px;
        }
        
        .order-success i {
            font-size: 64px;
            color: #28a745;
            margin-bottom: 20px;
        }
        
        .order-success h3 {
            color: #1d1d1f;
            margin-bottom: 20px;
        }
        
        .order-details {
            background: #f5f5f7;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
        }
        
        .order-details p {
            margin-bottom: 8px;
            color: #1d1d1f;
        }
        
        .order-items {
            text-align: left;
            margin-bottom: 20px;
        }
        
        .order-items h4 {
            color: #1d1d1f;
            margin-bottom: 12px;
        }
        
        .order-item {
            padding: 8px 0;
            color: #86868b;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .order-actions {
            margin-top: 20px;
        }
    `;
    document.head.appendChild(styles);
}

// Add order to user's history (simulate database storage)
function addToOrderHistory(order) {
    //Checks if the current user exists
    if (!currentUser) return;
    
    //initialize orders arry if dosen't exists
    if (!currentUser.orders) {
        currentUser.orders = [];
    }
    
    currentUser.orders.unshift(order);
    saveUserToStorage();
}

// Show authentication modal (login/signup) - VALIDATIONS IN HTML
function showAuthModal(type) {
    const isLogin = type === 'login';
    const modalHtml = `
        <div class="modal-overlay" id="auth-modal" onclick="closeModal('auth-modal')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>${isLogin ? 'Sign In' : 'Sign Up'}</h2>
                    <button class="modal-close" onclick="closeModal('auth-modal')">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="auth-form">
                        ${!isLogin ? `
                            <div class="form-group">
                                <label>Full Name</label>
                                <input 
                                    type="text" 
                                    id="auth-name" 
                                    required
                                    minlength="2"
                                    maxlength="100"
                                    pattern="[A-Za-z\\s]+"
                                    title="Please enter your full name (letters and spaces only)"
                                    placeholder="John Doe">
                            </div>
                        ` : ''}
                        <div class="form-group">
                            <label>Email</label>
                            <input 
                                type="email" 
                                id="auth-email" 
                                required
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,}$"
                                title="Please enter a valid email address"
                                placeholder="your.email@example.com">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input 
                                type="password" 
                                id="auth-password" 
                                required
                                minlength="6"
                                maxlength="50"
                                title="Password must be at least 6 characters"
                                placeholder="${isLogin ? 'Enter your password' : 'Create a password (min 6 characters)'}">
                        </div>
                        ${!isLogin ? `
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input 
                                    type="password" 
                                    id="auth-confirm" 
                                    required
                                    minlength="6"
                                    maxlength="50"
                                    title="Please confirm your password"
                                    placeholder="Re-enter your password">
                            </div>
                        ` : ''}
                        <button type="submit" class="btn-add-cart">
                            ${isLogin ? 'Sign In' : 'Sign Up'}
                        </button>
                        <p class="auth-switch">
                            ${isLogin ? "Don't have an account?" : "Already have an account?"}
                            <a href="#" onclick="switchAuthMode()">${isLogin ? 'Sign Up' : 'Sign In'}</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    `;
    
    addAuthStyles();
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Set up form submission handler - HTML5 validates automatically
    document.getElementById('auth-form').addEventListener('submit', function(e) {
        e.preventDefault();
        handleAuth(isLogin);
    });
    
    // Clear custom validation on password change for signup
    if (!isLogin) {
        document.getElementById('auth-confirm').addEventListener('input', function() {
            this.setCustomValidity('');
        });
    }
}

// Add authentication (Login, Sign up) form styles
function addAuthStyles() {
    if (document.getElementById('auth-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'auth-styles';
    styles.textContent = `
        #auth-modal .modal-content {
            max-width: 500px;
        }
        
        #auth-modal .modal-body {
            padding: 24px !important;
        }
        
        #auth-form {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1d1d1f;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d2d2d7;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.2s ease;
            box-sizing: border-box;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #1d1d1f;
        }
        
        #auth-form .btn-add-cart {
            width: 100%;
            margin-top: 8px;
            padding: 14px;
            font-size: 16px;
        }
        
        .auth-switch {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            color: #86868b;
            font-size: 14px;
            border-top: 1px solid #f0f0f0;
        }
        
        .auth-switch a {
            color: #1d1d1f;
            text-decoration: none;
            font-weight: 600;
            margin-left: 6px;
        }
        
        .auth-switch a:hover {
            text-decoration: underline;
        }
    `;
    document.head.appendChild(styles);
}

// Handle authentication form submission with backend API
async function handleAuth(isLogin) {
    const form = document.getElementById('auth-form');
    
    // Check HTML5 validation
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    const email = document.getElementById('auth-email').value;
    const password = document.getElementById('auth-password').value;
    
    if (isLogin) {
        // Call backend login API
        try {
            const response = await fetch(API_BASE_URL + 'login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: email,
                    password: password
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                currentUser = {
                    name: data.user.first_name || email.split('@')[0],
                    email: data.user.email,
                    userType: data.user.user_type,
                    userId: data.user.user_id,
                    joinDate: new Date().toISOString(),
                    orders: []
                };
                
                saveUserToStorage();
                loadCartFromStorage();
                updateAuthDisplay();
                closeModal('auth-modal');
                
                showNotification(`Welcome back, ${currentUser.name}!`, 'success');
                
                // Redirect admin to admin panel
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                }
            } else {
                showNotification(data.message || 'Login failed. Please check your credentials.', 'error');
            }
        } catch (error) {
            console.error('Login error:', error);
            showNotification('Login failed. Please try again.', 'error');
        }
    } else {
        // Signup process
        const name = document.getElementById('auth-name').value;
        const confirm = document.getElementById('auth-confirm').value;
        
        // Check password match (HTML5 can't do this automatically)
        if (password !== confirm) {
            document.getElementById('auth-confirm').setCustomValidity('Passwords do not match');
            form.reportValidity();
            return;
        }
        
        // Call backend register API
        try {
            const response = await fetch(API_BASE_URL + 'register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: email.split('@')[0],
                    email: email,
                    password: password,
                    firstName: name.trim().split(' ')[0],
                    lastName: name.trim().split(' ').slice(1).join(' ') || 'User',
                    phone: null
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showNotification('Registration successful! Please login.', 'success');
                closeModal('auth-modal');
                setTimeout(() => {
                    showAuthModal('login');
                }, 1000);
            } else {
                showNotification(data.message || 'Registration failed', 'error');
            }
        } catch (error) {
            console.error('Registration error:', error);
            showNotification('Registration failed. Please try again.', 'error');
        }
    }
}

// Switch between login and signup modes without closing the modal
function switchAuthMode() {
    closeModal('auth-modal');
    const currentModal = document.getElementById('auth-modal');
    const isCurrentlyLogin = currentModal && currentModal.querySelector('#auth-name') === null;
    setTimeout(() => {
        showAuthModal(isCurrentlyLogin ? 'signup' : 'login');
    }, 100);
}

// Update authentication display based on login status
function updateAuthDisplay() {
    const loginBtn = document.getElementById('login-btn');
    const signupBtn = document.getElementById('signup-btn');
    const authButtons = document.querySelector('.auth-buttons');
    
    // Remove existing admin link if present
    const existingAdminLink = document.getElementById('admin-panel-link');
    if (existingAdminLink) {
        existingAdminLink.remove();
    }
    
    if (currentUser) {
        // User is logged in
        if (loginBtn) {
            loginBtn.textContent = currentUser.name;
            // Clone button to remove ALL event listeners
            const newBtn = loginBtn.cloneNode(true);
            loginBtn.parentNode.replaceChild(newBtn, loginBtn);
            // Add fresh click handler
            newBtn.addEventListener('click', (e) => {
                e.preventDefault();
                showUserMenu();
            });
        }
        
        if (signupBtn) {
            signupBtn.style.display = 'none';
        }
        
        // Add Admin Panel link if user is admin
        if (currentUser.userType === 'admin' && authButtons) {
            const adminLink = document.createElement('button');
            adminLink.className = 'btn-auth';
            adminLink.id = 'admin-panel-link';
            adminLink.innerHTML = '<i class="fas fa-user-shield"></i> &nbsp;Admin Panel';
            adminLink.style.cssText = 'background: #000000ff; color: white; white-space: nowrap; ';
            adminLink.onclick = () => window.location.href = './admin/index.php';
            
            // Get the NEW login button after replacement
            const updatedLoginBtn = document.getElementById('login-btn');
            if (updatedLoginBtn) {
                authButtons.insertBefore(adminLink, updatedLoginBtn);
            }
        }
    } else {
        // User not logged in
        if (loginBtn) {
            loginBtn.textContent = 'Sign In';
            // Clone to remove old listeners
            const newBtn = loginBtn.cloneNode(true);
            loginBtn.parentNode.replaceChild(newBtn, loginBtn);
            // Add auth modal handler
            newBtn.addEventListener('click', () => showAuthModal('login'));
        }
        
        if (signupBtn) {
            signupBtn.style.display = 'inline-block';
        }
    }
}
// Show user menu modal when logged in (name, email,..)
function showUserMenu() {
    const menuHtml = `
        <div class="modal-overlay" id="user-menu" onclick="closeModal('user-menu')">
            <div class="modal-content" onclick="event.stopPropagation()" style="max-width: 300px;">
                <div class="modal-header">
                    <h3>${currentUser.name}</h3>
                    <button class="modal-close" onclick="closeModal('user-menu')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="user-info">
                        <p><strong>Email:</strong> ${currentUser.email}</p>
                        <p><strong>Member since:</strong> ${new Date(currentUser.joinDate).toLocaleDateString()}</p>
                        <p><strong>Total orders:</strong> ${currentUser.orders ? currentUser.orders.length : 0}</p>
                    </div>
                    <div class="user-menu-items">
                        <button class="menu-item" onclick="showOrderHistory()">
                            <i class="fas fa-box"></i> Order History
                        </button>
                        <button class="menu-item" onclick="showNotification('Profile settings coming soon!', 'info')">
                            <i class="fas fa-user"></i> Profile Settings
                        </button>
                        <button class="menu-item" onclick="showNotification('Order tracking coming soon!', 'info')">
                            <i class="fas fa-truck"></i> Track Orders
                        </button>
                        <button class="menu-item" onclick="logout()">
                            <i class="fas fa-sign-out-alt"></i> Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    addUserMenuStyles();
    document.body.insertAdjacentHTML('beforeend', menuHtml);
}

// Add user menu styles
function addUserMenuStyles() {
    if (document.getElementById('user-menu-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'user-menu-styles';
    styles.textContent = `
        .user-info {
            background: #f5f5f7;
            padding: 16px;
            border-radius: 8px;
        }
        
        .user-info p {
            margin-bottom: 8px;
            color: #1d1d1f;
            font-size: 14px;
        }
        
        .user-menu-items {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 8px;
            margin-top: 8px;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            border-radius: 8px;
            transition: background 0.2s ease;
            font-size: 16px;
        }
        
        .menu-item:hover {
            background: #f5f5f7;
        }
        
        .menu-item i {
            width: 20px;
            color: #86868b;
        }
    `;
    document.head.appendChild(styles);
}

// Show user's order history
function showOrderHistory() {
    closeModal('user-menu');
    
    if (!currentUser || !currentUser.orders || currentUser.orders.length === 0) {
        showNotification('No orders found', 'info');
        return;
    }
    
    const modalHtml = `
        <div class="modal-overlay" id="order-history" onclick="closeModal('order-history')">
            <div class="modal-content" onclick="event.stopPropagation()" style="max-width: 700px;">
                <div class="modal-header">
                    <h2>Order History</h2>
                    <button class="modal-close" onclick="closeModal('order-history')">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="orders-list">
                        ${currentUser.orders.map(order => `
                            <div class="order-card">
                                <div class="order-header">
                                    <h4>Order #${order.orderNumber}</h4>
                                    <span class="order-date">${new Date(order.date).toLocaleDateString()}</span>
                                </div>
                                <div class="order-info">
                                    <p><strong>Status:</strong> ${order.status}</p>
                                    <p><strong>Total:</strong> LKR ${order.total.toLocaleString()}</p>
                                    <p><strong>Payment:</strong> ${order.paymentMethod}</p>
                                </div>
                                <div class="order-items-summary">
                                    <h5>Items (${order.items.length}):</h5>
                                    ${order.items.map(item => `
                                        <div class="order-item-summary">
                                            ${item.name} - Qty: ${item.quantity}
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    addOrderHistoryStyles();
    document.body.insertAdjacentHTML('beforeend', modalHtml);
}

// Add order history styles
function addOrderHistoryStyles() {
    if (document.getElementById('order-history-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'order-history-styles';
    styles.textContent = `
        .orders-list {
            max-height: 500px;
            overflow-y: auto;
        }
        
        .order-card {
            background: #f5f5f7;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .order-header h4 {
            color: #1d1d1f;
            margin: 0;
        }
        
        .order-date {
            color: #86868b;
            font-size: 14px;
        }
        
        .order-info {
            margin-bottom: 12px;
        }
        
        .order-info p {
            margin-bottom: 4px;
            color: #1d1d1f;
            font-size: 14px;
        }
        
        .order-items-summary h5 {
            color: #1d1d1f;
            margin-bottom: 8px;
        }
        
        .order-item-summary {
            color: #86868b;
            font-size: 14px;
            padding: 2px 0;
        }
    `;
    document.head.appendChild(styles);
}

// Logout function
function logout() {
    currentUser = null;
    localStorage.removeItem('cityWalkUser');
    loadCartFromStorage(); // ADD THIS LINE
    updateAuthDisplay();
    closeModal('user-menu');
    showNotification('Signed out successfully', 'info');
}

// Search functionality
function performSearch() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase().trim();
    if (!searchTerm) {
        showNotification('Please enter a search term', 'warning');
        return;
    }
    
    // Filter products based on search term
    const filteredProducts = allProducts.filter(product => 
        product.name.toLowerCase().includes(searchTerm) ||
        product.description.toLowerCase().includes(searchTerm) ||
        product.brand.toLowerCase().includes(searchTerm) ||
        product.category.toLowerCase().includes(searchTerm) ||
        product.subCategory.toLowerCase().includes(searchTerm)
    );
    
    if (filteredProducts.length === 0) {
        showNotification('No products found matching your search', 'info');
        return;
    }
    
    // If on homepage, redirect to appropriate category page or show results
    if (isHomePage()) {
        // Store search results and redirect to a results page or show modal
        showSearchResults(filteredProducts, searchTerm);
    } else {
        // Update current page products
        renderProducts(filteredProducts);
        showNotification(`Found ${filteredProducts.length} products for "${searchTerm}"`, 'success');
    }
}

// Show search results modal
function showSearchResults(products, searchTerm) {
    const modalHtml = `
        <div class="modal-overlay" id="search-results" onclick="closeModal('search-results')">
            <div class="modal-content" onclick="event.stopPropagation()" style="max-width: 900px;">
                <div class="modal-header">
                    <h2>Search Results for "${searchTerm}"</h2>
                    <button class="modal-close" onclick="closeModal('search-results')">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="search-summary">Found ${products.length} products</p>
                    <div class="search-products-grid">
                        ${products.map(product => createProductCard(product)).join('')}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    addSearchResultsStyles();
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Setup product card listeners for search results
    setupProductCardListeners();
}

// Add search results styles
function addSearchResultsStyles() {
    if (document.getElementById('search-results-styles')) return;
    
    const styles = document.createElement('style');
    styles.id = 'search-results-styles';
    styles.textContent = `
        .search-summary {
            color: #86868b;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .search-products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-height: 500px;
            overflow-y: auto;
        }
    `;
    document.head.appendChild(styles);
}

// Filter products by category (used by category-specific pages)
function filterProductsByCategory(category) {
    return allProducts.filter(product => product.category === category);
}

// Filter products by subcategory
function filterBySubCategory(subCategory) {
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.value = subCategory;
        applyFilters();
    }
}

// Apply filters (to be implemented in category-specific JS files)
function applyFilters() {
    // This function will be overridden in category-specific JS files
    console.log('Apply filters function called');
}

// Get products by price range
function filterByPriceRange(minPrice, maxPrice) {
    return allProducts.filter(product => 
        product.price >= minPrice && product.price <= maxPrice
    );
}

// Sort products by different criteria
function sortProducts(products, sortBy) {
    switch (sortBy) {
        case 'name':
            return products.sort((a, b) => a.name.localeCompare(b.name));
        case 'price-low':
            return products.sort((a, b) => a.price - b.price);
        case 'price-high':
            return products.sort((a, b) => b.price - a.price);
        case 'rating':
            return products.sort((a, b) => b.rating - a.rating);
        case 'newest':
            return products.sort((a, b) => b.isNew - a.isNew);
        default:
            return products;
    }
}

// Export functions for use in other JS files
window.CityWalk = {
    allProducts,
    addToCart,
    viewProduct,
    showNotification,
    filterProductsByCategory,
    renderProducts,
    createProductCard,
    setupProductCardListeners,
    generateStars,
    sortProducts,
    filterByPriceRange,
    applyFilters: function() { return applyFilters(); }
};

// Toggle mobile menu
function toggleMobileMenu() {
    console.log('Hamburger clicked!');
    const navMenu = document.querySelector('.nav-menu');
    const hamburger = document.getElementById('hamburger');
    
    console.log('navMenu:', navMenu);
    console.log('hamburger:', hamburger);
    
    if (navMenu) {
        navMenu.classList.toggle('mobile-active');
        console.log('Menu classes:', navMenu.classList);
    }
    
    if (hamburger) {
        hamburger.classList.toggle('active');
    }
}

// Setup smooth scrolling for anchor links
function setupSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

// Show notification function with different types
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    // Add icon based on type
    let icon = '';
    switch (type) {
        case 'success':
            icon = '<i class="fas fa-check-circle"></i>';
            break;
        case 'error':
            icon = '<i class="fas fa-exclamation-circle"></i>';
            break;
        case 'warning':
            icon = '<i class="fas fa-exclamation-triangle"></i>';
            break;
        default:
            icon = '<i class="fas fa-info-circle"></i>';
    }
    
    notification.innerHTML = `${icon} ${message}`;
    
    // Add notification styles if not already added
    if (!document.getElementById('notification-styles')) {
        const styles = document.createElement('style');
        styles.id = 'notification-styles';
        styles.textContent = `
            .notification {
                position: fixed;
                top: 100px;
                right: 20px;
                padding: 16px 24px;
                border-radius: 12px;
                font-weight: 500;
                z-index: 3000;
                animation: slideInRight 0.3s ease-out;
                max-width: 350px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .notification-success {
                background: #28a745;
                color: white;
            }
            
            .notification-error {
                background: #dc3545;
                color: white;
            }
            
            .notification-warning {
                background: #ffc107;
                color: #1d1d1f;
            }
            
            .notification-info {
                background: #1d1d1f;
                color: white;
            }
            
            @keyframes slideInRight {
                from { 
                    transform: translateX(100%); 
                    opacity: 0; 
                }
                to { 
                    transform: translateX(0); 
                    opacity: 1; 
                }
            }
        `;
        document.head.appendChild(styles);
    }
    
    document.body.appendChild(notification);
    
    // Remove notification after 4 seconds
    setTimeout(() => {
        notification.remove();
    }, 4000);
}

// Local Storage Functions for data persistence

// Save user data to localStorage
function saveUserToStorage() {
    if (currentUser) {
        localStorage.setItem('cityWalkUser', JSON.stringify(currentUser));
        // Also save orders separately for easier access
        localStorage.setItem('cityWalk_' + currentUser.email + '_orders', JSON.stringify(currentUser.orders || []));
    }
}

// Load user data from localStorage
function loadUserFromStorage() {
    const savedUser = localStorage.getItem('cityWalkUser');
    if (savedUser) {
        try {
            currentUser = JSON.parse(savedUser);
            // Load user's orders
            const savedOrders = localStorage.getItem('cityWalk_' + currentUser.email + '_orders');
            if (savedOrders) {
                currentUser.orders = JSON.parse(savedOrders);
            }
        } catch (error) {
            console.error('Error loading user from storage:', error);
            localStorage.removeItem('cityWalkUser');
        }
    }
}

// Utility Functions

// Header Scroll Animation
let lastScrollTop = 0;
const header = document.querySelector('.header');

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        // scrolling down → hide navbar
        if (header) header.classList.add('hide');
    } else {
        // scrolling up → show navbar
        if (header) header.classList.remove('hide');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // avoid negative
});

// Page transition effects (fade-in / fade-out)
document.addEventListener("DOMContentLoaded", () => {
    // Add fade-in when the page loads
    document.body.classList.add("fade-in");

    // Handle links for smooth transition
    document.querySelectorAll("a").forEach(link => {
        if (link.hostname === window.location.hostname) { 
            link.addEventListener("click", e => {
                e.preventDefault();
                const href = link.getAttribute("href");

                // fade out current page
                document.body.classList.remove("fade-in");
                document.body.classList.add("fade-out");

                // navigate after animation
                setTimeout(() => {
                    window.location.href = href;
                }, 400); // match transition time
            });
        }
    });
});