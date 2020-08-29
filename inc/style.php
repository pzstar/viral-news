<?php

/**
 * @package Viral News
 */
function viral_news_dymanic_styles() {
    $color = get_theme_mod('viral_news_template_color', '#0078af');
    $content_color = get_theme_mod('viral_news_content_color', '#404040');
    $header_typography = get_theme_mod('viral_news_header_typography', 'Playfair Display');
    $body_typography = get_theme_mod('viral_news_body_typography', 'Libre Baskerville');
    $header_image = get_theme_mod('viral_news_header_image');
    $header_image = esc_url($header_image);
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

body,
button,
input,
select,
textarea,
.entry-footer .cat-links a, 
.entry-footer .tags-links a, 
.entry-footer .edit-link a,
.widget-area a,
.entry-header .entry-title a,
.entry-categories,
.entry-categories a{
    color: {$content_color}
}

.entry-post-info .entry-author{
    border-color: {$content_color}
}

.vn-site-title,
.vn-main-navigation a,
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
.entry-footer .vn-read-more,
.vn-timeline .vn-post-item:hover:after,
.comment-navigation .nav-previous a,
.comment-navigation .nav-next a,
#vn-site-navigation.vn-theme-color,
.vn-top-header.vn-theme-color,
.vn-top-block .post-categories li a:hover,
body .he-post-thumb .post-categories li a:hover,
body .he-post-content .post-categories li a:hover,
.vn-block-title span:before,
body .he-title-style2.he-block-title span:before,
.widget-area .widget-title span:before,
#vn-back-top,
.vn-carousel-block .owl-carousel .owl-nav button.owl-prev, 
.vn-carousel-block .owl-carousel .owl-nav button.owl-next,
body .he-carousel-block .owl-carousel .owl-nav button.owl-prev, 
body .he-carousel-block .owl-carousel .owl-nav button.owl-next,
body .he-ticker-title,
body .he-ticker .owl-carousel .owl-nav button[class^='owl-']{
	background:{$color};
}

a,
.comment-list a:hover,
.post-navigation a:hover,
.vn-post-item h3 a:hover,
.widget-area a:hover,
body .he-ticker .owl-item a:hover{
	color:{$color};
}

body .he-title-style3.he-block-title,
.comment-navigation .nav-next a:after{
border-left-color: {$color};
}

.comment-navigation .nav-previous a:after{
border-right-color: {$color};
}

body .he-ticker-title:after{
    border-color: transparent transparent transparent {$color};
}
";

    if ($header_image) {
        $custom_css .= ".vn-header{padding: 70px 0;background-image: url('{$header_image}')}";
    }

    return wp_strip_all_tags(viral_news_css_strip_whitespace($custom_css));
}
