$('body').on('submit', '.registration-form', function (e) {
    e.preventDefault();
    form = $(this);
    alert = $('.alert');
    $.ajax(
        {
            url: '/php/registration.php',
            type: 'post',
            data: form.serialize(),
            success: function (data) {
                if (data == 'login') {
                     window.location.href = '../../index.php';
                    $.ajax(
                        {
                            url: '/php/authentication.php',
                            type: 'post',
                            data: form.serialize(),
                            success: function (data) {
                                if (data == 'main') {
                                    window.location.href = '../../index.php';
                                } else {
                                    alert.html(data);
                                }
                            }, error: function () {
                                alert("Ошибка");
                            }
                        }
                    );
                } else {
                    alert.html(data);
                }
            }, error: function () {
                alert("Ошибка");
            }
        }
    );


});