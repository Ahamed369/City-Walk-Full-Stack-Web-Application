<?php
/**
 * City Walk - Products API
 * Author: M.H. Aazim - SA25610227
 * Module: Web Application Development - IT1201
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../database.php';

try {
    $db = getDB();
    
    // Get query parameters
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $subCategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : null;
    $featured = isset($_GET['featured']) ? (bool)$_GET['featured'] : null;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : null;
    
    // Build query
    $query = "SELECT 
        p.product_id as id,
        p.product_name as name,
        p.price,
        c.slug as category,
        p.sub_category as subCategory,
        p.rating,
        p.review_count as reviews,
        p.description,
        p.features,
        p.badge,
        p.heel_height as heelHeight,
        p.is_new as isNew,
        p.stock_quantity as stock,
        b.brand_name as brand,
        pi.image_url as image,
        pi.alt_text as imageAlt
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    LEFT JOIN brands b ON p.brand_id = b.brand_id
    LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.is_primary = 1
    WHERE p.status = 'active'";
    
    $params = [];
    
    // Add filters
    if ($category) {
        $query .= " AND c.slug = :category";
        $params[':category'] = $category;
    }
    
    if ($subCategory) {
        $query .= " AND p.sub_category = :subcategory";
        $params[':subcategory'] = $subCategory;
    }
    
    if ($featured !== null) {
        $query .= " AND p.is_featured = :featured";
        $params[':featured'] = $featured ? 1 : 0;
    }
    
    $query .= " ORDER BY p.product_id";
    
    if ($limit) {
        $query .= " LIMIT :limit";
    }
    
    $stmt = $db->prepare($query);
    
    // Bind parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    if ($limit) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    $products = $stmt->fetchAll();
    
    // Get sizes and colors for each product
    foreach ($products as &$product) {
        // Convert features from JSON string to array
        if ($product['features']) {
            $product['features'] = json_decode($product['features']);
        }
        
        // Convert boolean fields
        $product['isNew'] = (bool)$product['isNew'];
        
        // Get sizes
        $sizeStmt = $db->prepare("SELECT size FROM product_sizes WHERE product_id = ? AND stock_quantity > 0");
        $sizeStmt->execute([$product['id']]);
        $product['sizes'] = $sizeStmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Get colors
        $colorStmt = $db->prepare("SELECT color_name FROM product_colors WHERE product_id = ? AND stock_quantity > 0");
        $colorStmt->execute([$product['id']]);
        $product['colors'] = $colorStmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    echo json_encode([
        'success' => true,
        'count' => count($products),
        'products' => $products
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch products',
        'message' => $e->getMessage()
    ]);
}
?>
