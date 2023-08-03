<?php
/**
 * @package Viral News
 */
$viral_news_sidebar_layout = "right-sidebar";

if (is_singular(array('post', 'page'))) {
    $viral_news_sidebar_layout = get_post_meta($post->ID, 'viral_news_sidebar_layout', true);
    if (!$viral_news_sidebar_layout) {
        $viral_news_sidebar_layout = "right-sidebar";
    }
}

if ($viral_news_sidebar_layout == "no-sidebar" || $viral_news_sidebar_layout == "no-sidebar-condensed") {
    return;
}

if (is_active_sidebar('viral-news-sidebar') && $viral_news_sidebar_layout == "right-sidebar") {
    ?>
    <div id="secondary" class="widget-area" <?php echo viral_news_get_schema_attribute('sidebar'); ?>>
        <?php dynamic_sidebar('viral-news-sidebar'); ?>
    </div><!-- #secondary -->
    <?php
}

if (is_active_sidebar('viral-news-left-sidebar') && $viral_news_sidebar_layout == "left-sidebar") {
    ?>
    <div id="secondary" class="widget-area" <?php echo viral_news_get_schema_attribute('sidebar'); ?>>
        <?php dynamic_sidebar('viral-news-left-sidebar'); ?>
    </div><!-- #secondary -->
    <?php
}