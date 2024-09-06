<?php
include '../_base.php';

$user = req('user');

$countCartRecord = $_db->prepare('SELECT COUNT(*) AS total_records FROM carts WHERE user_id = ? ');
$countCartRecord->execute([$user]);
$result = $countCartRecord->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);
?>