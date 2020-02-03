<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vl-container">
    <header class="vl-main-header">
        <?php
        the_archive_title('<h1>', '</h1>');
        the_archive_description('<div class="taxonomy-description">', '</div>');
        ?>
    </header><!-- .vl-main-header -->

    <div class="vl-content-wrap vl-clearfix">
        <div id="primary" class="content-area">

            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    get_template_part('template-parts/content');
                    ?>

                <?php endwhile; ?>

                <?php the_posts_pagination(); ?>

            <?php else : ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>