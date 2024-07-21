<?php
/**
 * @package Viral News
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment!  ?>

    <?php if (have_comments()): ?>
        <h3 class="comments-title">
            <?php
            printf(// WPCS: XSS OK.
                esc_html(_nx('%d Comment', '%d Comments', get_comments_number(), 'comments title', 'viral-news')), number_format_i18n(get_comments_number())
            );
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'callback' => 'viral_news_comment'
            ));
            ?>
        </ul><!-- .comment-list -->

        <?php the_comments_navigation(); ?>

    <?php endif; // Check for have_comments().  ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open()):
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'viral-news'); ?></p>
        <?php
    endif;

    comment_form();
    ?>

</div><!-- #comments -->