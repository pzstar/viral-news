<?php
/**
 * @package Viral News
 */
if (!is_active_sidebar('viral-news-sidebar')) {
    return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar('viral-news-sidebar'); ?>
</div><!-- #secondary -->
