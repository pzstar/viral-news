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

        <?php while (have_posts()):
            the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; // End of the loop.   ?>

    </div>
</div>

<?php
get_footer();
