<?php

/**
 * @package Viral News
 */
function viral_news_dymanic_styles() {
    $color = get_theme_mod('viral_news_template_color', '#0078af');
    $header_image = get_theme_mod('viral_news_header_image');

    $custom_css = ":root {";
    $custom_css .= "--viral-news-template-color: {$color};";
    $custom_css .= "--viral-news-header-image: url({$header_image});";
    if ($header_image) {
        $custom_css .= "--viral-news-header-padding: 70px 0;";
    } else {
        $custom_css .= "--viral-news-header-padding: 50px 0;";
    }
    $custom_css .= viral_news_typography_vars(array('viral_news_body', 'viral_news_header', 'viral_news_menu'));
    $custom_css .= "}";

    return wp_strip_all_tags(viral_news_css_strip_whitespace($custom_css));
}
