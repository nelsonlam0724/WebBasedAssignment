<?php
include '../_base.php';

if (is_post()) {
    $name = req('name');
    $price = req('price');
    $quantity = req('quantity');
    $p = get_file('photo');
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

    if (!$p) {
        $_err['photo'] = 'Required';
    } else if (!str_starts_with($p->type, 'image/')) {
        $_err['photo'] = 'Must be image';
    } else if ($p->size > 1 * 1024 * 1024) {
        $_err['photo'] = 'Maximum 1MB';
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
        $photo = save_photo_admin($p);

        $stm = $_db->prepare('
    INSERT INTO product (name, price, category_id, quantity, product_photo, description, weight)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ');

        $stm->execute([$name, $price, $category_id, $quantity, $photo, $desc, $weight]);

        temp('info', 'Record inserted');
    }
}

$_title = 'Product | List';
include '../_head.php';
?>

<link rel="stylesheet" href="../css/product.css">
<form method="post" class="form" enctype="multipart/form-data">
    
    <label for="name">Product Name</label><br>
    <?= html_text('name', 'maxlength="100"') ?>
    <?= err('name') ?>
    <br>
    <label for="price">Price</label><br>
    <?= html_text('price', 'maxlength="100"') ?>
    <?= err('price') ?>
    <br>
    <label for="quantity">Quantity</label><br>
    <?= html_number('quantity', 1, 100, 1, 'class="form-control"') ?>
    <?= err('quantity') ?>
    <br>
    <label for="photo">Product Photo</label><br>
    <label class="upload" tabindex="0">
        <?= html_file('photo', 'image/*', 'hidden') ?>
        <img src="../images/photo.jpg">
    </label>
    <?= err('photo') ?>
    <br>
    <label for="description">Description</label><br>
    <?= html_textarea('description', 'placeholder="Enter Description"') ?>
    <?= err('description') ?>
    <br>
    <label for="weight">Weight</label><br>
    <?= html_text('weight', 'maxlength="100"') ?>
    <?= err('weight') ?>
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
    <button type="submit">Submit</button>
</form>

<script src="../js/product.js"></script>

<?php
include '../_foot.php';
