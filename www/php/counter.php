<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;
$product_id = $_POST['id'];
$count_value = $_POST['value'];

$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];
$sql = 'UPDATE `basket` SET `count` = :count_value WHERE `user_id` = :user_session AND  `product_id` = :product_id';
$query = $con->prepare($sql);
$query->execute(['count_value' => $count_value, 'user_session' => $user_id, 'product_id' => $product_id]);

$sql = 'SELECT * FROM `products` JOIN `basket` ON products.id = basket.product_id AND basket.user_id = :user_session;';
$query = $con->prepare($sql);
$query->execute(['user_session' => $user_id]);
$result = $query->fetchAll();
$order_price =  0;
foreach ($result as $item){
    $order_price +=  $item['price']*$item['count'];
}
echo $order_price;