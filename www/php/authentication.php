<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;

if ($user) {
    header('Location: /index.php');
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];
$sql = 'SELECT * FROM `accounts` WHERE `email` = :email ';
$query = $con->prepare($sql);
$query->execute(['email' => $email]);
$result = $query->fetch(PDO::FETCH_ASSOC);

if (!$result['email']) {
    echo 'Неверный Email';
    die();
}
if (!password_verify($password, $result['password'])) {
    echo 'Неверный пароль';
    die();
}
$sql = 'UPDATE `accounts` SET `session` = :user_session WHERE `email` = :email ';
$query = $con->prepare($sql);
$query->execute(['user_session' => $_COOKIE['PHPSESSID'] , 'email' =>$result["email"]] );

echo 'main';


