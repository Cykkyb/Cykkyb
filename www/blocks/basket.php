<?php
global $con;
global $user;
$user_id = $user['id'] ?? $_COOKIE['PHPSESSID'];

$query = $con->prepare('SELECT * FROM `products` JOIN `basket` ON products.id = basket.product_id AND basket.user_id = :user_session ;');
$query->execute(['user_session' => $user_id]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="basket">
    <div class="basket__container container1">
        <?php if (!empty($result)) {
            $price = 0; ?>
            <?php foreach ($result as $item) {
                $price += $item['price'] * $item['count']; ?>

                <div class="basket__item " data-id="<?= $item['product_id'] ?>">
                    <div class="basket__image">
                        <img src="/<?= $item['image'] ?>" alt="">
                    </div>
                    <div class="basket__info">
                        <div class="basket__name"><?= $item['name'] ?> </div>
                        <div class="basket__price"><?= $item['price'] ?> &#8381;</div>
                    </div>
                    <div class="counter" data-id="<?= $item['product_id'] ?>">
                        <button class="counter__button decrement">-</button>
                        <div class="counter__input"><?= $item['count'] ?></div>
                        <button class="counter__button increment">+</button>
                    </div>
                    <div class="basket__icon">
                        <button class="basket__del" data-id="<?= $item['product_id'] ?>">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                        <button class="like-icon">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </div>
                </div>
                <?php
            } ?>
            <div class="order-confirm basket__order">
                <div class="order-confirm__container container1">
                    <div class="order-confirm__info">Сумма заказа: <span
                                class="order-confirm__price"><?= $price ?></span> &#8381;
                    </div>
                    <a href="/order/index.php" class="order-confirm__button">Заказать</a>
                </div>
            </div>

            <div class="order-modal" id="order-modal" style="display:none;">
                <form class="order-modal__data">
                    <input type="email" class="order-modal__input" placeholder="email">
                    <input type="text" class="order-modal__input" placeholder="card-number">
                    <input type="text" class="order-modal__input" placeholder="address">
                </form>
                <div class="order-modal__products">
                    <?php if ($result) { ?>
                        <?php foreach ($result as $item) { ?>

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
                <div class="order-modal__info">
                    <div class="order-modal__price">Сумма: <span class="order__price"><?= $price ?></span> &#8381;</div>
                    <button class="order__button-submit">Оплатить</button>
                </div>
            </div>
        <?php } else { ?>
            <div class="basket__empty">
                <div class="basket__empty-label">А тут пусто!</div>
                <img class="basket__empty-icon" src="../icon/basket/empty.png" alt="">
            </div>
        <?php } ?>
    </div>
</div>
