<?php
include '../_base.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'category_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$status_filter = isset($_GET['status']) ? $_GET['status'] : ''; // Status filter
if (is_post()) {
    $new_category = req('category_name');

    // Validation for the new category
    if (!$new_category) {
        $_err['category_name'] = 'Required';
    } else if (strlen($new_category) > 100) {
        $_err['category_name'] = 'Maximum 100 characters';
    } else {
        // Check if the category name already exists
        $stm = $_db->prepare('SELECT COUNT(*) FROM category WHERE category_name = ?');
        $stm->execute([$new_category]);
        $category_exists = $stm->fetchColumn();

        if ($category_exists) {
            $_err['category_name'] = 'Category name already exists';
        }
    }

    // If no validation errors, proceed to insert the category
    if (!$_err) {
        $new_category_id = generateID('category', 'category_id', 'CT', 4); // Generate new category ID
        $stm = $_db->prepare('
            INSERT INTO category (category_id, category_name, category_status)
            VALUES (?, ?, "Available")
        ');
        $stm->execute([$new_category_id, $new_category]);

        temp('info', 'New category added successfully');
        redirect('categoryList.php?page=' . $page . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order) . '&status=' . urlencode($status_filter) . '&search=' . htmlspecialchars($search_query));
    }
}

$_title = 'Add New Category';
include '../_head.php';
?>

<link rel="stylesheet" href="../css/product.css">
<h1>Add New Category</h1>
<form method="post" class="form">

    <label for="category_name">Category Name</label><br>
    <?= html_text('category_name', 'maxlength="100"') ?>
    <?= err('category_name') ?>
    <br><br>

    <button type="submit" id="submit-button">Submit</button>
</form>