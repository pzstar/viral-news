<?php
/**
 * @package Viral News
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vn-article-content'); ?>>

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
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

