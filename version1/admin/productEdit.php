<?php
include '../_base.php';
$_title = 'Product Details';
include '../_head.php';

$_err = [];

$product_id = req('product_id');

if (!$product_id) {
    temp('info', 'Product ID Not Found');
    redirect('productList.php');
}

$stm = $_db->prepare('SELECT * FROM product WHERE product_id = ?');
$stm->execute([$product_id]);
$product = $stm->fetch();

if (!$product) {
    redirect('productList.php');
}

if (is_post()) {
    // Validation and update logic
    $new_name = req('name');
    $new_price = req('price');
    $new_category = req('category_id');
    $new_quantity = req('quantity');
    $new_weight = req('weight');
    $new_description = req('description');
    $new_product_photo = get_file('photo');

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

    if (!empty($new_product_photo['name']) && $new_product_photo['error'] === UPLOAD_ERR_OK) {
        if (!in_array($new_product_photo['type'], ['image/jpeg', 'image/png'])) {
            $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
        } elseif ($new_product_photo['size'] > 2 * 1024 * 1024) { // 2MB max size
            $_err['photo'] = 'File size exceeds 2MB.';
        }
    } else {
        $product_photo_name = $product->product_photo; // Retain the existing photo
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

    // Update the product if there are no validation errors
    if (empty($_err)) {
        if (!empty($new_product_photo['name']) && $new_product_photo['error'] == UPLOAD_ERR_OK) {
            $product_photo_name = save_photo($new_product_photo);
        } else {
            $product_photo_name = $product->product_photo;
        }

        $stm = $_db->prepare('UPDATE product SET name = ?, price = ?, category_id = ?, quantity = ?, weight = ?, description = ?, product_photo = ? WHERE product_id = ?');
        $stm->execute([$new_name, $new_price, $new_category, $new_quantity, $new_weight, $new_description, $product_photo_name, $product_id]);

        temp('info', 'Product Details Updated');
        redirect('productList.php');
    }
}
?>

<link rel="stylesheet" href="../css/product.css">
<a href="productList.php"><button type="button">Back to Product List</button></a>
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
            <th>Product Photo:</th>
            <td>
                <label class="upload">
                    <input type="file" name="photo" id="photo" accept="image/*" style="display: none;">
                    <img src="../uploads/<?= htmlspecialchars($product->product_photo) ?>" alt="Product Photo" id="product-photo">
                </label>
                <?= isset($_err['photo']) ? "<span class='error'>{$_err['photo']}</span>" : '' ?>
            </td>
        </tr>
    </table>
    <button type="submit" id="submit-button" style="display: none;">Update Product</button>
</form>

<script>
document.getElementById('edit-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = false; // Enable form inputs for editing
    });

    // Show the "Update Product" and "Cancel" buttons, hide the "Edit" button
    document.getElementById('submit-button').style.display = 'inline'; 
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('cancel-button').style.display = 'inline';
});

document.getElementById('cancel-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = true; // Disable form inputs when canceling
    });

    // Hide the "Update Product" and "Cancel" buttons, show the "Edit" button
    document.getElementById('submit-button').style.display = 'none';
    document.getElementById('edit-button').style.display = 'inline';
    document.getElementById('cancel-button').style.display = 'none';
    
    // Optional: reset form fields to original values
    document.getElementById('product-form').reset();
    document.getElementById('product-photo').src = '../uploads/<?= htmlspecialchars($product->product_photo) ?>';
});

// Initially, disable all input fields and hide the "Update Product" button
document.querySelectorAll('#product-form input, #product-form select, #product-form textarea').forEach(function(element) {
    element.disabled = true;
});

document.getElementById('submit-button').style.display = 'none'; // Hide the submit button by default

</script>
<?php
include '../_foot.php';
?>