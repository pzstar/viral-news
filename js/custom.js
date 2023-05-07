jQuery(function ($) {

    $('.vn-toggle-menu').on('click', function () {
        $('.vn-main-navigation .vn-menu').slideToggle();
        viralMenuFocus($('#vn-site-navigation'));
        return false;
    });

    $('.vn-menu > ul').superfish({
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
            $('#vn-back-top').removeClass('vn-hide');
        } else {
            $('#vn-back-top').addClass('vn-hide');
        }
    });

    $('#vn-back-top').click(function () {
        $('html,body').animate({scrollTop: 0}, 800);
    });

    /*---------Popup Search---------*/
    $('.vn-header-search span').on('click', function () {
        $('.ht-search-wrapper').addClass('ht-search-triggered');
        setTimeout(function () {
            $('.ht-search-wrapper .search-field').focus();
        }, 300);
        viralSearchModalFocus($('.ht-search-wrapper'));
        return false;
    });

    $('.ht-search-close').on('click', function () {
        $('.ht-search-wrapper').removeClass('ht-search-triggered');
        $('.vn-header-search span').focus();
        return false;
    });

    if ($('.vn-carousel-block').length > 0) {
        $('.vn-carousel-block').each(function () {
            $ele = $(this).find('.vn-carousel-block-wrap');
            $slide = $(this).attr('data-count');
            $($ele).owlCarousel({
                rtl: JSON.parse(viral_news_localize.is_rtl),
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                navText: ['<i class="mdi-chevron-left"></i>', '<i class="mdi-chevron-right"></i>'],
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
                elem.find('.vn-menu').hide();
            }
        });
    };

    var viralSearchModalFocus = function (elem) {
        viralKeyboardLoop(elem);

        elem.on('keydown', function (e) {
            if (e.keyCode == 27 && elem.hasClass('ht-search-triggered')) {
                elem.removeClass('ht-search-triggered');
                $('.vn-header-search a').focus();
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

