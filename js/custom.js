jQuery(function ($) {

    $('.vl-toggle-menu').click(function () {
        $('.vl-main-navigation .vl-menu').slideToggle();
    });

    $('.vl-menu > ul').superfish({
        delay: 500,
        animation: {opacity: 'show', height: 'show'},
        speed: 'fast'
    });

    $('#secondary').theiaStickySidebar({
        additionalMarginTop: 20,
        additionalMarginBottom: 20
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('#vl-back-top').removeClass('vl-hide');
        } else {
            $('#vl-back-top').addClass('vl-hide');
        }
    });

    $('#vl-back-top').click(function () {
        $('html,body').animate({scrollTop: 0}, 800);
    });

});