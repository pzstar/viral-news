<?php
/**
 * @package Viral News
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'viral-news' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'viral-news' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'viral-news' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'callback'=> 'viral_news_comment'
				) );
			?>
		</ul><!-- .comment-list -->

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'viral-news' ); ?></p>
	<?php endif; ?>

	<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
			'author' =>
			    '<div class="author-email-url hs-clearfix"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			    '" size="30"' . $aria_req . ' placeholder="'. esc_attr__( 'Name', 'viral-news' ).( $req ? '*' : '' ) .'" /></p>',

			'email' =>
			    '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			    '" size="30"' . $aria_req . ' placeholder="'. esc_attr__( 'Email', 'viral-news' ).( $req ? '*' : '' ) .'" /></p>',

			'url' =>
			    '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			    '" size="30" placeholder="'. esc_attr__( 'Website', 'viral-news' ). '" /></p></div>',
			);


	$args = array(
	  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	  'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'. esc_attr__( 'Comment', 'viral-news' ) .'">' .
	    '</textarea></p>',
	);
	?>

	<?php comment_form($args); ?>

</div><!-- #comments -->