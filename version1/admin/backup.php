<?php
include '../_base.php';
auth('Admin');
$user = $_SESSION['user'];
if (is_post() && isset($_POST['tables'])) {
    $selectedTables = $_POST['tables'];

    $timestamp = date('Y-m-d_H-i-s');
    $backupFileName = 'backup_' . $timestamp . '.sql';
    $backupFilePath = '../backup/' . $backupFileName;

    $conn = $_db;

    // Store SQL backup
    $sql = '';
    foreach ($selectedTables as $table) {
        $result = $conn->query('SHOW CREATE TABLE ' . $table);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $sql .= "\n" . $row['Create Table'] . ";\n\n";

        $result = $conn->query('SELECT * FROM ' . $table);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $sql .= 'INSERT INTO ' . $table . ' (' . implode(', ', array_keys($row)) . ') VALUES (\'';
            $sql .= implode('\', \'', array_values($row)) . '\');' . "\n";
        }
    }

    // Save file
    file_put_contents($backupFilePath, $sql);

    // Set temporary message
    temp('info', 'Database Backup File Created Successfully.');
    redirect('confirmDownload.php?file=' . urlencode($backupFileName));
    
}

// Get all tables
$tables = $_db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Backup</title>
    <link rel="stylesheet" href="../css/backup.css">
    <script src="../js/backup.js"></script>
</head>
<body>
    <div class="container">
        <h1>Database Backup</h1>
        <form method="post" action="">
            <table>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Table Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tables as $table): ?>
                        <tr>
                            <td><input type="checkbox" name="tables[]" value="<?php echo htmlspecialchars($table); ?>"></td>
                            <td><?php echo htmlspecialchars($table); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="button" onclick="selectAll()">Select All</button>
                <button type="submit" class="button">Backup</button>
            </div>
        </form>
    </div>
    <div class="action-buttons">
        <a href="admin.php"><button>Back to Menu</button></a>
    </div>
</body>
</html>
