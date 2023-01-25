$('body').on('click', '.order__button', function () {
    $.ajax(
        {
            url: '/php/order.php',
            type: 'post',
            data: {
                id: '1',
            },
            success: function (data) {

            }, error: function () {
                console.log("Ошибка");
            },
            dataType: 'json',
        }
    );


});



