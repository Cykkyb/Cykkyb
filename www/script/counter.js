//Счётчик
$('body').on('click', '.counter__button', function () {
    const input = $(this).parent().find('.counter__input');
    const counter = $(this).parent();
    let input_value = input.text()
    const button = $(this);
    const product_id = counter.data('id');
    const order_price = $('.order-confirm__price');
    if (button.hasClass('decrement')) {
        if (input_value > 1) {
            --input_value;
            input.text(input_value);
            $.ajax(
                {
                    url: '/php/counter.php',
                    type: 'post',
                    data: {
                        id: product_id,
                        value: input_value,
                    },
                    success: function (data) {
                        order_price.text(data);
                    }, error: function () {
                        alert("Ошибка");
                    }
                }
            );
        }
    }
    if (button.hasClass('increment')) {
        ++input_value;
        input.text(input_value);
        $.ajax(
            {
                url: '/php/counter.php',
                type: 'post',
                data: {
                    id: product_id,
                    value: input_value,
                },
                success: function (data) {
                    order_price.text(data);
                }, error: function () {
                    alert("Ошибка");
                }
            }
        );
    }


})
