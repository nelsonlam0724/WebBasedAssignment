<?php
include '../_base.php';
$_title = 'Product Details';
include '../_head.php';
include '../include/sidebarAdmin.php'; 

auth('Root', 'Admin');

$_err = [];
$product_id = req('product_id');

if (!$product_id) {
    temp('info', 'Product ID Not Found');
    redirect('productList.php');
}

$stm = $_db->prepare('
    SELECT p.*, c.category_name 
    FROM product p 
    LEFT JOIN category c ON p.category_id = c.category_id 
    WHERE p.product_id = ?'
);
$stm->execute([$product_id]);
$product = $stm->fetch(PDO::FETCH_OBJ);

if (!$product) {
    redirect('productList.php');
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
    if (!empty($new_product_photos['name'][0])) {
        foreach ($new_product_photos['tmp_name'] as $index => $tmp_name) {
            if ($new_product_photos['error'][$index] === UPLOAD_ERR_OK) {
                $file_type = $new_product_photos['type'][$index];
                if (!in_array($file_type, ['image/jpeg', 'image/png'])) {
                    $_err['photo'] = 'All files must be JPEG or PNG';
                    break;
                }
                if ($new_product_photos['size'][$index] > 1 * 1024 * 1024) {
                    $_err['photo'] = 'Files must be 1MB or smaller';
                    break;
                }
            }
        }
    }

    if (empty($_err)) {
        // Update product details
        $stm = $_db->prepare('UPDATE product SET name = ?, price = ?, category_id = ?, quantity = ?, weight = ?, description = ?, status = ? WHERE product_id = ?');
        $stm->execute([$new_name, $new_price, $new_category, $new_quantity, $new_weight, $new_description, $new_status, $product_id]);

        // Update existing images
        if (!empty($existing_image_ids)) {
            foreach ($existing_image_ids as $index => $image_id) {
                if (isset($new_product_photos['tmp_name'][$index]) && !empty($new_product_photos['tmp_name'][$index])) {
                    $file = $new_product_photos['tmp_name'][$index];
                    if (file_exists($file)) {
                        $photo_path = save_photo_admin($file); // Your function to save the photo
                        $stm = $_db->prepare('UPDATE product_image SET product_photo = ? WHERE image_id = ?');
                        $stm->execute([$photo_path, $image_id]);
                    }
                }
            }
        }

        temp('info', 'Product Details Updated');
        redirect('productList.php');
    }
}
?>

<link rel="stylesheet" href="../css/product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<a href="productList.php"><button type="button">⬅️ Back to Product List</button></a>
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
                <label class="upload">
                    <input type="file" name="photo[]" id="photo" accept="image/*" multiple>
                    <div id="product-photos">
                        <div class="image-container">
                            <?php foreach ($images as $img): ?>
                                <div class="image-wrapper">
                                    <img src="../uploads/<?= htmlspecialchars($img->product_photo) ?>" alt="Product Photo" class="product-photo-preview">
                                    <input type="hidden" name="existing_image_ids[]" value="<?= htmlspecialchars($img->image_id) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </label>
                <?= isset($_err['photo']) ? "<span class='error'>{$_err['photo']}</span>" : '' ?>
            </td>
        </tr>
    </table>
    <button type="submit" id="submit-button" style="display: none;">Update Product</button>
</form>

<script src="../js/productEdit.js"></script>

<?php
include '../_foot.php'
?>