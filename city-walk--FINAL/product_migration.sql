-- City Walk - Product Migration Script
-- Insert existing products from app.js into database

-- Note: Run this after creating the main schema
-- Make sure categories and brands are inserted first

-- Men's Products
INSERT INTO products (product_name, slug, category_id, sub_category, brand_id, price, description, features, rating, review_count, badge, heel_height, is_new, is_featured, stock_quantity, status) VALUES
('Classic Oxford Shoes', 'classic-oxford-shoes', 1, 'formal', 1, 12500.00, 'Premium leather oxford shoes perfect for professional settings and formal occasions. Handcrafted with attention to detail.', '["Genuine leather", "Cushioned sole", "Professional finish", "Multiple sizes"]', 4.8, 156, 'Best Seller', 'flat', FALSE, TRUE, 25, 'active'),
('Derby Dress Shoes', 'derby-dress-shoes', 1, 'formal', 1, 11800.00, 'Elegant derby shoes with premium finish. Perfect for business meetings and formal events.', '["Premium leather", "Comfortable fit", "Durable construction"]', 4.6, 98, NULL, 'flat', FALSE, TRUE, 18, 'active'),
('Leather Loafers', 'leather-loafers', 1, 'casual', 2, 9500.00, 'Comfortable leather loafers for everyday wear. Versatile and stylish.', '["Genuine leather", "Slip-on design", "All-day comfort"]', 4.7, 203, 'Popular', 'flat', FALSE, TRUE, 30, 'active'),
('Canvas Sneakers', 'canvas-sneakers', 1, 'casual', 2, 6500.00, 'Classic canvas sneakers perfect for casual outings and weekend wear.', '["Breathable canvas", "Rubber sole", "Lightweight"]', 4.5, 145, NULL, 'flat', FALSE, TRUE, 40, 'active'),
('Running Shoes', 'running-shoes', 1, 'athletic', 3, 13500.00, 'High-performance running shoes with advanced cushioning technology.', '["Breathable mesh", "Shock absorption", "Lightweight design"]', 4.9, 287, 'Top Rated', 'flat', TRUE, TRUE, 22, 'active'),
('Hiking Boots', 'hiking-boots', 1, 'boots', 1, 15800.00, 'Durable hiking boots built for adventure. Water-resistant and comfortable.', '["Water-resistant", "Ankle support", "Rugged outsole"]', 4.8, 174, NULL, 'flat', FALSE, TRUE, 15, 'active');

-- Women's Products  
INSERT INTO products (product_name, slug, category_id, sub_category, brand_id, price, description, features, rating, review_count, badge, heel_height, is_new, is_featured, stock_quantity, status) VALUES
('Classic Pumps', 'classic-pumps', 2, 'heels', 4, 9800.00, 'Timeless pumps that elevate any outfit. Perfect for office and evening wear.', '["Synthetic leather", "3-inch heel", "Cushioned insole"]', 4.7, 189, 'Best Seller', 'medium', FALSE, TRUE, 28, 'active'),
('Stiletto Heels', 'stiletto-heels', 2, 'heels', 4, 11500.00, 'Elegant stiletto heels for special occasions. Make a statement with every step.', '["Premium finish", "4-inch heel", "Elegant design"]', 4.6, 142, NULL, 'high', FALSE, TRUE, 20, 'active'),
('Ballet Flats', 'ballet-flats', 2, 'flats', 4, 7500.00, 'Comfortable ballet flats for all-day wear. Stylish and practical.', '["Soft material", "Flexible sole", "Multiple colors"]', 4.8, 256, 'Popular', 'flat', FALSE, TRUE, 35, 'active'),
('Casual Sandals', 'casual-sandals', 2, 'sandals', 5, 5800.00, 'Light and comfortable sandals perfect for summer days.', '["Comfortable straps", "Cushioned footbed", "Durable sole"]', 4.5, 167, NULL, 'flat', FALSE, TRUE, 45, 'active'),
('Wedge Sandals', 'wedge-sandals', 2, 'wedges', 4, 8900.00, 'Stylish wedge sandals combining comfort and height.', '["Stable wedge heel", "Comfortable fit", "Elegant design"]', 4.7, 198, NULL, 'medium', TRUE, TRUE, 25, 'active'),
('Ankle Boots', 'ankle-boots', 2, 'boots', 1, 13200.00, 'Trendy ankle boots perfect for any season. Versatile and fashionable.', '["Premium material", "Side zipper", "Comfortable fit"]', 4.8, 215, 'New Arrival', 'low', TRUE, TRUE, 18, 'active');

-- Kids' Products
INSERT INTO products (product_name, slug, category_id, sub_category, brand_id, price, description, features, rating, review_count, badge, heel_height, is_new, is_featured, stock_quantity, status) VALUES
('School Shoes Black', 'school-shoes-black', 3, 'school', 7, 4500.00, 'Durable black school shoes designed for daily wear. Easy to clean and maintain.', '["Durable material", "Easy to clean", "Comfortable fit"]', 4.6, 234, 'Best Seller', 'flat', FALSE, TRUE, 50, 'active'),
('Colorful Sneakers', 'colorful-sneakers', 3, 'sneakers', 6, 5200.00, 'Fun and colorful sneakers kids will love. Perfect for play and casual wear.', '["Vibrant colors", "Comfortable padding", "Durable construction"]', 4.7, 189, 'Popular', 'flat', FALSE, TRUE, 40, 'active'),
('Sports Trainers', 'sports-trainers', 3, 'athletic', 6, 6800.00, 'Active sports shoes for energetic kids. Great support and durability.', '["Athletic support", "Breathable", "Non-slip sole"]', 4.8, 156, NULL, 'flat', FALSE, TRUE, 30, 'active'),
('Velcro Sandals', 'velcro-sandals', 3, 'sandals', 6, 3800.00, 'Easy-to-wear sandals with velcro straps. Perfect for summer activities.', '["Easy velcro closure", "Comfortable footbed", "Durable straps"]', 4.5, 167, NULL, 'flat', FALSE, TRUE, 55, 'active'),
('Character Shoes', 'character-shoes', 3, 'casual', 6, 4800.00, 'Fun shoes featuring popular characters. Kids love them!', '["Favorite characters", "Comfortable fit", "Fun designs"]', 4.9, 312, 'Kids Favorite', 'flat', TRUE, TRUE, 45, 'active'),
('Rain Boots', 'rain-boots', 3, 'boots', 6, 5500.00, 'Waterproof rain boots to keep feet dry. Available in bright colors.', '["100% waterproof", "Easy to clean", "Bright colors"]', 4.7, 198, NULL, 'flat', FALSE, TRUE, 35, 'active');

-- Insert product images
INSERT INTO product_images (product_id, image_url, alt_text, is_primary, display_order) VALUES
(1, './assets/products/men/product-1.webp', 'Classic Oxford Shoes', TRUE, 1),
(2, './assets/products/men/product-2.webp', 'Derby Dress Shoes', TRUE, 1),
(3, './assets/products/men/product-3.webp', 'Leather Loafers', TRUE, 1),
(4, './assets/products/men/product-4.webp', 'Canvas Sneakers', TRUE, 1),
(5, './assets/products/men/product-5.webp', 'Running Shoes', TRUE, 1),
(6, './assets/products/men/product-6.webp', 'Hiking Boots', TRUE, 1),
(7, './assets/products/women/product-1.webp', 'Classic Pumps', TRUE, 1),
(8, './assets/products/women/product-2.webp', 'Stiletto Heels', TRUE, 1),
(9, './assets/products/women/product-3.webp', 'Ballet Flats', TRUE, 1),
(10, './assets/products/women/product-4.webp', 'Casual Sandals', TRUE, 1),
(11, './assets/products/women/product-5.webp', 'Wedge Sandals', TRUE, 1),
(12, './assets/products/women/product-6.webp', 'Ankle Boots', TRUE, 1),
(13, './assets/products/kids/product-1.webp', 'School Shoes Black', TRUE, 1),
(14, './assets/products/kids/product-2.webp', 'Colorful Sneakers', TRUE, 1),
(15, './assets/products/kids/product-3.webp', 'Sports Trainers', TRUE, 1),
(16, './assets/products/kids/product-4.webp', 'Velcro Sandals', TRUE, 1),
(17, './assets/products/kids/product-5.webp', 'Character Shoes', TRUE, 1),
(18, './assets/products/kids/product-6.webp', 'Rain Boots', TRUE, 1);

-- Insert sizes for men's products
INSERT INTO product_sizes (product_id, size, stock_quantity) VALUES
(1, '7', 5), (1, '8', 5), (1, '9', 5), (1, '10', 5), (1, '11', 5),
(2, '7', 4), (2, '8', 4), (2, '9', 4), (2, '10', 3), (2, '11', 3),
(3, '7', 6), (3, '8', 6), (3, '9', 6), (3, '10', 6), (3, '11', 6),
(4, '7', 8), (4, '8', 8), (4, '9', 8), (4, '10', 8), (4, '11', 8),
(5, '7', 4), (5, '8', 5), (5, '9', 5), (5, '10', 4), (5, '11', 4),
(6, '7', 3), (6, '8', 3), (6, '9', 3), (6, '10', 3), (6, '11', 3);

-- Insert sizes for women's products
INSERT INTO product_sizes (product_id, size, stock_quantity) VALUES
(7, '5', 6), (7, '6', 6), (7, '7', 6), (7, '8', 5), (7, '9', 5),
(8, '5', 4), (8, '6', 4), (8, '7', 4), (8, '8', 4), (8, '9', 4),
(9, '5', 7), (9, '6', 7), (9, '7', 7), (9, '8', 7), (9, '9', 7),
(10, '5', 9), (10, '6', 9), (10, '7', 9), (10, '8', 9), (10, '9', 9),
(11, '5', 5), (11, '6', 5), (11, '7', 5), (11, '8', 5), (11, '9', 5),
(12, '5', 4), (12, '6', 4), (12, '7', 3), (12, '8', 4), (12, '9', 3);

-- Insert sizes for kids' products
INSERT INTO product_sizes (product_id, size, stock_quantity) VALUES
(13, '10', 10), (13, '11', 10), (13, '12', 10), (13, '13', 10), (13, '1', 10),
(14, '10', 8), (14, '11', 8), (14, '12', 8), (14, '13', 8), (14, '1', 8),
(15, '10', 6), (15, '11', 6), (15, '12', 6), (15, '13', 6), (15, '1', 6),
(16, '10', 11), (16, '11', 11), (16, '12', 11), (16, '13', 11), (16, '1', 11),
(17, '10', 9), (17, '11', 9), (17, '12', 9), (17, '13', 9), (17, '1', 9),
(18, '10', 7), (18, '11', 7), (18, '12', 7), (18, '13', 7), (18, '1', 7);

-- Insert colors for products
INSERT INTO product_colors (product_id, color_name, stock_quantity) VALUES
(1, 'Black', 13), (1, 'Brown', 12),
(2, 'Black', 9), (2, 'Brown', 9),
(3, 'Black', 10), (3, 'Brown', 10), (3, 'Tan', 10),
(4, 'White', 10), (4, 'Navy', 10), (4, 'Black', 10), (4, 'Red', 10),
(5, 'Blue', 11), (5, 'Black', 11),
(6, 'Brown', 8), (6, 'Black', 7),
(7, 'Black', 10), (7, 'Nude', 9), (7, 'Red', 9),
(8, 'Black', 10), (8, 'Red', 10),
(9, 'Black', 12), (9, 'Pink', 12), (9, 'Beige', 11),
(10, 'Brown', 15), (10, 'Black', 15), (10, 'White', 15),
(11, 'Tan', 13), (11, 'Black', 12),
(12, 'Black', 9), (12, 'Brown', 9),
(13, 'Black', 50),
(14, 'Multi-color', 40),
(15, 'Blue', 15), (15, 'Red', 15),
(16, 'Blue', 18), (16, 'Pink', 18), (16, 'Green', 19),
(17, 'Multi-color', 45),
(18, 'Yellow', 12), (18, 'Red', 12), (18, 'Blue', 11);
