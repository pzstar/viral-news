<?php
/**
 * @package Viral News
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vn-article-content'); ?> <?php echo viral_news_get_schema_attribute('article'); ?>>

    <div class="entry-content">

        <?php
        $viral_news_display_featured_img = get_theme_mod('viral_news_display_featured_image');
        if ($viral_news_display_featured_img) {
            echo '<div class="single-featured-img">';
            the_post_thumbnail('large');
            echo '</div>';
        }

        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-news'),
            'after' => '</div>',
        ));
        ?>
    </div>

    <footer class="entry-footer">
        <?php viral_news_entry_footer(); ?>
    </footer>

</article>