<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();
$pageId = $_GET['id'] ?? 0;

if (!$pageId) {
    header('Location: cms-pages.php');
    exit();
}

$stmt = $db->prepare("SELECT * FROM cms_pages WHERE page_id = ?");
$stmt->execute([$pageId]);
$page = $stmt->fetch();

if (!$page) {
    header('Location: cms-pages.php?error=not_found');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pageTitle = $_POST['page_title'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['slug'])));
    $content = $_POST['content'];
    $metaTitle = $_POST['meta_title'];
    $metaDescription = $_POST['meta_description'];
    $status = $_POST['status'];
    
    $db->prepare("UPDATE cms_pages SET page_title = ?, slug = ?, content = ?, meta_title = ?, meta_description = ?, status = ?, updated_at = NOW() WHERE page_id = ?")->execute([$pageTitle, $slug, $content, $metaTitle, $metaDescription, $status, $pageId]);
    header('Location: cms-pages.php?success=updated');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-edit"></i> Edit Page</h1>
                <a href="cms-pages.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            
            <div class="admin-card">
                <form method="POST" class="admin-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Page Title *</label>
                            <input type="text" name="page_title" value="<?php echo htmlspecialchars($page['page_title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Slug *</label>
                            <input type="text" name="slug" value="<?php echo htmlspecialchars($page['slug']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Content *</label>
                        <textarea name="content" rows="12" required><?php echo htmlspecialchars($page['content']); ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" value="<?php echo htmlspecialchars($page['meta_title'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status">
                                <option value="active" <?php echo $page['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $page['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" rows="3"><?php echo htmlspecialchars($page['meta_description'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-small"><i class="fas fa-save"></i> Update Page</button>
                        <a href="cms-pages.php" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
