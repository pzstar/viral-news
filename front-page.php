<?php
/**
 * Front Page
 *
 * @package Viral News
 */
get_header();

$viral_news_enable_frontpage = get_theme_mod('viral_news_enable_frontpage', false);

if ($viral_news_enable_frontpage) {
    ?>
    <div class="vn-container">
        <div id="vn-top-section">
            <?php get_template_part('home-parts/top-section'); ?>
        </div>

        <div id="vn-middle-section" class="vn-clearfix">
            <div id="primary">
                <?php get_template_part('home-parts/middle-left-section'); ?>
            </div>

            <div id="secondary" class="widget-area">
                <?php dynamic_sidebar('viral-news-frontpage-sidebar') ?>
            </div>
        </div>

        <div id="vn-carousel-section">
            <?php get_template_part('home-parts/carousel-section'); ?>
        </div>

        <div id="vn-bottom-section">
            <?php get_template_part('home-parts/bottom-section'); ?>
        </div>
    </div>
    <?php
} else {
    if ('posts' == get_option('show_on_front')) {
        include(get_home_template());
    } else {
        include(get_page_template());
    }
}

get_footer();
