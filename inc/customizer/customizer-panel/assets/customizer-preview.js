function viralNewsDynamicCss(control, style) {
    jQuery('style.' + control).remove();

    jQuery('head').append(
        '<style class="' + control + '">:root{' + style + '}</style>'
    );
}

jQuery(document).ready(function ($) {
    'use strict';
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

    wp.customize('viral_news_template_color', function (value) {
        value.bind(function (to) {
            var css = '--viral-news-template-color:' + to + ';';
            viralNewsDynamicCss('viral_news_template_color', css);
        });
    });

    wp.customize('viral_news_header_image', function (value) {
        value.bind(function (to) {
            var css = '--viral-news-header-image:url(' + to + ');';
            if (to) {
                css += '--viral-news-header-padding: 70px 0;';
            } else {
                css += '--viral-news-header-padding: 50px 0;';
            }
            viralNewsDynamicCss('viral_news_header_image', css);
        });
    });
});