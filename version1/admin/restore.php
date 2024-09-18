<?php
include '../_base.php';
auth('Root', 'Admin');

if (is_post()) {
    if (isset($_FILES['backupFile']) && $_FILES['backupFile']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['backupFile']['tmp_name'];
        $fileName = $_FILES['backupFile']['name'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        if ($fileExtension == 'sql') {
            $sql = file_get_contents($fileTmpPath);
            $conn = $_db;

            try {
                // Begin the transaction
                if (!$conn->inTransaction()) {
                    $conn->beginTransaction();
                }
                $conn->exec('SET FOREIGN_KEY_CHECKS = 0');

                $queries = explode(';', $sql);
                $actionTaken = false;

                foreach ($queries as $query) {
                    $query = trim($query);
                    if ($query) {
                        if (stripos($query, 'CREATE TABLE') === 0) {
                            // Check if the table exists
                            $tableName = getTableNameFromQuery($query);
                            if ($tableName) {
                                $result = $conn->query("SHOW TABLES LIKE '$tableName'");
                                if ($result->rowCount() == 0) {
                                    // Create table if it doesn't exist
                                    $conn->exec($query);
                                    $actionTaken = true;
                                }
                            }
                        } elseif (stripos($query, 'INSERT INTO') === 0) {
                            // Modify INSERT INTO queries to avoid duplicates
                            $tableName = getTableNameFromInsertQuery($query);
                            $values = extractValuesFromInsertQuery($query);

                            if ($tableName && $values) {
                                // Get primary key column(s)
                                $primaryKey = getPrimaryKeyColumn($conn, $tableName);

                                if ($primaryKey) {
                                    // Assuming the primary key is the first value in the VALUES list
                                    $primaryKeyValue = trim($values[0], " '");
                                    $checkQuery = "SELECT COUNT(*) FROM $tableName WHERE $primaryKey = :primaryKeyValue";
                                    $stmt = $conn->prepare($checkQuery);
                                    $stmt->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $exists = $stmt->fetchColumn();

                                    if ($exists == 0) {
                                        // Insert the record if it doesn't exist
                                        $conn->exec($query);
                                        $actionTaken = true;
                                    }
                                }
                            }
                        } else {
                            // Execute other queries (e.g., ALTER, DROP, etc.)
                            $conn->exec($query);
                            $actionTaken = true;
                        }
                    }
                }

                // Commit the transaction if successful
                if ($conn->inTransaction()) {
                    $conn->commit();
                }
                $conn->exec('SET FOREIGN_KEY_CHECKS = 1');

                if ($actionTaken) {
                    temp('info', 'Database restored successfully.');
                } else {
                    temp('info', 'No action needed: All tables are already up to date.');
                }
            } catch (PDOException $e) {
                // Rollback if error occurs
                if ($conn->inTransaction()) {
                    $conn->rollBack();
                }
                temp('info', 'Error: ' . htmlspecialchars($e->getMessage()));
            }
        } else {
            temp('info', 'Error: Please upload a valid SQL file.');
        }
    } else {
        temp('info', 'Error: No file uploaded or upload error.');
    }

    // Redirect after setting the message
    redirect('admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Database</title>
    <link rel="stylesheet" href="../css/restore.css">
</head>
<body>
    <h1>Restore Database</h1>
    <div class="container">
        <form action="restore.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="backupFile">Select SQL file to restore:</label>
                <input type="file" name="backupFile" id="backupFile" accept=".sql" required>
            </div>
            <button type="submit" class="button">Restore</button>
        </form>
    </div>
    <div class="action-buttons">
        <a href="admin.php"><button>Back to Menu</button></a>
    </div>
</body>
</html>
