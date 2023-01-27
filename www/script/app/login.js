$('body').on('submit', '.login-form', function (e) {
    e.preventDefault();
    form = $(this);
    alert = $('.alert');
    $.ajax(
        {
            url: '/php/authentication.php',
            type: 'post',
            data: form.serialize(),
            success: function (data) {
                if(data == 'main'){
                    window.location.href ='../../index.php';
                }else {
                    alert.html(data);
                }
            }, error: function () {
                alert("Ошибка");
            }
        }
    );


});