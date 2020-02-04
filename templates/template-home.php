<?php
/**
 * Template Name: Home Page
 *
 * @package Viral News
 */
get_header();
?>
<div class="vl-container">
    <div id="vl-top-section">
        <?php get_template_part('home-parts/top-section'); ?>
    </div>

    <div id="vl-middle-section" class="vl-clearfix">
        <div id="primary">
            <?php get_template_part('home-parts/middle-left-section'); ?>
        </div>

        <div id="secondary" class="widget-area">
            <?php dynamic_sidebar('viral-news-frontpage-sidebar') ?>
        </div>
    </div>

    <div id="vl-bottom-section">
        <?php get_template_part('home-parts/bottom-section'); ?>
    </div>
</div>

<?php
get_footer();
