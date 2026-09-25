<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();
$faqId = $_GET['id'] ?? 0;

if (!$faqId) {
    header('Location: faqs.php');
    exit();
}

$stmt = $db->prepare("SELECT * FROM faqs WHERE faq_id = ?");
$stmt->execute([$faqId]);
$faq = $stmt->fetch();

if (!$faq) {
    header('Location: faqs.php?error=not_found');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $category = $_POST['category'];
    $displayOrder = $_POST['display_order'];
    $status = $_POST['status'];
    
    $db->prepare("UPDATE faqs SET question = ?, answer = ?, category = ?, display_order = ? WHERE faq_id = ?")->execute([$question, $answer, $category, $displayOrder, $faqId]);
    header('Location: faqs.php?success=updated');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-edit"></i> Edit FAQ</h1>
                <a href="faqs.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            
            <div class="admin-card">
                <form method="POST" class="admin-form">
                    <div class="form-group">
                        <label>Question *</label>
                        <input type="text" name="question" value="<?php echo htmlspecialchars($faq['question']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Answer *</label>
                        <textarea name="answer" rows="6" required><?php echo htmlspecialchars($faq['answer']); ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" value="<?php echo htmlspecialchars($faq['category'] ?? ''); ?>" placeholder="General">
                        </div>
                        
                        <div class="form-group">
                            <label>Display Order</label>
                            <input type="number" name="display_order" value="<?php echo $faq['display_order']; ?>">
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-small"><i class="fas fa-save"></i> Update FAQ</button>
                        <a href="faqs.php" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
