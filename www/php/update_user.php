<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;

if (!$user) {
    header('Location: /index.php');
    die();
}
$user_id = $user['id'];
$login = $_POST['login'];
$number = $_POST['number'];
$address = $_POST['address'];
$reg_exp = "/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/";

if ($login) {
    $sql = 'UPDATE accounts SET `login` = :login WHERE `id` =:user_id';
    $query = $con->prepare($sql);
    $query->execute(['login' => $login, 'user_id' => $user_id]);
}
if (preg_match($reg_exp, $number)) {
    $sql = 'UPDATE accounts SET `phone` = :phone WHERE `id` = :user_id';
    $query = $con->prepare($sql);
    $query->execute(['phone' => $number, 'user_id' => $user_id]);
}
if ($address) {
    $sql = 'UPDATE accounts SET `address` = :address WHERE `id` =:user_id';
    $query = $con->prepare($sql);
    $query->execute(['address' => $address, 'user_id' => $user_id]);
}

header('Location: /personal/index.php');
die();

