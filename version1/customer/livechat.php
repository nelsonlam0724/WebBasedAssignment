<?php
ob_start();

include '../_base.php';
include '../_head.php';
include '../include/header.php';
include '../include/sidebar.php';

auth('Member');

$user = $_SESSION['user'];

$query = "SELECT * FROM chat_messages ORDER BY created_at DESC";
$stm = $_db->prepare($query);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

$messages = [];
if ($result) {
    $messages = $result;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? '';

    if (!empty($message)) {
        $stmt = $_db->prepare("INSERT INTO chat_messages (message, created_at, sender_type) VALUES (?, NOW(), 'user')");
        $stmt->bindParam(1, $message);

        if ($stmt->execute()) {
            $replyMessage = generateReply($message);
            $replyStmt = $_db->prepare("INSERT INTO chat_messages (message, created_at, sender_type) VALUES (?, NOW(), 'admin')");
            $replyStmt->bindParam(1, $replyMessage);
            $replyStmt->execute();

            header("Location: livechat.php");
            exit;
        } else {
            echo "Failed to send message.";
        }
    } else {
        echo "Message cannot be empty.";
    }
}

function generateReply($message)
{
    if (stripos($message, 'hello') !== false) {
        return "Hi there! How can I help you today?";
    } elseif (stripos($message, 'help') !== false) {
        return "What do you need help with?";
    } else {
        return "Thank you for your message: '" . htmlspecialchars($message) . "'";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/livechat.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Live Chat</title>
</head>

<body>
    <br><br><br><br><br><br>
    <h1>Live Chat</h1>
    <div id="info"></div>

    <div id="chat-box">
        <?php foreach ($messages as $msg): ?>
            <div class="message <?php echo $msg['sender_type'] === 'admin' ? 'admin-message' : 'user-message'; ?>">
                <time><?php echo htmlspecialchars($msg['created_at']); ?></time>:
                <span class="message-content">
                    <?php
                    if ($msg['sender_type'] === 'admin') {
                        echo "<strong>Admin:</strong> " . htmlspecialchars($msg['message']);
                    } else {
                        echo "<strong>" . htmlspecialchars($user->name) . ":</strong> " . htmlspecialchars($msg['message']);
                    }
                    ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>


    <form id="chat-form" method="POST">
        <input type="text" id="chat-input" name="message" placeholder="Type a message..." required>
        <button type="submit" id="send-button">Send</button>
    </form>

    <script src="../js/livechat.js"></script>
</body>

</html>

<?php
ob_end_flush();
?>