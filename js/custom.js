jQuery(function ($) {

    $('.vl-toggle-menu').on('click', function () {
        $('.vl-main-navigation .vl-menu').slideToggle();
        viralMenuFocus($('#vl-site-navigation'));
        return false;
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

    /*---------Popup Search---------*/
    $('.vl-header-search a').on('click', function () {
        $('.ht-search-wrapper').addClass('ht-search-triggered');
        setTimeout(function () {
            $('.ht-search-wrapper .search-field').focus();
        }, 300);
        viralSearchModalFocus($('.ht-search-wrapper'));
        return false;
    });

    $('.ht-search-close').on('click', function () {
        $('.ht-search-wrapper').removeClass('ht-search-triggered');
        $('.vl-header-search a').focus();
        return false;
    });

    if ($('.vl-carousel-block').length > 0) {
        $('.vl-carousel-block').each(function () {
            $ele = $(this).find('.vl-carousel-block-wrap');
            $slide = $(this).attr('data-count');
            $($ele).owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    580: {
                        items: 2
                    },
                    860: {
                        items: parseInt($slide)
                    }
                }
            })
        });
    }

    var viralMenuFocus = function (elem) {
        viralKeyboardLoop(elem);

        elem.on('keyup', function (e) {
            if (e.keyCode === 27) {
                elem.find('.vl-menu').hide();
            }
        });
    };

    var viralSearchModalFocus = function (elem) {
        viralKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && elem.hasClass('ht-search-triggered')) {
                elem.removeClass('ht-search-triggered');
                $('.vl-header-search a').focus();
            }
        });
    };

    var viralKeyboardLoop = function (elem) {
        var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');

        var firstTabbable = tabbable.first();
        var lastTabbable = tabbable.last();
        /*set focus on first input*/
        firstTabbable.focus();

        /*redirect last tab to first input*/
        lastTabbable.on('keydown', function (e) {
            if ((e.which === 9 && !e.shiftKey)) {
                e.preventDefault();
                firstTabbable.focus();
            }
        });

        /*redirect first shift+tab to last input*/
        firstTabbable.on('keydown', function (e) {
            if ((e.which === 9 && e.shiftKey)) {
                e.preventDefault();
                lastTabbable.focus();
            }
        });
    }

});

