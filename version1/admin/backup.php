<?php
include '../_base.php';
auth('Root', 'Admin');

// Define how many results per page
$resultsPerPage = 5;

// Get current page number or default to page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $resultsPerPage;

// Get sorting preferences (asc or desc)
$sortOrder = isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'DESC' : 'ASC';

// Get search filter
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Get all tables from the database
$tables = $_db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

// Apply filter (if any)
if (!empty($filter)) {
    $tables = array_filter($tables, function ($table) use ($filter) {
        return stripos($table, $filter) !== false;
    });
}

// Apply sorting (ASC or DESC)
$sortOrder == 'DESC' ? rsort($tables) : sort($tables);

// Calculate total number of tables after filtering
$totalTables = count($tables);

// Apply pagination: get the slice of tables for the current page
$tables = array_slice($tables, $offset, $resultsPerPage);

// Handle form submission for backup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tables'])) {
    $selectedTables = $_POST['tables'];
    
    if (empty($selectedTables)) {
        temp('error', 'Please select at least one table to backup.');
        redirect('backup.php'); // Redirect back to the backup page
    }

    // Retrieve selected tables from cookies if they exist
    if (isset($_COOKIE['selectedTables'])) {
        $cookieSelectedTables = json_decode($_COOKIE['selectedTables'], true);
        $selectedTables = array_unique(array_merge($selectedTables, $cookieSelectedTables));
    }

    $timestamp = date('Y-m-d_H-i-s');
    $backupFileName = 'backup_' . $timestamp . '.sql';
    $backupFilePath = '../backup/' . $backupFileName;

    $conn = $_db;

    // Get the database name
    $databaseName = $conn->query('SELECT DATABASE()')->fetchColumn();

    // Start the SQL backup file with CREATE DATABASE and USE statements
    $sql = "-- Database Backup\n";
    $sql .= "CREATE DATABASE IF NOT EXISTS `$databaseName`;\n";
    $sql .= "USE `$databaseName`;\n\n";

    // Loop through selected tables to add CREATE TABLE and INSERT statements
    foreach ($selectedTables as $table) {
        $result = $conn->query('SHOW CREATE TABLE ' . $table);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        // Get the CREATE TABLE SQL
        $createTableSQL = $row['Create Table'];
        $sql .= "\n" . $createTableSQL . ";\n\n";

        // Fetch the data for INSERT statements
        $result = $conn->query('SELECT * FROM ' . $table);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $sql .= 'INSERT INTO ' . $table . ' (' . implode(', ', array_keys($row)) . ') VALUES (\'' . 
                implode('\', \'', array_map('addslashes', array_values($row))) . '\');' . "\n";
        }
    }

    // Save SQL to file
    file_put_contents($backupFilePath, $sql);
    temp('info', 'Database Backup File Created Successfully.');
    redirect('confirmDownload.php?file=' . urlencode($backupFileName));
}

// Handle form submission for selecting tables (preserve selection across pages)
if (isset($_POST['select_all'])) {
    // Only select currently visible tables
    $selectedTables = isset($_POST['tables']) ? $_POST['tables'] : [];
    setcookie('selectedTables', json_encode($selectedTables), time() + 3600, '/');
}
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
        <form method="get" action="">
            <h1>Database Backup</h1>
            <input type="text" name="filter" placeholder="Filter by table name" value="<?php echo htmlspecialchars($filter); ?>">
            <button type="submit">Filter</button>
            <button type="submit" name="sort" value="<?php echo $sortOrder == 'ASC' ? 'desc' : 'asc'; ?>">
                Sort by Table Name (<?php echo $sortOrder == 'ASC' ? 'Ascending' : 'Descending'; ?>)
            </button>
        </form>
        <form method="post" action="">
            <input type="hidden" name="allTables" value='<?php echo json_encode($tables); ?>'>
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
            <br>
            <div class="pagination">
                <?php
                $totalPages = ceil($totalTables / $resultsPerPage);

                // Previous button
                if ($page > 1) {
                    $prevPage = $page - 1;
                    echo "<a href=\"?page=$prevPage&sort=$sortOrder&filter=" . urlencode($filter) . "\" class=\"button\">Previous</a> ";
                }

                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<a href=\"?page=$i&sort=$sortOrder&filter=" . urlencode($filter) . "\"";
                    if ($i == $page) echo ' class="active"';
                    echo ">$i</a> ";
                }

                // Next button
                if ($page < $totalPages) {
                    $nextPage = $page + 1;
                    echo "<a href=\"?page=$nextPage&sort=$sortOrder&filter=" . urlencode($filter) . "\" class=\"button\">Next</a> ";
                }
                ?>
            </div>

            <div class="form-group">
                <button type="button" class="select-all-button button">Select All</button>
                <button type="submit" class="button">Backup</button>
            </div>
        </form>
    </div>

    <div class="action-buttons">
        <a href="admin.php" onclick="clearSelectedTablesCookie()"><button>Back to Menu</button></a>
    </div>
</body>
</html>
