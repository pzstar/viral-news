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

			<?php get_template_part( 'template-parts/content', 'single' ); ?>


			<nav class="navigation post-navigation" role="navigation">
				<div class="nav-links">
					<div class="nav-previous">
					<?php previous_post_link('%link', '<span><i class="fa fa-angle-left" aria-hidden="true"></i>Prev</span>%title'); ?> 
					</div>

					<div class="nav-next">
					<?php next_post_link('%link', '<span>Next<i class="fa fa-angle-right" aria-hidden="true"></i></span>%title'); ?>
					</div>
				</div>
			</nav>

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
