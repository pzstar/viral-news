<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vn-container">
    <?php
    while (have_posts()):
        the_post();

        $viral_news_hide_title = get_post_meta($post->ID, 'viral_news_hide_title', true);

        if (!$viral_news_hide_title) {
            ?>
            <header class="vn-main-header">
                <?php the_title('<h1>', '</h1>'); ?>
            </header><!-- .entry-header -->
        <?php } ?>

        <div class="vn-content-wrap vn-clearfix">
            <div id="primary" class="content-area">

                <?php get_template_part('template-parts/content', 'page'); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()):
                    comments_template();
                endif;
                ?>

            </div><!-- #primary -->

            <?php get_sidebar(); ?>
        </div>
    <?php endwhile; // End of the loop.   ?>
</div>

<?php
get_footer();
