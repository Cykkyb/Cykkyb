<?php
global $user;
global $con;
$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];
$query = $con->prepare('SELECT `id` FROM `basket` WHERE `user_id` = :user_session;');
$query->execute(['user_session' => $user_id]);
$cart_count = $query->fetchAll(PDO::FETCH_ASSOC);
if (empty($cart_count)) {
    $cart_count = [];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/b065351ae5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style/dist/style.min.css">


</head>
<body>
<wrapper class="wrapper">
    <header class="header">
        <div class="header__wrapper">
            <div class="header-top">
                <div class="header-top__container container1">
                    <div class="header-top__wrapper">
                        <div class="header-top__info">

                            <div class="header-top__info-item">8 (800) 555-35-35</div>
                            <div class="header-top__info-item"> 9:00 — 18:00</div>
                        </div>
                        <div class="login">
                            <?php if ($user) { ?>
                                <a class="login__input" href="/php/authentication_clear.php">Выход</a>
                                <a class="login__input" href="/personal/index.php"> <?= $user['login'] ?> </a>
                            <?php } else { ?>
                                <a class="login__input" href="/authentication/index.php"> Вход</a>
                                <a class="login__registration" href="/registration/index.php">Регистрация</a>
                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
            <div class="header-main">
                <div class="header-main__container container1">
                    <div class="header-main__wrapper">
                        <div class="mobile-search">
                            <i class="fa-solid fa-magnifying-glass mobile-icon__search"></i>
                        </div>
                        <div class="header-main__logo">
                            <a class="logo" href="/index.php">CYKKYB</a>
                        </div>
                        <div class="menu-list">
                            <a class="menu-list__item " href="/catalog/index.php">
                                Каталог
                            </a>
                            <a class="menu-list__item">
                                Понравилось
                            </a>
                            <a class="menu-list__item" href="/personal/index.php">
                                Личный кабинет
                            </a>

                        </div>
                        <div class="header-icon">
                            <a class="header-icon__item " href="../basket/index.php">
                                <div class="cart">
                                    <i class="fa-solid fa-cart-shopping cart__icon"></i>
                                    <span class="cart__count">
                                    <?= count($cart_count) ?>
                                </span>
                                </div>

                            </a>
                            <a class="header-icon__item">
                                <i class="fa-solid fa-magnifying-glass header-icon__search"></i>
                            </a>
                        </div>
                        <div class="mobile-menu">
                            <div class="mobile-menu__wrapper">
                                <div class="mobile-info">
                                    <div class="mobile-info__item">Номер телефона: 8 (800) 555-35-35</div>
                                    <div class="mobile-info__item">Время работы: 9:00 — 18:00</div>
                                </div>
                                <div class="header-icon header-icon_mobile">
                                    <a class="header-icon__item " href="../basket/index.php">
                                        <div class="cart">
                                            <i class="fa-solid fa-cart-shopping cart__icon"></i>
                                            <span class="cart__count"><?= count($cart_count) ?></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="menu-list menu-list_mobile">
                                    <a class="menu-list__item " href="/catalog/index.php">
                                        Каталог
                                    </a>
                                    <a class="menu-list__item">
                                        Понравилось
                                    </a>
                                    <a class="menu-list__item" href="../personal/index.php">
                                        Личный кабинет
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="icon-menu">
                            <span></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <main class="main">