<?php
if (has_post_format(array('video'))) {
    $viral_news_main_content = apply_filters('the_content', get_the_content());
    $viral_news_media = get_media_embedded_in_content($viral_news_main_content, array(
        'video',
        'object',
        'embed',
        'iframe',
    ));

    if ($viral_news_media) {
        $viral_news_media = reset($viral_news_media);
        echo '<div class="entry-media">' . wp_kses_post($viral_news_media) . '</div>'; /* WPCS: xss ok. */
        return;
    }
}

if (has_post_format('gallery')) {
    $viral_news_gallery = get_post_gallery(get_the_id(), false);
    if (!empty($viral_news_gallery['ids'])) {
        $viral_news_gallery_id = explode(',', $viral_news_gallery['ids']);
        ?>

        <div class="grid-gallery <?php echo viral_news_is_amp() ? '' : 'is-hidden' ?>">
            <?php echo viral_news_is_amp() ? '<amp-carousel class="amp-slider" layout="responsive" type="slides" width="780" height="500" auto-advance-interval="3500">' : ''; ?>

            <?php
            foreach ($viral_news_gallery_id as $id):
                echo wp_get_attachment_image($id, 'viral-news-600x600');
            endforeach;
            ?>

            <?php echo viral_news_is_amp() ? '</amp-carousel>' : ''; ?>
        </div>
        <?php
    }
    return;
}

if (has_post_format('quote')) {
    $viral_news_content = get_the_content();
    if (preg_match('~<blockquote>([\s\S]+?)</blockquote>~', $viral_news_content, $viral_news_quote)) {
        echo '<div class="entry-media quote">' . wp_kses_post($viral_news_quote[0]) . '</div>';
        return;
    }
}

if (has_post_thumbnail()):
    ?>
    <div class="entry-media">
        <?php the_post_thumbnail('viral-news-600x600'); ?>
    </div>
    <?php
endif;

if (!has_post_thumbnail()) {
    return;
}
