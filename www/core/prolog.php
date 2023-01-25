<?php
session_start();
$con = new PDO('mysql:dbname=cykkyb; host=mysql1', 'user', 'password');

function check_auth(){
    global $con;
    $sql = "SELECT * FROM `accounts` WHERE `session` = :user_session ";
    $query = $con->prepare($sql);
    $query->execute(['user_session' => $_COOKIE['PHPSESSID']]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}
$user = check_auth();




