<?php
/**
 * @package Viral News
 */
get_header();
?>

<div class="vl-container vl-clearfix">
    <div id="primary" class="content-area">

        <header class="vl-main-header">
            <h1><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'viral-news'); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try another links!', 'viral-news'); ?></p>
        </div><!-- .page-content -->

    </div><!-- #primary -->
</div>

<?php get_footer(); ?>
