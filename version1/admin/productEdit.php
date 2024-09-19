<?php
include '../_base.php';
$_title = 'Product Details';
include '../_head.php';

$_err = [];

// Get product ID from request
$product_id = req('product_id');

if (!$product_id) {
    temp('info', 'Product ID Not Found');
    redirect('productList.php');
}

// Fetch product details
$stm = $_db->prepare('SELECT * FROM product WHERE product_id = ?');
$stm->execute([$product_id]);
$product = $stm->fetch();

// Fetch all product images with their IDs
$stm = $_db->prepare('SELECT image_id, product_photo FROM product_image WHERE product_id = ?');
$stm->execute([$product_id]);
$images = $stm->fetchAll();

if (!$product) {
    redirect('productList.php');
}

if (is_post()) {
    // Retrieve form data
    $new_name = req('name');
    $new_price = req('price');
    $new_category = req('category_id');
    $new_quantity = req('quantity');
    $new_weight = req('weight');
    $new_description = req('description');
    $new_product_photos = get_file_multiple('photo'); // Fetch multiple files
    $existing_image_ids = req('existing_image_ids'); // Fetch existing image IDs

    // Validation
    if (!$new_name) {
        $_err['name'] = 'Required';
    } elseif (strlen($new_name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
    }

    if (!$new_price) {
        $_err['price'] = 'Required';
    } elseif (!is_money($new_price)) {
        $_err['price'] = 'Invalid price format';
    } elseif ($new_price > 1000) {
        $_err['price'] = 'Price too high';
    }

    if (!$new_quantity) {
        $_err['quantity'] = 'Required';
    }

    if (!$new_category) {
        $_err['category_id'] = 'Required';
    }

    if (!$new_description) {
        $_err['description'] = 'Required';
    } elseif (strlen($new_description) > 1000) {
        $_err['description'] = 'Maximum 1000 characters';
    }

    if (!$new_weight) {
        $_err['weight'] = 'Required';
    } elseif (strlen($new_weight) > 100) {
        $_err['weight'] = 'Maximum 100 characters';
    }

    // Handle file uploads
    if (!empty($new_product_photos)) {
        foreach ($new_product_photos as $photo) {
            if ($photo->error === UPLOAD_ERR_OK) {
                if (!in_array($photo->type, ['image/jpeg', 'image/png'])) {
                    $_err['photo'] = 'All files must be JPEG or PNG';
                    break;
                } elseif ($photo->size > 1 * 1024 * 1024) {
                    $_err['photo'] = 'Files must be 1MB or smaller';
                    break;
                }
            }
        }
    }

    if (empty($_err)) {
        // Update product details
        $stm = $_db->prepare('UPDATE product SET name = ?, price = ?, category_id = ?, quantity = ?, weight = ?, description = ? WHERE product_id = ?');
        $stm->execute([$new_name, $new_price, $new_category, $new_quantity, $new_weight, $new_description, $product_id]);

        // Update existing images
        if (!empty($existing_image_ids)) {
            foreach ($existing_image_ids as $index => $image_id) {
                if (isset($_FILES['photo']['tmp_name'][$index]) && !empty($_FILES['photo']['tmp_name'][$index])) {
                    $file = $_FILES['photo']['tmp_name'][$index];
                    if (file_exists($file)) {
                        $photo_path = save_photo_admin($file);
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
<a href="productList.php"><button type="button">⬅️ Back to Product List</button></a>
<h1>Product Details</h1>

<button type="button" id="edit-button">Edit</button>
<button type="button" id="cancel-button" style="display: none;">Cancel</button>

<form method="post" enctype="multipart/form-data" class="form" id="product-form">
    <table>
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
                <select name="category_id">
                    <?php
                    $categories = $_db->query('SELECT category_id, category_name FROM category')->fetchAll();
                    foreach ($categories as $category) {
                        $selected = ($category->category_id == $product->category_id) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($category->category_id) . '" ' . $selected . '>' . htmlspecialchars($category->category_name) . '</option>';
                    }
                    ?>
                </select>
                <?= isset($_err['category_id']) ? "<span class='error'>{$_err['category_id']}</span>" : '' ?>
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
include '../_foot.php';
?>