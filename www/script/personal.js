$('body').on('click', '.personal__button-change', function () {
    const personal_item = $(this).parent();
    const form = personal_item.find('.personal__change');
    const content = personal_item.find('.personal__info-content');
    const button_submit = personal_item.find('.personal__button-submit');
    const button_icon = $(this).find('.personal__button-icon');

    form.toggleClass('personal__change_active');
    button_icon.toggleClass('personal__button-icon_hidden');
    button_submit.toggleClass('personal__button-submit_active');


});

