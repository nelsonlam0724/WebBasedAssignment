<?php
include '../_base.php';
include '../include/sidebarAdmin.php'; 
auth('Root', 'Admin');

// Initialize variables
$name = $price = $quantity = $category_id = $new_category = $desc = $weight = '';
$photos = [];
$message = ''; // Success message
$low_stock_thresold = 1;

if (is_post()) {
    $name = req('name');
    $price = req('price');
    $quantity = req('quantity');
    $photos = get_file_multiple('photo');
    $category_id = req('category_id');
    $new_category = req('new_category');
    $desc = req('description');
    $weight = req('weight');

    // Validation logic
    $_err = []; // Initialize error array
    
    if (!$name) {
        $_err['name'] = 'Required';
    } else if (strlen($name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
    }

    if (!$price) {
        $_err['price'] = 'Required';
    } else if (!is_money($price)) {
        $_err['price'] = 'Invalid price format';
    } else if (strlen($price) > 1000) {
        $_err['price'] = 'Price too high';
    }

    if (!$quantity) {
        $_err['quantity'] = 'Required';
    } else if ($quantity < $low_stock_thresold) {
        echo '<div class="low-stock-alert">Warning: Low stock! Quantity is below the minimum threshold.</div>';
    }

    if (!$photos) {
        $_err['photo'] = 'Required';
    } else {
        foreach ($photos as $p) {
            if (!str_starts_with($p->type, 'image/')) {
                $_err['photo'] = 'Must be image';
                break;
            } else if ($p->size > 1 * 1024 * 1024) {
                $_err['photo'] = 'Maximum 1MB';
                break;
            }
        }
    }

    if (!$category_id && !$new_category) {
        $_err['category_id'] = 'Required';
    }
    
    if ($new_category && strlen($new_category) > 100) {
        $_err['new_category'] = 'Maximum 100 characters';
    }

    if (!$desc) {
        $_err['description'] = 'Required';
    } else if (strlen($desc) > 1000) {
        $_err['description'] = 'Maximum 1000 characters';
    }

    if (!$weight) {
        $_err['weight'] = 'Required';
    } else if (strlen($weight) > 100) {
        $_err['weight'] = 'Maximum 100 characters';
    }

    if (!$_err) {
        if ($new_category) {
            // Insert new category
            $new_category_id = generateID('category', 'category_id', 'CT', 4);
            $stm = $_db->prepare('INSERT INTO category (category_id, category_name, category_status) VALUES (?, ?, "Activate")');
            $stm->execute([$new_category_id, $new_category]);
            $category_id = $new_category_id;
        }

        // Insert product
        $product_id = generateID('product', 'product_id', 'P', 4);
        $stm = $_db->prepare('INSERT INTO product (product_id, name, price, category_id, quantity, description, weight, status) VALUES (?, ?, ?, ?, ?, ?, ?, "Available")');
        $stm->execute([$product_id, $name, $price, $category_id, $quantity, $desc, $weight]);

        // Insert product images
        $photos = array_slice($photos, 0, 5); // Limit to 3 images
        foreach ($photos as $p) {
            $photo = save_photo_admin($p); // Save each image
            $image_id = generateID('product_image', 'image_id', 'I', 4);
            $stm = $_db->prepare('INSERT INTO product_image (image_id, product_id, product_photo) VALUES (?, ?, ?)');
            $stm->execute([$image_id, $product_id, $photo]);
        }

        // Determine which button was clicked
        if (isset($_POST['add_another'])) {
            temp('info', 'Product added successfully. You can add another product.');
            // Clear the form fields after successful insertion for new product input
            $name = $price = $quantity = $desc = $weight = $category_id = $new_category = '';
            $photos = [];
        } else {
            // Regular form submission, redirect to the product list page
            temp('info', 'Product added successfully.');
            redirect('productList.php');
        }
    }
}

// HTML form section
$_title = 'Add New Product';
include '../_head.php';
?>
<script src="../js/preview.js"></script>
<link rel="stylesheet" href="../css/product.css">
<h1>Add New Product</h1>

<?php if ($message): ?>
    <div class="success-message"><?= $message ?></div>
<?php endif; ?>

<form method="post" class="form" enctype="multipart/form-data">

    <label for="name">Product Name</label><br>
    <?= html_text('name', 'maxlength="100" value="'.htmlspecialchars($name).'"') ?>
    <?= err('name') ?>
    <br><br>

    <label for="price">Price</label><br>
    <?= html_text('price', 'maxlength="100" value="'.htmlspecialchars($price).'"') ?>
    <?= err('price') ?>
    <br><br>

    <label for="quantity">Quantity</label><br>
    <?= html_number('quantity', 1,'', 1, 'class="form-control" value="'.htmlspecialchars($quantity).'"') ?>
    <?= err('quantity') ?>
    <br><br>

    <label for="photo">Product Photos</label><br>
    <label class="upload" tabindex="0">
        <?= html_file('photo[]', 'image/*', 'multiple id="photo"') ?>
        <img src="../images/photo.jpg" alt="Default Photo" id="default-photo">
        <div id="image-previews" class="preview-container"></div>
    </label>
    <?= err('photo') ?>
    <br><br>

    <label for="description">Description</label><br>
    <?= html_textarea('description', 'placeholder="Enter Description"') ?>
    <?= err('description') ?>
    <br><br>

    <label for="weight">Weight</label><br>
    <?= html_text('weight', 'maxlength="100" value="'.htmlspecialchars($weight).'"') ?>
    <?= err('weight') ?>
    <br><br>

    <label for="category">Category</label><br>
    <select name="category_id">
        <option value="">Select a category</option>
        <?php
        $categories = $_db->query('SELECT category_id, category_name FROM category')->fetchAll();
        foreach ($categories as $category) {
            $selected = $category_id == $category->category_id ? 'selected' : '';
            echo '<option value="' . $category->category_id . '" ' . $selected . '>' . htmlspecialchars($category->category_name) . '</option>';
        }
        ?>
    </select>
    <?= err('category_id') ?>
    <br><br>

    <button type="submit" name="submit" id="submit-button">Submit</button>
    <button type="submit" name="add_another" id="add-another-button">Add Another Product</button>
</form>

<?php
include '../_foot.php';
