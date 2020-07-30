/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.vn-site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.vn-site-description').text(to);
        });
    });
    // Header text color.
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.vn-site-title a, .vn-site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.vn-site-title a, .vn-site-description').css({
                    'clip': 'auto',
                    'color': to,
                    'position': 'relative'
                });
            }
        });
    });
})(jQuery);
