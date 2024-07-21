<?php
/**
 * The main template file.
 * @package Viral News
 */
get_header();
?>

<div class="vn-container vn-clearfix">

    <div id="primary" class="content-area">

        <?php if (have_posts()): ?>

            <?php if (is_home() && !is_front_page()): ?>
                <header class="vn-main-header">
                    <h1><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php while (have_posts()):
                the_post(); ?>

                <?php
                get_template_part('template-parts/content');
                ?>

            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else: ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>

    </div><!-- #primary -->

    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
