<?php
global $con;
global $user;

$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];
$query = $con->prepare('SELECT * FROM `products` JOIN `basket` ON products.id = basket.product_id AND basket.user_id = :user_session ;');
$query->execute(['user_session' => $user_id]);
$products = $query->fetchAll(PDO::FETCH_ASSOC);

if($user){
    $query = $con->prepare('SELECT * FROM `accounts` WHERE `session` = :user_session ');
    $query->execute(['user_session' => $_COOKIE['PHPSESSID']]);
    $user_info = $query->fetch(PDO::FETCH_ASSOC);
}
?>
<?php if ($products) { ?>
<div class="order" id="order">
    <div class="order__container container1">
        <div class="order__label">Заказать товар</div>
        <form class="order__data">
            <div class="alert"></div>
            <input type="email" class="order__input" name="email" placeholder="email" value="<?= $user_info['email'] ?>">
            <input type="text" class="order__input" name="card-number" placeholder="8 952 451 39 36" value="<?= $user_info['phone'] ?>">
            <input type="text" class="order__input" name="address" placeholder="address" value="<?= $user_info['address'] ?>">

        </form>
        <div class="order__products">
            <?php if ($products) {
                $price = 0; ?>
                <?php foreach ($products as $item) {
                     $price += $item['price'] * $item['count']; ?>

                    <div class="modal-modal-product-card" data-id="<?= $item['product_id'] ?>">
                        <div class="modal-product-card__image">
                            <img src="/<?= $item['image'] ?>  " alt="">
                        </div>
                        <div class="modal-product-card__main">
                            <div class="modal-product-card__info">
                                <div class="modal-product-card__name"><?= $item['name'] ?></div>
                                <div class="modal-product-card__count"><?= $item['count'] ?> шт</div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>

        </div>
        <div class="order__info">
            <div class="order__price">Сумма: <span class="order__price"><?= $price ?></span> &#8381;</div>
            <button class="order__button">Оплатить</button>
        </div>
    </div>
</div>
 <?php } ?>