<?php
/**
 * @package Viral News
 */

get_header(); ?>

<div class="vl-container vl-clearfix">
	<div id="primary" class="content-area">

		<header class="vl-main-header">
			<?php the_title( '<h1>', '</h1>' ); ?>
		</header><!-- .entry-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
