// City Walk - Women's Page JavaScript
// Author: Student SA25610227 - M.H. Aazim
// Module: Web Application Development - IT1201

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Women\'s page initialized');
    initializeWomensPage();
});

// Store filtered products
let filteredWomensProducts = [];
let currentWomensFilters = {
    category: '',
    heelHeight: '',
    price: '',
    size: '',
    brand: '',
    sort: 'name'
};

// Initialize the women's products page
function initializeWomensPage() {
    // Get women's products from the global variable
    const womensProducts = window.CityWalk.allProducts.filter(p => p.category === 'women');
    filteredWomensProducts = [...womensProducts];
    
    console.log('Women\'s products found:', womensProducts.length); // Debug log
    
    // Render products initially
    renderWomensProducts(filteredWomensProducts);
    
    // Set up filter event listeners
    setupWomensFilterListeners();
    
    // Update results count
    updateWomensResultsCount(filteredWomensProducts.length);
    
    // Hide Load More button if exists
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.style.display = 'none';
    }
}

// Set up event listeners for all filters
function setupWomensFilterListeners() {
    // Category filter
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            currentWomensFilters.category = this.value;
            applyWomensFilters();
        });
    }
    
    // Heel height filter
    const heelHeightFilter = document.getElementById('heel-height-filter');
    if (heelHeightFilter) {
        heelHeightFilter.addEventListener('change', function() {
            currentWomensFilters.heelHeight = this.value;
            applyWomensFilters();
        });
    }
    
    // Price filter
    const priceFilter = document.getElementById('price-filter');
    if (priceFilter) {
        priceFilter.addEventListener('change', function() {
            currentWomensFilters.price = this.value;
            applyWomensFilters();
        });
    }
    
    // Size filter
    const sizeFilter = document.getElementById('size-filter');
    if (sizeFilter) {
        sizeFilter.addEventListener('change', function() {
            currentWomensFilters.size = this.value;
            applyWomensFilters();
        });
    }
    
    // Brand filter
    const brandFilter = document.getElementById('brand-filter');
    if (brandFilter) {
        brandFilter.addEventListener('change', function() {
            currentWomensFilters.brand = this.value;
            applyWomensFilters();
        });
    }
    
    // Sort filter
    const sortFilter = document.getElementById('sort-filter');
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            currentWomensFilters.sort = this.value;
            applyWomensFilters();
        });
    }
    
    // Clear filters button
    const clearBtn = document.getElementById('clear-filters');
    if (clearBtn) {
        clearBtn.addEventListener('click', clearWomensFilters);
    }
}

// Apply all filters
function applyWomensFilters() {
    console.log('Applying women\'s filters:', currentWomensFilters);
    
    // Start with all women's products
    let products = window.CityWalk.allProducts.filter(p => p.category === 'women');
    
    // Apply subcategory filter
    if (currentWomensFilters.category) {
        products = products.filter(p => p.subCategory === currentWomensFilters.category);
    }
    
    // Apply heel height filter
    if (currentWomensFilters.heelHeight) {
        products = products.filter(p => p.heelHeight === currentWomensFilters.heelHeight);
    }
    
    // Apply price filter
    if (currentWomensFilters.price) {
        products = applyWomensPriceFilter(products, currentWomensFilters.price);
    }
    
    // Apply size filter
    if (currentWomensFilters.size) {
        products = products.filter(p => p.sizes && p.sizes.includes(currentWomensFilters.size));
    }
    
    // Apply brand filter
    if (currentWomensFilters.brand) {
        products = products.filter(p => p.brand === currentWomensFilters.brand);
    }
    
    // Apply sorting
    products = window.CityWalk.sortProducts(products, currentWomensFilters.sort);
    
    // Update filtered products
    filteredWomensProducts = products;
    
    // Render the filtered products
    renderWomensProducts(filteredWomensProducts);
    
    // Update results count
    updateWomensResultsCount(filteredWomensProducts.length);
}

// Apply price range filter
function applyWomensPriceFilter(products, priceRange) {
    if (priceRange === '12000+') {
        return products.filter(p => p.price >= 12000);
    }
    
    const [min, max] = priceRange.split('-').map(Number);
    return products.filter(p => p.price >= min && p.price < max);
}

// Clear all filters
function clearWomensFilters() {
    // Reset filter values
    currentWomensFilters = {
        category: '',
        heelHeight: '',
        price: '',
        size: '',
        brand: '',
        sort: 'name'
    };
    
    // Reset all select elements
    document.getElementById('category-filter').value = '';
    if (document.getElementById('heel-height-filter')) {
        document.getElementById('heel-height-filter').value = '';
    }
    document.getElementById('price-filter').value = '';
    document.getElementById('size-filter').value = '';
    document.getElementById('brand-filter').value = '';
    document.getElementById('sort-filter').value = 'name';
    
    // Show all women's products
    const womensProducts = window.CityWalk.allProducts.filter(p => p.category === 'women');
    filteredWomensProducts = [...womensProducts];
    renderWomensProducts(filteredWomensProducts);
    updateWomensResultsCount(filteredWomensProducts.length);
    
    window.CityWalk.showNotification('Filters cleared', 'info');
}

// Render products to the grid
function renderWomensProducts(products) {
    const productsGrid = document.getElementById('womens-products-grid');
    
    if (!productsGrid) return;
    
    // Check if there are products to display
    if (products.length === 0) {
        productsGrid.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-search" style="font-size: 64px; color: #86868b; margin-bottom: 20px;"></i>
                <h3 style="color: #1d1d1f; margin-bottom: 12px;">No products found</h3>
                <p style="color: #86868b;">Try adjusting your filters to see more results</p>
            </div>
        `;
        return;
    }
    
    // Generate product cards
    productsGrid.innerHTML = products.map(product => 
        window.CityWalk.createProductCard(product)
    ).join('');
    
    // Set up product card listeners
    window.CityWalk.setupProductCardListeners();
}

// Update results count display
function updateWomensResultsCount(count) {
    const resultsCount = document.getElementById('results-count');
    if (resultsCount) {
        const totalProducts = window.CityWalk.allProducts.filter(p => p.category === 'women').length;
        resultsCount.textContent = `Showing ${count} of ${totalProducts} products`;
    }
}

// Function to filter by subcategory (called from showcase buttons)
function filterBySubCategory(subCategory) {
    currentWomensFilters.category = subCategory;
    document.getElementById('category-filter').value = subCategory;
    applyWomensFilters();
    
    // Scroll to products section
    const productsSection = document.querySelector('.products-section');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    }
}

// Make function available globally
window.filterBySubCategory = filterBySubCategory;

// Export functions for use if needed
window.WomensPage = {
    applyWomensFilters,
    clearWomensFilters,
    renderWomensProducts,
    filterBySubCategory
};