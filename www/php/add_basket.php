<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;
$product_id = $_POST['id'];
$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];

$sql = 'INSERT INTO basket (product_id, user_id, count) VALUES (:product_id, :user_session, :count_value)';
$query = $con->prepare($sql);
$query->execute(['product_id' => $product_id, 'user_session' => $user_id, 'count_value' => 1]);

$query = $con->prepare('SELECT `id` FROM `basket` WHERE `user_id` = :user_session;');
$query->execute(['user_session' => $user_id]);
$cart_count = $query->fetchAll(PDO::FETCH_ASSOC);

echo count($cart_count);






