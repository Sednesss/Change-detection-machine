$(function () {
    var button = $('.input-data-form-button-section').find('button');
    var switchBtn = $('.input-data-form-switch-btn-section');

    if ($('.input-data-form-switch-btn-section').length && !switchBtn.hasClass('switch-on')) {
        button.prop('disabled', true);
        button.css('pointer-events', 'none');
    }

    switchBtn.click(function () {
        var isSwitchOn = $(this).toggleClass('switch-on').hasClass('switch-on');
        button.prop('disabled', !isSwitchOn);
        button.css('pointer-events', isSwitchOn ? '' : 'none');
    });
});