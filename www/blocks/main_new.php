<?php
global $con;
global $user;

$sql = "SELECT * FROM `products` LIMIT 3";
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
<?php if ($product) { ?>
<div class="main-new">
    <div class="main-new__content">
        <div class="main-new__content-label">НОВЫЙ СЕЗОН</div>
        <div class="main-new__product">
            <?php foreach ($product as $item) { ?>
                <div class="main-new__item">
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
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="main-new__banner">
        <div class="main-new__banner-label">Новая коллекция</div>
        <a class="main-new__button" href="/catalog/index.php">Каталог</a>
    </div>
</div>
