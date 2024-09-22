<?php
// Include the database connection
include '../_base.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');
// Get the comment ID from the query parameter
$comment_id = isset($_GET['comment_id']) ? $_GET['comment_id'] : '';

// Fetch comment details
$query = "SELECT * FROM comment WHERE comment_id = :comment_id";
$stmt = $_db->prepare($query);
$stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_STR);
$stmt->execute();
$comment = $stmt->fetch();

if (!$comment) {
    die('Comment not found.');
}

// Handle reply submission
if (is_post()) {
    $reply = $_POST['reply'];

    // Update the reply column in the database
    $update_query = "UPDATE comment SET reply = :reply WHERE comment_id = :comment_id";
    $update_stmt = $_db->prepare($update_query);
    $update_stmt->bindParam(':reply', $reply, PDO::PARAM_STR);
    $update_stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_STR);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('Reply submitted successfully.');</script>";
        echo "<script>window.location.href = 'commentList.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to submit reply.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reply to Comment</title>
    <link rel="stylesheet" href="../css/userList.css">
    <style>
        body {
            display: flex;
            margin: 0;
        }
        .container {
            padding: 20px;
            flex-grow: 1;
            background-color: #ffffff; /* Main content background */
        }
        h1, h2 {
            margin: 0 0 10px;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .edit-icon {
            margin-left: 10px;
            text-decoration: none;
            color: blue; /* Change color as needed */
            cursor: pointer;
        }
        .edit-icon:hover {
            text-decoration: underline;
        }
        .reply-form {
            display: none; /* Hide the reply form by default */
        }
    </style>
    <script>
        function showReplyForm() {
            document.getElementById('replyForm').style.display = 'block';
            document.getElementById('replyText').focus();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Comment Reply</h1>
        <p><strong>Comment ID:</strong> <?= htmlspecialchars($comment->comment_id) ?></p>
        <p><strong>Product ID:</strong> <?= htmlspecialchars($comment->product_id) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($comment->datetime) ?></p>
        <p><strong>Comment:</strong> <?= htmlspecialchars($comment->comment) ?></p>

        <h2>Reply to Comment</h2>

        <?php if (!empty($comment->reply)): ?>
            <div>
                <p><strong>Reply:</strong> <?= htmlspecialchars($comment->reply) ?></p>
                <span class="edit-icon" onclick="showReplyForm()">✏️ Edit</span>
            </div>
            <form method="POST" id="replyForm" class="reply-form">
                <textarea id="replyText" name="reply" required placeholder="Enter your reply here..."></textarea>
                <button type="submit">Submit Reply</button>
            </form>
        <?php else: ?>
            <form method="POST">
                <textarea name="reply" required placeholder="Enter your reply here..."></textarea>
                <button type="submit">Submit Reply</button>
            </form>
        <?php endif; ?>

        <a href="commentList.php">Back to Comments</a>
    </div>
</body>
</html>

