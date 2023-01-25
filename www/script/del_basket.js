//Удалени из корзины
$('body').on('click', '.basket__del', function () {
    const button = $(this);
    const product_card =  button.parent().parent();
    const product_id = button.data('id');
    const cart_count = $('.cart__count');
    const order_price = $('.order-confirm__price');
    $.ajax(
        {
            url: '/php/del_basket.php',
            type: 'post',
            data: {
                id: product_id,
            },
            success: function (data) {
                cart_count.text(data['cart__count']);
                order_price.text(data['order_price'])
                product_card.remove();
            }, error: function () {
                alert("Ошибка");
            },
            dataType:'json',
        }
    );
});