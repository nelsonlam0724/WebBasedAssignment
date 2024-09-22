<?php
include '../_base.php';
include '../include/sidebarAdmin.php';
auth('Admin', 'Root');

$comments_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $comments_per_page;

// Search query
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query for comments with pagination and search
$query = "SELECT * FROM comment WHERE comment LIKE :search ORDER BY datetime DESC LIMIT :offset, :comments_per_page";
$stmt = $_db->prepare($query);
$search_param = "%" . $search_query . "%";
$stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':comments_per_page', $comments_per_page, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll();

// Count total comments for pagination
$count_query = "SELECT COUNT(*) as total_comments FROM comment WHERE comment LIKE :search";
$count_stmt = $_db->prepare($count_query);
$count_stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
$count_stmt->execute();
$total_comments = $count_stmt->fetch(PDO::FETCH_OBJ)->total_comments;
$total_pages = ceil($total_comments / $comments_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comment List</title>
    <link rel="stylesheet" href="../css/commentList.css">
</head>

<body>
    <div class="container">
        <h1>Comment List</h1>

        <!-- Search form -->
        <form method="GET" action="commentList.php">
            <input type="text" name="search" placeholder="Search comments" value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit" class="form-button">Search</button>
        </form>

        <!-- Comment Table -->
        <table>
            <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>Product ID</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($comments): ?>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment->comment_id) ?></td>
                            <td><?= htmlspecialchars($comment->product_id) ?></td>
                            <td><?= htmlspecialchars($comment->datetime) ?></td>
                            <td>
                                <a href="reply.php?comment_id=<?= urlencode($comment->comment_id) ?>">
                                    <button class="reply-button">Reply</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-results">No comments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=1&search=<?= urlencode($search_query) ?>">First</a>
            <?php endif; ?>

            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search_query) ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>&search=<?= urlencode($search_query) ?>" <?= ($i == $page) ? 'class="current-page"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search_query) ?>">Next</a>
            <?php endif; ?>
        </div>
        <div class="action-buttons">
            <a href="admin.php"><button>Back To Menu</button></a>
        </div>
    </div>

</body>

</html>