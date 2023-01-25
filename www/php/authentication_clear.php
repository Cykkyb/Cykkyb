<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;

$sql = 'UPDATE `accounts` SET `session` = 0 WHERE `session` = :user_session ';
$query = $con->prepare($sql);
$query->execute(['user_session' => $_COOKIE['PHPSESSID']] );
$_SESSION['basket_product_id'] = null;
header('Location: /index.php');