<?php
/**
 * Template Name: Blank Template(For Page Builders)
 *
 * @package Viral News
 */
get_header();
?>

<div class="vn-container">
    <div class="vn-content-wrap">
        <div class="vn-full-width-content-area">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('template-parts/content', 'page'); ?>

            <?php endwhile; // End of the loop.   ?>

        </div>
    </div>
</div>

<?php
get_footer();
