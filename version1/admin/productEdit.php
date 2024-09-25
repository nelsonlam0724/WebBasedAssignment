<?php
include '../_base.php';
$_title = 'Product Details';
include '../_head.php';
include '../include/sidebarAdmin.php';

auth('Root', 'Admin');
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'product_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$category_filter = isset($_GET['category']) ? $_GET['category'] : ''; // Category filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';

$_err = [];
$product_id = req('product_id');
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if (!$product_id) {
    temp('info', 'Product ID Not Found');
    redirect('productList.php?page=' . $page . '&search=' . urlencode($search_query) . '&category=' . urlencode($category_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
}

$stm = $_db->prepare(
    '
    SELECT p.*, c.category_name 
    FROM product p 
    LEFT JOIN category c ON p.category_id = c.category_id 
    WHERE p.product_id = ?'
);
$stm->execute([$product_id]);
$product = $stm->fetch(PDO::FETCH_OBJ);

if (!$product) {
    redirect('productList.php?page=' . $page . '&search=' . urlencode($search_query) . '&category=' . urlencode($category_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
}

$stm = $_db->prepare('SELECT image_id, product_photo FROM product_image WHERE product_id = ?');
$stm->execute([$product_id]);
$images = $stm->fetchAll();

if (is_post()) {
    // Get form data
    $new_name = req('name');
    $new_price = req('price');
    $new_category = req('category_id');
    $new_quantity = req('quantity');
    $new_weight = req('weight');
    $new_description = req('description');
    $new_status = req('status');
    $existing_image_ids = req('existing_image_ids');

    // Validation logic
    if (!$new_name) $_err['name'] = 'Required';
    if (!$new_price) $_err['price'] = 'Required';
    if (!$new_quantity) $_err['quantity'] = 'Required';
    if (!$new_weight) $_err['weight'] = 'Required';
    if (!$new_description) $_err['description'] = 'Required';
    if (!$new_status) $_err['status'] = 'Required';

    // Handle file uploads
    $new_product_photos = $_FILES['photo'];
    if (!empty($_FILES['photo'])) {
        foreach ($_FILES['photo']['tmp_name'] as $image_id => $tmp_name) {
            if (!empty($tmp_name) && $_FILES['photo']['error'][$image_id] === UPLOAD_ERR_OK) {
                $file_type = $_FILES['photo']['type'][$image_id];
                if (in_array($file_type, ['image/jpeg', 'image/png'])) {
                    if ($_FILES['photo']['size'][$image_id] <= 1 * 1024 * 1024) {
                        $photo_path = save_photo_admin($tmp_name);  // Function to save the image

                        // Check if there is an existing image ID
                        if (isset($existing_image_ids[$image_id]) && !empty($existing_image_ids[$image_id])) {
                            $stm = $_db->prepare('UPDATE product_image SET product_photo = ? WHERE image_id = ?');
                            $stm->execute([$photo_path, $existing_image_ids[$image_id]]);
                        } else {
                            $image_id = generateID('product_image', 'image_id', 'I', 4);
                            $stm = $_db->prepare('INSERT INTO product_image (image_id, product_id, product_photo) VALUES (?, ?, ?)');
                            $stm->execute([$image_id, $product_id, $photo_path]);
                        }
                    } else {
                        $_err['photo'] = 'Files must be 1MB or smaller';
                    }
                } else {
                    $_err['photo'] = 'All files must be JPEG or PNG';
                }
            }
        }
    }

    // Deleting selected images
    if (isset($_POST['delete_image_ids'])) {
        foreach ($_POST['delete_image_ids'] as $delete_image_id) {
            $stm = $_db->prepare('DELETE FROM product_image WHERE image_id = ?');
            $stm->execute([$delete_image_id]);
        }
        temp('info', 'Selected Product Photos Deleted Successfully');
        redirect();
    }



    if (empty($_err)) {
        // Update product details
        $stm = $_db->prepare('UPDATE product SET name = ?, price = ?, category_id = ?, quantity = ?, weight = ?, description = ?, status = ? WHERE product_id = ?');
        $stm->execute([$new_name, $new_price, $new_category, $new_quantity, $new_weight, $new_description, $new_status, $product_id]);

        temp('info', 'Product Details Updated');
        redirect('productList.php?page=' . $page . '&search=' . urlencode($search_query) . '&category=' . urlencode($category_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
    }
}
?>
<script src="../js/profile.js"></script>
<link rel="stylesheet" href="../css/product.css">
<a href="productList.php?page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>
                                    &sort_order=<?= urlencode($sort_order) ?>
                                    &category=<?= urldecode($category_filter) ?>&search=<?= htmlspecialchars($search_query) ?>"><button type="button">⬅️ Back to Product List</button></a>
<h1>Product Details</h1>

<form method="post" enctype="multipart/form-data" class="form" id="product-form">
    <table>
        <div class="form-buttons">
            <button type="button" id="edit-button"><i class="fas fa-edit"></i></button>
            <button type="button" id="cancel-button" style="display: none;"><i class="fas fa-times"></i></button>
        </div>
        <tr>
            <th>Product Name:</th>
            <td>
                <input type="text" name="name" id="name" maxlength="100" value="<?= htmlspecialchars($product->name) ?>" required>
                <?= isset($_err['name']) ? "<span class='error'>{$_err['name']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Price:</th>
            <td>
                <input type="text" name="price" id="price" value="<?= htmlspecialchars($product->price) ?>" required>
                <?= isset($_err['price']) ? "<span class='error'>{$_err['price']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Category:</th>
            <td>
                <select name="category_id" id="category-select">
                    <?php
                    $categories = $_db->query('SELECT category_id, category_name FROM category')->fetchAll();
                    foreach ($categories as $category) {
                        $selected = ($category->category_id == $product->category_id) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($category->category_id) . '" ' . $selected . '>' . htmlspecialchars($category->category_name) . '</option>';
                    }
                    ?>
                </select>
                <?= isset($_err['new_category_name']) ? "<span class='error'>{$_err['new_category_name']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Quantity:</th>
            <td>
                <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($product->quantity) ?>" min="1" required>
                <?= isset($_err['quantity']) ? "<span class='error'>{$_err['quantity']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Weight:</th>
            <td>
                <input type="number" name="weight" id="weight" value="<?= htmlspecialchars($product->weight) ?>" required>
                <?= isset($_err['weight']) ? "<span class='error'>{$_err['weight']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Description:</th>
            <td>
                <textarea name="description" id="description"><?= htmlspecialchars($product->description) ?></textarea>
                <?= isset($_err['description']) ? "<span class='error'>{$_err['description']}</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                <select name="status" id="status">
                    <option value="Available" <?= $product->status == 'Available' ? 'selected' : '' ?>>Available</option>
                    <option value="Unavailable" <?= $product->status == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
                </select>
                <?= isset($_err['status']) ? "<span class='error'>" . htmlspecialchars($_err['status']) . "</span>" : '' ?>
            </td>
        </tr>
        <tr>
            <th>Product Photos:</th>
            <td>
                <div id="product-photos">
                    <div class="image-wrapper">
                        <?php foreach ($images as $img): ?>
                            <div class="image-item">
                                <label class="upload" tabindex="0">
                                    <img src="../uploads/<?= htmlspecialchars($img->product_photo) ?>" alt="Product Photo" class="product-photo-preview">
                                    <input type="hidden" name="existing_image_ids[]" value="<?= htmlspecialchars($img->image_id) ?>">
                                    <input type="file" name="photo[]" accept="image/*">
                                </label>
                                <label>
                                    <input type="checkbox" name="delete_image_ids[]" value="<?= htmlspecialchars($img->image_id) ?>"> Delete
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <?php
                        $max_images = 5;
                        $remaining_images = $max_images - count($images);
                        for ($i = 0; $i < $remaining_images; $i++): ?>
                            <label class="upload" tabindex="0">
                                <img src="../images/photo.jpg" alt="Default Image" class="product-photo-preview">
                                <input type="file" name="photo[<?= count($images) + $i ?>]" id="photo-<?= count($images) + $i ?>" accept="image/*">
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
            </td>
        </tr>


    </table>
    <button type="submit" id="submit-button" style="display: none;">Update Product</button>
</form>
<script src="../js/productEdit.js"></script>