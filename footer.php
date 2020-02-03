<?php
/**
 * @package Viral News
 */
?>

</div><!-- #content -->

<footer id="vl-colophon" class="site-footer">
    <?php if (is_active_sidebar('viral-news-footer1') || is_active_sidebar('viral-news-footer2') || is_active_sidebar('viral-news-footer3') || is_active_sidebar('viral-news-footer4')) { ?>
        <div class="vl-top-footer">
            <div class="vl-container">
                <div class="vl-top-footer-inner vl-clearfix">
                    <div class="vl-footer-1 vl-footer-block">
                        <?php dynamic_sidebar('viral-news-footer1') ?>
                    </div>

                    <div class="vl-footer-2 vl-footer-block">
                        <?php dynamic_sidebar('viral-news-footer2') ?>
                    </div>

                    <div class="vl-footer-3 vl-footer-block">
                        <?php dynamic_sidebar('viral-news-footer3') ?>
                    </div>

                    <div class="vl-footer-4 vl-footer-block">
                        <?php dynamic_sidebar('viral-news-footer4') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="vl-bottom-footer">
        <div class="vl-container">
            <div class="vl-site-info">
                WordPress Theme
                <span class="sep"> | </span>
                <?php echo sprintf(__('<a title="Download Viral News" href="%s" target="_blank">Viral News</a> by Hash Themes', 'viral-news'), 'https://hashthemes.com/wordpress-theme/viral/'); ?>
            </div><!-- .site-info -->
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<div id="vl-back-top" class="vl-hide"><i class="fa fa-angle-up" aria-hidden="true"></i></div>

<?php wp_footer(); ?>

</body>
</html>