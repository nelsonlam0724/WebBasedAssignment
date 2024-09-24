<?php
include '../_base.php';
$_title = 'Category Details';
include '../_head.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'category_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$status_filter = isset($_GET['status']) ? $_GET['status'] : ''; // Status filter
$_err = [];
$category_id = req('category_id');

if (!$category_id) {
    temp('info', 'Category ID Not Found');
    redirect('categoryList.php?page=' . $page . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order) . '&status=' . urlencode($status_filter) . '&search=' . htmlspecialchars($search_query));
}

$stm = $_db->prepare('SELECT * FROM category WHERE category_id = ?');
$stm->execute([$category_id]);
$category = $stm->fetch(PDO::FETCH_OBJ);

if (!$category) {
    redirect('categoryList.php?page=' . $page . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order) . '&status=' . urlencode($status_filter) . '&search=' . htmlspecialchars($search_query));
}

if (is_post()) {
    // Get form data
    $new_name = req('name');
    $new_status = req('status');

    // Validation logic
    if (!$new_name) $_err['name'] = 'Required';
    if (!$new_status) $_err['status'] = 'Required';

    if (empty($_err)) {
        // Update category details
        $stm = $_db->prepare('UPDATE category SET category_name = ?, category_status = ? WHERE category_id = ?');
        $stm->execute([$new_name, $new_status, $category_id]);

        temp('info', 'Category Details Updated');
        redirect('categoryList.php?page=' . $page . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order) . '&status=' . urlencode($status_filter) . '&search=' . htmlspecialchars($search_query));
    }
}
?>

<link rel="stylesheet" href="../css/product.css">
<a href="categoryList.php?page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>"><button type="button">⬅️ Back to Category List</button></a>
<h1>Category Details</h1>

<form method="post" class="form" id="category-form">
    <table>
        <div class="form-buttons">
            <button type="button" id="edit-button"><i class="fas fa-edit"></i></button>
            <button type="button" id="cancel-button" style="display: none;"><i class="fas fa-times"></i></button>
        </div>
        <tr>
            <th>Category Name:</th>
            <td>
                <input type="text" name="name" id="name" maxlength="100" value="<?= htmlspecialchars($category->category_name) ?>" required>
                <?= isset($_err['name']) ? "<span class='error'>{$_err['name']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                <select name="status" id="status">
                    <option value="Available" <?= $category->category_status == 'Available' ? 'selected' : '' ?>>Available</option>
                    <option value="Unavailable" <?= $category->category_status == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
                </select>
                <?= isset($_err['status']) ? "<span class='error'>" . htmlspecialchars($_err['status']) . "</span>" : '' ?>
            </td>
        </tr>
    </table>
    <button type="submit" id="submit-button" style="display: none;">Update Category</button>
</form>

<script src="../js/productEdit.js"></script>

