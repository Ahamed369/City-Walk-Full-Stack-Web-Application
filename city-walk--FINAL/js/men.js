// City Walk - Men's Page JavaScript
// Author: Student SA25610227 - M.H. Aazim
// Module: Web Application Development - IT1201

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Men\'s page initialized');
    initializeMensPage();
});

// Store filtered products
let filteredMensProducts = [];
let currentMensFilters = {
    category: '',
    price: '',
    size: '',
    brand: '',
    sort: 'name'
};

// Initialize the men's products page
function initializeMensPage() {
    // Get men's products from the global variable
    const mensProducts = window.CityWalk.allProducts.filter(p => p.category === 'men');
    filteredMensProducts = [...mensProducts];
    
    // Render products initially
    renderMensProducts(filteredMensProducts);
    
    // Set up filter event listeners
    setupMensFilterListeners();
    
    // Update results count
    updateMensResultsCount(filteredMensProducts.length);
}

// Set up event listeners for all filters
function setupMensFilterListeners() {
    // Category filter
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            currentMensFilters.category = this.value;
            applyMensFilters();
        });
    }
    
    // Price filter
    const priceFilter = document.getElementById('price-filter');
    if (priceFilter) {
        priceFilter.addEventListener('change', function() {
            currentMensFilters.price = this.value;
            applyMensFilters();
        });
    }
    
    // Size filter
    const sizeFilter = document.getElementById('size-filter');
    if (sizeFilter) {
        sizeFilter.addEventListener('change', function() {
            currentMensFilters.size = this.value;
            applyMensFilters();
        });
    }
    
    // Brand filter
    const brandFilter = document.getElementById('brand-filter');
    if (brandFilter) {
        brandFilter.addEventListener('change', function() {
            currentMensFilters.brand = this.value;
            applyMensFilters();
        });
    }
    
    // Sort filter
    const sortFilter = document.getElementById('sort-filter');
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            currentMensFilters.sort = this.value;
            applyMensFilters();
        });
    }
    
    // Clear filters button
    const clearBtn = document.getElementById('clear-filters');
    if (clearBtn) {
        clearBtn.addEventListener('click', clearMensFilters);
    }
}

// Apply all filters
function applyMensFilters() {
    console.log('Applying men\'s filters:', currentMensFilters);
    
    // Start with all men's products
    let products = window.CityWalk.allProducts.filter(p => p.category === 'men');
    
    // Apply subcategory filter
    if (currentMensFilters.category) {
        products = products.filter(p => p.subCategory === currentMensFilters.category);
    }
    
    // Apply price filter
    if (currentMensFilters.price) {
        products = applyMensPriceFilter(products, currentMensFilters.price);
    }
    
    // Apply size filter
    if (currentMensFilters.size) {
        products = products.filter(p => p.sizes && p.sizes.includes(currentMensFilters.size));
    }
    
    // Apply brand filter
    if (currentMensFilters.brand) {
        products = products.filter(p => p.brand === currentMensFilters.brand);
    }
    
    // Apply sorting
    products = window.CityWalk.sortProducts(products, currentMensFilters.sort);
    
    // Update filtered products
    filteredMensProducts = products;
    
    // Render the filtered products
    renderMensProducts(filteredMensProducts);
    
    // Update results count
    updateMensResultsCount(filteredMensProducts.length);
}

// Apply price range filter
function applyMensPriceFilter(products, priceRange) {
    if (priceRange === '15000+') {
        return products.filter(p => p.price >= 15000);
    }
    
    const [min, max] = priceRange.split('-').map(Number);
    return products.filter(p => p.price >= min && p.price < max);
}

// Clear all filters
function clearMensFilters() {
    // Reset filter values
    currentMensFilters = {
        category: '',
        price: '',
        size: '',
        brand: '',
        sort: 'name'
    };
    
    // Reset all select elements
    document.getElementById('category-filter').value = '';
    document.getElementById('price-filter').value = '';
    document.getElementById('size-filter').value = '';
    document.getElementById('brand-filter').value = '';
    document.getElementById('sort-filter').value = 'name';
    
    // Show all men's products
    const mensProducts = window.CityWalk.allProducts.filter(p => p.category === 'men');
    filteredMensProducts = [...mensProducts];
    renderMensProducts(filteredMensProducts);
    updateMensResultsCount(filteredMensProducts.length);
    
    window.CityWalk.showNotification('Filters cleared', 'info');
}

// Render products to the grid
function renderMensProducts(products) {
    const productsGrid = document.getElementById('mens-products-grid');
    
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
function updateMensResultsCount(count) {
    const resultsCount = document.getElementById('results-count');
    if (resultsCount) {
        const totalProducts = window.CityWalk.allProducts.filter(p => p.category === 'men').length;
        resultsCount.textContent = `Showing ${count} of ${totalProducts} products`;
    }
}

// Function to filter by subcategory (called from showcase buttons)
function filterBySubCategory(subCategory) {
    currentMensFilters.category = subCategory;
    document.getElementById('category-filter').value = subCategory;
    applyMensFilters();
    
    // Scroll to products section
    const productsSection = document.querySelector('.products-section');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    }
}

// Make function available globally
window.filterBySubCategory = filterBySubCategory;

// Export functions for use if needed
window.MensPage = {
    applyMensFilters,
    clearMensFilters,
    renderMensProducts,
    filterBySubCategory
};