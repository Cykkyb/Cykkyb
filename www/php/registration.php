<?php
require $_SERVER['DOCUMENT_ROOT'] . '/core/prolog.php';
global $con;
global $user;
if ($user){
    header('Location: /index.php');
    die();
}

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$session = $_COOKIE['PHPSESSID'];
$reg_exp = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i';
if(!$password){
    echo 'Введите пароль';
    die();
}
if(!preg_match($reg_exp, $email)){
    echo 'Не похоже на электронную почту';
    die();
}


$sql = "SELECT * FROM `accounts` WHERE `email` = :email";
$query = $con->prepare($sql);
$query->execute(['email' => $email]);
$result = $query->fetch(PDO::FETCH_ASSOC);
if ($result['email']) {
    echo 'Email уже используется';
    die();
}

$query = $con->prepare('INSERT INTO accounts (login, email, session ,password ) VALUES  (:login, :email, :user_session ,:password)');
$query->execute(['login' => $login, 'email' => $email, 'user_session' => $session, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

echo 'login';
