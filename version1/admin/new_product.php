<?php
include '../_base.php';

if (is_post()) {
    $name = req('name');
    $price = req('price');
    $quantity = req('quantity');
    $p = get_file('photo');
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
    }
    else if (!str_starts_with($p->type, 'image/')) {
        $_err['photo'] = 'Must be image';
    }
    else if ($p->size > 1 * 1024 * 1024) {
        $_err['photo'] = 'Maximum 1MB';
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
        $photo = save_photo($f, '../photo');

        echo 
    
    $stm = $_db->prepare('
    INSERT INTO product (name, price, quantity, photo, description, weight)
    VALUES (?, ?, ?, ?, ?, ?)
    ');

    $stm->execute([$name, $price, $quantity, $photo, $desc, $weight]);

        die();

    temp('info', 'Record inserted');
}
}

$_title = 'Product | List';
include '../_head.php';
?>

<form method="post" class="form">

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
<img src="/images/photo.jpg">
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
<button type="submit">Submit</button>
</form>

<?php
include '../_foot.php';