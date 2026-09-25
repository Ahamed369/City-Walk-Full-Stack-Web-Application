// City Walk - All Products Page JavaScript
// Author: Student SA25610227 - M.H. Aazim
// Module: Web Application Development - IT1201

// Store filtered products
let filteredProducts = [];
let currentFilters = {
    category: '',
    subcategory: '',
    price: '',
    brand: '',
    sort: 'name'
};

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('All Products page initialized');
    // Add a small delay to ensure app.js has fully loaded
    setTimeout(function() {
        initializeAllProductsPage();
    }, 200);
});

// Initialize the all products page
function initializeAllProductsPage() {
    // Check if window.CityWalk exists and has products
    if (!window.CityWalk || !window.CityWalk.allProducts || window.CityWalk.allProducts.length === 0) {
        console.log('Waiting for products to load...');
        setTimeout(initializeAllProductsPage, 200);
        return;
    }
    
    // Get all products from the global variable
    filteredProducts = [...window.CityWalk.allProducts];
    
    console.log('Total products loaded:', filteredProducts.length);
    
    // Render all products initially
    renderAllProducts(filteredProducts);
    
    // Set up filter event listeners
    setupFilterListeners();
    
    // Update results count
    updateResultsCount(filteredProducts.length);
}

// Set up event listeners for all filters
function setupFilterListeners() {
    // Category filter
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            currentFilters.category = this.value;
            applyFilters();
        });
    }
    
    // Subcategory filter
    const subcategoryFilter = document.getElementById('subcategory-filter');
    if (subcategoryFilter) {
        subcategoryFilter.addEventListener('change', function() {
            currentFilters.subcategory = this.value;
            applyFilters();
        });
    }
    
    // Price filter
    const priceFilter = document.getElementById('price-filter');
    if (priceFilter) {
        priceFilter.addEventListener('change', function() {
            currentFilters.price = this.value;
            applyFilters();
        });
    }
    
    // Brand filter
    const brandFilter = document.getElementById('brand-filter');
    if (brandFilter) {
        brandFilter.addEventListener('change', function() {
            currentFilters.brand = this.value;
            applyFilters();
        });
    }
    
    // Sort filter
    const sortFilter = document.getElementById('sort-filter');
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            currentFilters.sort = this.value;
            applyFilters();
        });
    }
    
    // Clear filters button
    const clearBtn = document.getElementById('clear-filters');
    if (clearBtn) {
        clearBtn.addEventListener('click', clearAllFilters);
    }
}

// Apply all filters - MAIN FILTER FUNCTION
function applyFilters() {
    console.log('Applying filters:', currentFilters);
    
    // Check if products are loaded
    if (!window.CityWalk || !window.CityWalk.allProducts) {
        console.error('Products not loaded yet');
        return;
    }
    
    // Start with all products
    let products = [...window.CityWalk.allProducts];
    
    // Apply category filter
    if (currentFilters.category) {
        products = products.filter(p => p.category === currentFilters.category);
    }
    
    // Apply subcategory filter
    if (currentFilters.subcategory) {
        products = products.filter(p => p.subCategory === currentFilters.subcategory);
    }
    
    // Apply price filter
    if (currentFilters.price) {
        products = applyPriceFilter(products, currentFilters.price);
    }
    
    // Apply brand filter
    if (currentFilters.brand) {
        products = products.filter(p => p.brand === currentFilters.brand);
    }
    
    // Apply sorting
    if (window.CityWalk.sortProducts) {
        products = window.CityWalk.sortProducts(products, currentFilters.sort);
    }
    
    // Update filtered products
    filteredProducts = products;
    
    // Render the filtered products
    renderAllProducts(filteredProducts);
    
    // Update results count
    updateResultsCount(filteredProducts.length);
}

// Apply price range filter
function applyPriceFilter(products, priceRange) {
    if (priceRange === '15000+') {
        return products.filter(p => p.price >= 15000);
    }
    
    const [min, max] = priceRange.split('-').map(Number);
    return products.filter(p => p.price >= min && p.price < max);
}

// Clear all filters
function clearAllFilters() {
    // Reset filter values
    currentFilters = {
        category: '',
        subcategory: '',
        price: '',
        brand: '',
        sort: 'name'
    };
    
    // Reset all select elements
    const categoryFilter = document.getElementById('category-filter');
    const subcategoryFilter = document.getElementById('subcategory-filter');
    const priceFilter = document.getElementById('price-filter');
    const brandFilter = document.getElementById('brand-filter');
    const sortFilter = document.getElementById('sort-filter');
    
    if (categoryFilter) categoryFilter.value = '';
    if (subcategoryFilter) subcategoryFilter.value = '';
    if (priceFilter) priceFilter.value = '';
    if (brandFilter) brandFilter.value = '';
    if (sortFilter) sortFilter.value = 'name';
    
    // Show all products
    filteredProducts = [...window.CityWalk.allProducts];
    renderAllProducts(filteredProducts);
    updateResultsCount(filteredProducts.length);
    
    if (window.CityWalk && window.CityWalk.showNotification) {
        window.CityWalk.showNotification('Filters cleared', 'info');
    }
}

// Render all products to the grid
function renderAllProducts(products) {
    // Try to find the products grid - check both possible IDs
    const productsGrid = document.getElementById('products-grid') || 
                        document.getElementById('all-products-grid');
    const noResults = document.getElementById('no-results');
    
    if (!productsGrid) {
        console.error('Products grid element not found!');
        return;
    }
    
    console.log('Rendering products:', products.length);
    
    // Check if there are products to display
    if (products.length === 0) {
        productsGrid.style.display = 'none';
        if (noResults) {
            noResults.style.display = 'block';
        }
        return;
    }
    
    // Show grid and hide no results message
    productsGrid.style.display = 'grid';
    if (noResults) {
        noResults.style.display = 'none';
    }
    
    // Generate product cards using the global function
    if (window.CityWalk && window.CityWalk.createProductCard) {
        productsGrid.innerHTML = products.map(product => 
            window.CityWalk.createProductCard(product)
        ).join('');
        
        // Set up product card listeners
        if (window.CityWalk.setupProductCardListeners) {
            window.CityWalk.setupProductCardListeners();
        }
    } else {
        console.error('CityWalk.createProductCard not available');
    }
}

// Update results count display
function updateResultsCount(count) {
    const resultsCount = document.getElementById('results-count');
    if (resultsCount) {
        const totalProducts = window.CityWalk ? window.CityWalk.allProducts.length : 0;
        resultsCount.textContent = `Showing ${count} of ${totalProducts} products`;
    }
}

// Export function to window for use in all-products.php
window.applyFilters = applyFilters;

// Also export other useful functions
window.AllProducts = {
    applyFilters,
    clearAllFilters,
    renderAllProducts,
    initializeAllProductsPage
};