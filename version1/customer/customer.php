<?php
include '../_base.php';
include '../include/header.php';
include '../_head.php';

auth('Role','Admin','Member');
// Fetch user profile information
$user = $_SESSION['user'];

$_title = 'Customer Dashboard - ' . htmlspecialchars($user->name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
</head>



<h1>hi</h1>
<h1>hi</h1>
<h1>hi</h1>
<h1>hi</h1>
<h1>hi</h1>

<?php
    include '../_foot.php';
?>
</html>