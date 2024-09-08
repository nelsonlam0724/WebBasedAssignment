<?php
include '../_base.php';
auth('Admin');

if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']);
    $filePath = '../backup/' . $fileName;

    if (!file_exists($filePath)) {
        temp('info', 'Error: Backup file not found.');
        redirect('backup.php');
    }
} else {
    temp('info', 'Error: No file specified.');
    redirect('backup.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Download</title>
    <link rel="stylesheet" href="../css/backup.css">
    <script src="../js/backup.js"></script>
</head>
<body>
    <div class="container">
        <form class="form-group">
        <h1>Confirm Download</h1>
        <p>Do you want to download the local backup database SQL file?</p>
        <button onclick="downloadAndRedirect('<?php echo htmlspecialchars($fileName); ?>')">Download</button>
    </form>
    </div>
    <div class="action-buttons">
        <a href="backup.php"><button>Back to Backup</button></a>
        <a href="admin.php"><button>Back to Menu</button></a>
    </div>
</body>
</html>
