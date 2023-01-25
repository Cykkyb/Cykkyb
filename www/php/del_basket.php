<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;
$product_id = $_POST['id'];
$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];
//Удаление товара
$sql = 'DELETE FROM `basket` WHERE product_id = :product_id AND user_id = :user_session';
$query = $con->prepare($sql);
$query->execute(['product_id' => $product_id, 'user_session' => $user_id]);
//Расчёт стоимости заказа
$sql = 'SELECT * FROM `products` JOIN `basket` ON products.id = basket.product_id AND basket.user_id = :user_session;';
$query = $con->prepare($sql);
$query->execute(['user_session' => $user_id]);
$result = $query->fetchAll();
//Расчёт стоимости заказа
$order_price = 0;
foreach ($result as $item) {
    $order_price += $item['price'] * $item['count'];
}
//----
//Расчёт количества товаров в корзине
$cart__count = [];
foreach ($result as $item) {
    $cart__count[] = $item['product_id'];
}
//----
$data = [];
$data['cart__count'] = count($cart__count);
$data['order_price'] = $order_price;
echo json_encode($data);

