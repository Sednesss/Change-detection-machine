$(function () {
    var button = $('.input-data-form-button-section').find('button');
    var switchBtn = $('.input-data-form-switch-btn-section');

    button.css('pointer-events', 'none');

    switchBtn.click(function () {
        var isSwitchOn = $(this).toggleClass('switch-on').hasClass('switch-on');
        console.log(isSwitchOn);
        button.prop('disabled', !isSwitchOn);
        button.css('pointer-events', isSwitchOn ? '' : 'none');
    });
});