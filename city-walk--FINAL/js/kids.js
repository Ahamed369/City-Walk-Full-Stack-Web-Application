// City Walk - Kid's Page JavaScript
// Author: SA25610227 - M.H. Aazim
// Module: Web Application Development - IT1201

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Kids page initialized');
    initializeKidsPage();
});

// Store filtered products
let filteredKidsProducts = [];
let currentKidsFilters = {
    category: '',
    ageGroup: '',
    price: '',
    size: '',
    brand: '',
    sort: 'name'
};

// Initialize the kids' products page
function initializeKidsPage() {
    console.log('Starting kids page initialization...');
    
    // Check if CityWalk object exists
    if (!window.CityWalk || !window.CityWalk.allProducts) {
        console.error('CityWalk.allProducts not available yet. Retrying...');
        setTimeout(initializeKidsPage, 100);
        return;
    }
    
    // Get kids' products from the global variable
    const kidsProducts = window.CityWalk.allProducts.filter(p => p.category === 'kids');
    filteredKidsProducts = [...kidsProducts];
    
    console.log('Kids products found:', kidsProducts.length);
    console.log('Kids products:', kidsProducts);
    
    // Render products initially
    renderKidsProducts(filteredKidsProducts);
    
    // Set up filter event listeners
    setupKidsFilterListeners();
    
    // Update results count
    updateKidsResultsCount(filteredKidsProducts.length);
    
    // Hide Load More button if exists
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.style.display = 'none';
    }
    
    console.log('Kids page initialization complete');
}

// Set up event listeners for all filters
function setupKidsFilterListeners() {
    // Category filter
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            console.log('Category filter changed to:', this.value);
            currentKidsFilters.category = this.value;
            applyKidsFilters();
        });
    }
    
    // Age group filter
    const ageGroupFilter = document.getElementById('age-group-filter');
    if (ageGroupFilter) {
        ageGroupFilter.addEventListener('change', function() {
            console.log('Age group filter changed to:', this.value);
            currentKidsFilters.ageGroup = this.value;
            applyKidsFilters();
        });
    }
    
    // Price filter
    const priceFilter = document.getElementById('price-filter');
    if (priceFilter) {
        priceFilter.addEventListener('change', function() {
            console.log('Price filter changed to:', this.value);
            currentKidsFilters.price = this.value;
            applyKidsFilters();
        });
    }
    
    // Size filter
    const sizeFilter = document.getElementById('size-filter');
    if (sizeFilter) {
        sizeFilter.addEventListener('change', function() {
            console.log('Size filter changed to:', this.value);
            currentKidsFilters.size = this.value;
            applyKidsFilters();
        });
    }
    
    // Brand filter
    const brandFilter = document.getElementById('brand-filter');
    if (brandFilter) {
        brandFilter.addEventListener('change', function() {
            console.log('Brand filter changed to:', this.value);
            currentKidsFilters.brand = this.value;
            applyKidsFilters();
        });
    }
    
    // Sort filter
    const sortFilter = document.getElementById('sort-filter');
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            console.log('Sort filter changed to:', this.value);
            currentKidsFilters.sort = this.value;
            applyKidsFilters();
        });
    }
    
    // Clear filters button
    const clearBtn = document.getElementById('clear-filters');
    if (clearBtn) {
        clearBtn.addEventListener('click', clearKidsFilters);
    }
    
    console.log('Kids filter listeners set up successfully');
}

// Apply all filters
function applyKidsFilters() {
    console.log('Applying kids filters:', currentKidsFilters);
    
    // Start with all kids' products
    let products = window.CityWalk.allProducts.filter(p => p.category === 'kids');
    console.log('Starting with', products.length, 'kids products');
    
    // Apply subcategory filter
    if (currentKidsFilters.category) {
        products = products.filter(p => p.subCategory === currentKidsFilters.category);
        console.log('After category filter:', products.length, 'products');
    }
    
    // Apply age group filter (Note: needs to be added to product data)
    if (currentKidsFilters.ageGroup) {
        // This would need ageGroup property in product objects
        // For now, we can skip or implement based on product names/descriptions
        console.log('Age group filter selected but not implemented in product data');
    }
    
    // Apply price filter
    if (currentKidsFilters.price) {
        products = applyKidsPriceFilter(products, currentKidsFilters.price);
        console.log('After price filter:', products.length, 'products');
    }
    
    // Apply size filter
    if (currentKidsFilters.size) {
        products = products.filter(p => p.sizes && p.sizes.includes(currentKidsFilters.size));
        console.log('After size filter:', products.length, 'products');
    }
    
    // Apply brand filter
    if (currentKidsFilters.brand) {
        products = products.filter(p => p.brand === currentKidsFilters.brand);
        console.log('After brand filter:', products.length, 'products');
    }
    
    // Apply sorting
    products = window.CityWalk.sortProducts(products, currentKidsFilters.sort);
    console.log('After sorting:', products.length, 'products');
    
    // Update filtered products
    filteredKidsProducts = products;
    
    // Render the filtered products
    renderKidsProducts(filteredKidsProducts);
    
    // Update results count
    updateKidsResultsCount(filteredKidsProducts.length);
}

// Apply price range filter
function applyKidsPriceFilter(products, priceRange) {
    console.log('Applying price filter:', priceRange);
    
    if (priceRange === '7000+') {
        return products.filter(p => p.price >= 7000);
    }
    
    const [min, max] = priceRange.split('-').map(Number);
    return products.filter(p => p.price >= min && p.price < max);
}

// Clear all filters
function clearKidsFilters() {
    console.log('Clearing all kids filters');
    
    // Reset filter values
    currentKidsFilters = {
        category: '',
        ageGroup: '',
        price: '',
        size: '',
        brand: '',
        sort: 'name'
    };
    
    // Reset all select elements
    const categoryFilter = document.getElementById('category-filter');
    const ageGroupFilter = document.getElementById('age-group-filter');
    const priceFilter = document.getElementById('price-filter');
    const sizeFilter = document.getElementById('size-filter');
    const brandFilter = document.getElementById('brand-filter');
    const sortFilter = document.getElementById('sort-filter');
    
    if (categoryFilter) categoryFilter.value = '';
    if (ageGroupFilter) ageGroupFilter.value = '';
    if (priceFilter) priceFilter.value = '';
    if (sizeFilter) sizeFilter.value = '';
    if (brandFilter) brandFilter.value = '';
    if (sortFilter) sortFilter.value = 'name';
    
    // Show all kids' products
    const kidsProducts = window.CityWalk.allProducts.filter(p => p.category === 'kids');
    filteredKidsProducts = [...kidsProducts];
    renderKidsProducts(filteredKidsProducts);
    updateKidsResultsCount(filteredKidsProducts.length);
    
    if (window.CityWalk.showNotification) {
        window.CityWalk.showNotification('Filters cleared', 'info');
    }
}

// Render products to the grid
function renderKidsProducts(products) {
    console.log('Rendering kids products:', products.length);
    
    const productsGrid = document.getElementById('kids-products-grid');
    
    if (!productsGrid) {
        console.error('kids-products-grid element not found!');
        return;
    }
    
    console.log('Products grid element found:', productsGrid);
    
    // Check if there are products to display
    if (products.length === 0) {
        console.log('No products to display, showing empty message');
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
    console.log('Generating product cards...');
    const productCards = products.map(product => {
        if (window.CityWalk && window.CityWalk.createProductCard) {
            return window.CityWalk.createProductCard(product);
        } else {
            console.error('CityWalk.createProductCard not available');
            return '';
        }
    }).join('');
    
    productsGrid.innerHTML = productCards;
    console.log('Product cards inserted into grid');
    
    // Set up product card listeners
    if (window.CityWalk && window.CityWalk.setupProductCardListeners) {
        window.CityWalk.setupProductCardListeners();
        console.log('Product card listeners set up');
    }
}

// Update results count display
function updateKidsResultsCount(count) {
    const resultsCount = document.getElementById('results-count');
    if (resultsCount) {
        const totalProducts = window.CityWalk.allProducts.filter(p => p.category === 'kids').length;
        resultsCount.textContent = `Showing ${count} of ${totalProducts} products`;
        console.log('Results count updated:', resultsCount.textContent);
    }
}

// Function to filter by subcategory (called from showcase buttons)
function filterBySubCategory(subCategory) {
    console.log('Filtering by subcategory:', subCategory);
    
    currentKidsFilters.category = subCategory;
    const categoryFilter = document.getElementById('category-filter');
    if (categoryFilter) {
        categoryFilter.value = subCategory;
    }
    applyKidsFilters();
    
    // Scroll to products section
    const productsSection = document.querySelector('.products-section');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    }
}

// Make function available globally
window.filterBySubCategory = filterBySubCategory;

// Export functions for use if needed
window.KidsPage = {
    applyKidsFilters,
    clearKidsFilters,
    renderKidsProducts,
    filterBySubCategory,
    initializeKidsPage
};

// Log that the file has loaded
console.log('kids.js file loaded successfully');