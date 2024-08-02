<?php
require '../_base.php';
include 'db.php';
if (is_post()) {
$user = req('user');
$information = $_db->prepare('SELECT * FROM favorite WHERE user_id = ?');
$information->execute([$user]);
$informations = $information->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($informations);
}
$_db = null;

?>
