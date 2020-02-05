<?php

/**
 * @package Viral News
 */
function viral_news_dymanic_styles() {
    $color = get_theme_mod('viral_news_template_color', '#0078af');
    $header_typography = get_theme_mod('viral_news_header_typography', 'Playfair Display');
    $body_typography = get_theme_mod('viral_news_body_typography', 'Libre Baskerville');
    $color = sanitize_hex_color($color); //Sanitized here so that variable can be used inside quote
    $header_typography = wp_filter_post_kses($header_typography); //Sanitized here so that variable can be used inside quote
    $body_typography = wp_filter_post_kses($body_typography); //Sanitized here so that variable can be used inside quote
    $custom_css = "
body,
button,
input,
select,
textarea{
font-family: '{$body_typography}', sans-serif;
}

.vl-site-title,
.vl-main-navigation a,
h1,
h2,
h3,
h4,
h5,
h6{
font-family: '{$header_typography}', sans-serif;
}

button,
input[type='button'],
input[type='reset'],
input[type='submit'],
.entry-post-info .entry-date,
.entry-footer .vl-read-more,
.vl-timeline .vl-post-item:hover:after,
.comment-navigation .nav-previous a,
.comment-navigation .nav-next a,
#vl-site-navigation.vl-theme-color,
.vl-top-block .post-categories li a:hover,
.vl-block-title span:before,
.widget-area .widget-title span:before,
#vl-back-top{
	background:{$color};
}

a,
.comment-list a:hover,
.post-navigation a:hover,
.vl-post-item h3 a:hover,
.widget-area a:hover{
	color:{$color};
}

.comment-navigation .nav-next a:after{
border-left-color: {$color};
}

.comment-navigation .nav-previous a:after{
border-right-color: {$color};
}
";

    return wp_strip_all_tags(viral_news_css_strip_whitespace($custom_css));
}
