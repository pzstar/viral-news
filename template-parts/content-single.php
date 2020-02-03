<?php
/**
 * @package Viral News
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vl-article-content'); ?>>
	<header class="entry-header">
		<?php viral_news_post_date(); ?>
	</header>
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'viral-news' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php viral_news_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

