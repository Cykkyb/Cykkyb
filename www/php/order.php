<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;

$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];
$sql = 'SELECT * FROM `products` JOIN `basket` ON products.id = basket.product_id AND basket.user_id = :user_session;';
$query = $con->prepare($sql);
$query->execute(['user_session' => $user_id]);
$result = $query->fetchAll();