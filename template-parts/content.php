<?php
/**
 * @package Viral News
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vn-archive-post'); ?> <?php echo viral_news_get_schema_attribute('article'); ?>>
    <div class="vn-post-wrapper">
        <?php if (has_post_thumbnail()): ?>
            <figure class="entry-figure">
                <?php
                $viral_news_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-news-840x440');
                ?>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($viral_news_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>"></a>
            </figure>
        <?php endif; ?>

        <div class="entry-body vn-clearfix">
            <div class="entry-post-info">
                <?php
                if ('post' == get_post_type()) {
                    viral_news_posted_on();
                }
                ?>
            </div>

            <div class="entry-post-content">
                <div class="entry-categories">
                    <?php echo viral_news_entry_category(); ?>
                </div>

                <header class="entry-header">
                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                </header>

                <div class="entry-content">
                    <?php
                    echo viral_news_excerpt(get_the_content(), 800);
                    ?>
                </div>

                <div class="entry-footer vn-clearfix">
                    <a class="vn-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'viral-news'); ?></a>
                </div>
            </div>
        </div>
    </div>
</article>