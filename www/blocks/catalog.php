<?php
global $con;
global $user;

$sql = "SELECT * FROM `products` ";
$query = $con->prepare($sql);
$query->execute();
$product = $query->fetchAll(PDO::FETCH_ASSOC);

$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];

$query = $con->prepare('SELECT  `product_id` FROM `basket` WHERE `user_id` = :user_session ');
$query->execute(['user_session' => $user_id]);
$basket = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($basket as $item) {
    $basket_id[] = $item['product_id'];
}

?>

<div class="catalog">
    <div class="catalog__wrapper">
        <div class="catalog__container container1">
            <div class="catalog__label">Каталог</div>
            <div class="catalog__list">
                <div class="catalog__list-items">
                    <?php if ($product) { ?>
                        <?php foreach ($product as $item) { ?>

                            <div class="product-card" data-id="<?= $item['id'] ?>">
                                <div class="product-card__image">
                                    <img src="/<?= $item['image'] ?>  " alt="">
                                </div>
                                <div class="product-card__main">
                                    <div class="product-card__info">
                                        <div class="product-card__name"><?= $item['name'] ?></div>
                                        <div class="product-card__price"><?= $item['price'] ?> руб.</div>
                                    </div>
                                    <button class="like-icon">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                    <?php if (!empty($basket_id)) {
                                        if (in_array($item['id'], array_map('trim', $basket_id))) { ?>
                                            <button class="basket-icon basket-icon_active">
                                                <i class="fa-solid fa-cart-shopping "></i>
                                            </button>
                                        <?php } else { ?>
                                            <button class="basket-icon ">
                                                <i class="fa-solid fa-cart-shopping "></i>
                                            </button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <button class="basket-icon ">
                                            <i class="fa-solid fa-cart-shopping "></i>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>

                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>

