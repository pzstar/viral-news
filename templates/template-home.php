<?php
/**
 * Template Name: Home Page
 *
 * @package Viral News
 */
get_header();
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
get_footer();
