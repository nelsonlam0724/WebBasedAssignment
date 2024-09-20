<?php
include '../_base.php';
include 'sidebar.php'; 

if (is_post()) {
    $name = req('name');
    $price = req('price');
    $quantity = req('quantity');
    $photos = get_file_multiple('photo'); 
    $category_id = req('category_id');
    $desc = req('description');
    $weight = req('weight');

    //Validation
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

    if (!$category_id) {
        $_err['category_id'] = 'Required';
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
        $product_id = generateID('product', 'product_id', 'P', 4);
        $stm = $_db->prepare('
        INSERT INTO product (product_id, name, price, category_id, quantity, description, weight, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, "Available")
        ');
        $stm->execute([$product_id, $name, $price, $category_id, $quantity, $desc, $weight]);

        $photos = array_slice($photos, 0, 5); // Limit to 3 images

        foreach ($photos as $p) {
            $photo = save_photo_admin($p); // Save each image
            $image_id = generateID('product_image', 'image_id', 'I', 4);
            $stm = $_db->prepare('
            INSERT INTO product_image (image_id, product_id, product_photo)
            VALUES (?, ?, ?)
            ');
            $stm->execute([$image_id, $product_id, $photo]);
        }

        temp('info', 'Record inserted');
        redirect('productList.php');
    }
}

$_title = 'Add New Product';
include '../_head.php';
?>

<link rel="stylesheet" href="../css/product.css">
<a href="productList.php"><button type="button">⬅️ Back to Product List</button></a>
<h1>Add New Product</h1>
<form method="post" class="form" enctype="multipart/form-data">
    
    <label for="name">Product Name</label><br>
    <?= html_text('name', 'maxlength="100"') ?>
    <?= err('name') ?>
    <br>
    <br>
    <label for="price">Price</label><br>
    <?= html_text('price', 'maxlength="100"') ?>
    <?= err('price') ?>
    <br>
    <br>
    <label for="quantity">Quantity</label><br>
    <?= html_number('quantity', 1, 100, 1, 'class="form-control"') ?>
    <?= err('quantity') ?>
    <br>
    <br>
    <label for="photo">Product Photos</label><br>
    <label class="upload" tabindex="0">
        <?= html_file('photo[]', 'image/*', 'multiple id="photo"') ?>
        <img src="../images/photo.jpg" alt="Default Photo" id="default-photo">
        <div id="image-previews" class="preview-container"></div>
    </label>
    <?= err('photo') ?>
    <br>
    <br>
    <label for="description">Description</label><br>
    <?= html_textarea('description', 'placeholder="Enter Description"') ?>
    <?= err('description') ?>
    <br>
    <br>
    <label for="weight">Weight</label><br>
    <?= html_text('weight', 'maxlength="100"') ?>
    <?= err('weight') ?>
    <br>
    <br>
    <label for="category">Category</label><br>
    <select name="category_id">
        <option value="">Select a category</option>
        <?php
        $categories = $_db->query('SELECT category_id, category_name FROM category')->fetchAll();
        foreach ($categories as $category) {
            echo '<option value="' . $category->category_id . '">' . $category->category_name . '</option>';
        }
        ?>
    </select>
    <?= err('category_id') ?>
    <br>
    <br>
    <button type="submit">Submit</button>
</form>

<script src="../js/product.js"></script>

<?php
include '../_foot.php';
