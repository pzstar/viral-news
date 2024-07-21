<?php
/**
 * @package Viral News
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vn-article-content'); ?> <?php echo viral_news_get_schema_attribute('article'); ?>>

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-news'),
            'after' => '</div>',
        ));
        ?>
    </div>

</article>