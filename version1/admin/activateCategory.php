<?php
include '../_base.php';
auth('Root', 'Admin');
if (is_post() && isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    if (is_array($category_id)) {
        $category_ids = $category_id;
    } else {
        $category_ids = [$category_id];
    }

    $stm = $_db->prepare('UPDATE category SET category_status = "Activate" WHERE category_id IN (' . implode(',', array_fill(0, count($category_ids), '?')) . ')');
    $stm->execute($category_ids);

    $category_names = [];
    foreach ($category_ids as $id) {
        $category_stm = $_db->prepare('SELECT category_name FROM category WHERE category_id = ?');
        $category_stm->execute([$id]);
        $category_name = $category_stm->fetchColumn();
        $category_names[] = $category_name;
    }

    $message = "$category_name activated successfully.";
    temp('info', $message);
    redirect('productList.php');
} else {
    temp('info', 'No categories selected for activation.');
    redirect('productList.php');
}