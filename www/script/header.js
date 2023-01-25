

$('body').on('click', '.icon-menu', function (){
    $(this).toggleClass('icon-menu_active');
    $('.mobile-menu').toggleClass('mobile-menu_active');
});