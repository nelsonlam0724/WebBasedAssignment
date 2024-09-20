<?php
include '../_base.php';
require_once '../lib/SimplePager.php';
include '../include/header.php';

// $search = req('search');
// $category = req('category_id');
// $p =  [];
// $getProduct = [];
// $page = req('page', 1);

// if (!empty($search) && !empty($category)) {
//   $sql_product = 'SELECT * FROM  product WHERE  name LIKE ? AND category_id = ? ';
//   $p = new SimplePager($sql_product, ['%' . $search . '%', $category], 10, $page);
//   $getProduct = $p->result;
// } else if (empty($search) && !empty($category)) {
//     $sql_product = 'SELECT * FROM  product WHERE category_id = ? ';
//     $p = new SimplePager($sql_product, [$category], 10, $page);
//     $getProduct = $p->result;
// } else {
//     $p = new SimplePager('SELECT * FROM product WHERE name LIKE ?', ['%' . $search . '%'], 10, $page);
//     $getProduct = $p->result;
// }

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;


$query = 'SELECT * FROM product WHERE 1=1';
$params = [];

if ($category) {
  $query .= ' AND category_id = ?';
  $params[] = $search;
}

if($search) {
  $query .= ' AND name LIKE ?';
  $params[] = '%' . $search . '%';
}

$pager = new SimplePager($query, $params, $limit, $page);
$getProduct = $pager->result;
$total_pages = $pager->page_count;


$getCategory = $_db->query('
    SELECT * FROM category 
');
$CategoryResults = $getCategory->fetchAll();
?>


<link rel="stylesheet" href="../css/product.css">

<div class="items">
  <div class="line1">
    <p><?= $pager->item_count ?> product</p>
    <p>
      <?= $pager->count ?> of <?= $pager->item_count ?> product(s)
    </p>
    <div class="filter-container">
      <p class="filter-button">
        Filter <i class='bx bx-filter'></i>
      </p>
      <form action="product.php" method="get">
      <ul class="filter-list">
      <select name="category" id="category" onchange="this.form.submit()">
          <option>ALL</option>   
        <?php foreach ($CategoryResults as $category): ?>
            <option value="<?= $category->category_id ?>" >
            <?= $category->category_name ?>
            </option>
        <?php endforeach ?>
        </select>
      </ul>
      </form>
    </div>
  </div>
  <?php if ($pager->item_count == 0) { ?>
    <div style="padding:30px;">
      <h2>No results for " <?= $search  ?> "</h2>
    </div>
  <?php } ?>
  <div class="items-lists">

    <?php
    if ($pager->item_count != 0) {
      foreach ($getProduct as $i):

        $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
        $getProductImg->execute([$i->product_id]);
        $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
        $productPhoto = $productImg ? $productImg->product_photo : 'default_image.jpg';

    ?>

        <div class="items-card cards">
          <img src="../uploads/<?= $productPhoto ?>" width="100" height="200">
          <div class="text2">
            <p class="product-name space"> <?= $i->name ?></p>
            <p class="product-price space">RM <?= $i->price ?></p>
            <p class="product-stock space"><?= $i->name ?> Stock</p>
            <p class="product-sold space">22 sold</p>
          </div>
          <div class="button-select">
            <div class="wishlist" data-productid="<?= $i->product_id ?>">
              <p><i class="fa fa-heart"></i></p>
            </div>
            <div class="selection-button">
              <div class="add-to-card  add_card" data-add="<?= $i->product_id ?>">
                <p><i class='bx bx-cart' style="font-size:24px"></i>Add To Card</p>
              </div>
              <a href="#">
                <div class="view-product">
                  <a href="items.php?id=<?= $i->product_id ?>">
                    <p style="color:white"><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                  </a>
                </div>
              </a>
            </div>
          </div>
        </div>
    <?php endforeach;
    } ?>
  </div>
  <div style="padding:30px;display:grid;place-items:center;">

    <?php if ($pager->item_count != 0) { ?>
      <p style="padding:50px;">
        <?= $pager->page ?> / <?= $pager->page_count ?>
      </p>
    <?php } else {
      echo '<img  src="../images/search.png"  width="100" height="100" >';
    ?>
    <?php } ?>

     <!-- Pagination Links -->
     <div class="pagination">
                <!-- Previous Page Link -->
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>">Previous</a>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php
                $page_range = 2; // Number of pages to show before and after the current page
                $start_page = max(1, $page - $page_range);
                $end_page = min($total_pages, $page + $page_range);

                if ($start_page > 1): ?>
                    <a href="?page=1&search=<?= urlencode($search) ?>&category=<?= urlencode($category)?>">1</a>
                    <?php if ($start_page > 2): ?>
                        <span>...</span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                    <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category)?>" class="<?= $i == $page ? 'current-page' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($end_page < $total_pages): ?>
                    <?php if ($end_page < $total_pages - 1): ?>
                        <span>...</span>
                    <?php endif; ?>
                    <a href="?page=<?= $total_pages ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category)?>">
                        <?= $total_pages ?>
                    </a>
                <?php endif; ?>

                <!-- Next Page Link -->
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category)?>">Next</a>
                <?php endif; ?>
            </div>
  </div>
</div>
</body>
<script src="../js/product.js"></script>
<script></script>

</html>