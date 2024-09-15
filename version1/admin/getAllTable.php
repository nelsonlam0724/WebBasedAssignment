<?php
include '../_base.php';
auth('Root','Admin');

// Get all tables from the database
$tables = $_db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['tables' => $tables]);
?>
