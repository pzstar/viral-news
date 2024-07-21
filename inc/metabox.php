<?php

/**
 *
 * @package Viral News
 */

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function viral_news_sidebar_layout_meta_box() {

    $screens = array('post', 'page');

    add_meta_box(
        'viral_news_sidebar_layout', esc_html__('Sidebar Layout', 'viral-news'), 'viral_news_sidebar_layout_meta_box_callback', $screens, 'side', 'high'
    );
}

add_action('add_meta_boxes', 'viral_news_sidebar_layout_meta_box');

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function viral_news_sidebar_layout_meta_box_callback($post) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field('viral_news_sidebar_layout_save_meta_box', 'viral_news_sidebar_layout_meta_box_nonce');

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $viral_news_sidebar_layout = get_post_meta($post->ID, 'viral_news_sidebar_layout', true);
    $viral_news_hide_title = get_post_meta($post->ID, 'viral_news_hide_title', true);

    if (!$viral_news_sidebar_layout) {
        $viral_news_sidebar_layout = 'right-sidebar';
    }

    echo '<div class="viral-sidebar-layouts">';
    echo '<label>';
    echo '<input type="radio" name="viral_news_sidebar_layout" value="right-sidebar" ' . checked($viral_news_sidebar_layout, 'right-sidebar', false) . ' />';
    echo '<img src="' . esc_url(get_template_directory_uri() . '/inc/css/images/right-sidebar.jpg') . '"/>';
    echo '</label>';

    echo '<label>';
    echo '<input type="radio" name="viral_news_sidebar_layout" value="left-sidebar" ' . checked($viral_news_sidebar_layout, 'left-sidebar', false) . ' />';
    echo '<img src="' . esc_url(get_template_directory_uri() . '/inc/css/images/left-sidebar.jpg') . '"/>';
    echo '</label>';

    echo '<label>';
    echo '<input type="radio" name="viral_news_sidebar_layout" value="no-sidebar" ' . checked($viral_news_sidebar_layout, 'no-sidebar', false) . ' />';
    echo '<img src="' . esc_url(get_template_directory_uri() . '/inc/css/images/no-sidebar.jpg') . '"/>';
    echo '</label>';

    echo '<label>';
    echo '<input type="radio" name="viral_news_sidebar_layout" value="no-sidebar-condensed" ' . checked($viral_news_sidebar_layout, 'no-sidebar-condensed', false) . ' />';
    echo '<img src="' . esc_url(get_template_directory_uri() . '/inc/css/images/no-sidebar-condensed.jpg') . '"/>';
    echo '</label>';
    echo '</div>';

    echo '<p>';
    echo '<input type="checkbox" id="viral_news_hide_title" name="viral_news_hide_title" value="1" ' . checked($viral_news_hide_title, 1, false) . ' />';
    echo '<label for="viral_news_hide_title">';
    echo esc_html__('Hide Title', 'viral-news');
    echo '</label>';
    echo '</p>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function viral_news_sidebar_layout_save_meta_box($post_id) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if (!isset($_POST['viral_news_sidebar_layout_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce(sanitize_key($_POST['viral_news_sidebar_layout_meta_box_nonce']), 'viral_news_sidebar_layout_save_meta_box')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if (isset($_POST['viral_news_sidebar_layout'])) {
        // Sanitize user input.
        $viral_news_data = sanitize_text_field(wp_unslash($_POST['viral_news_sidebar_layout']));
        // Update the meta field in the database.
        update_post_meta($post_id, 'viral_news_sidebar_layout', $viral_news_data);
    }

    $viral_news_data = isset($_POST['viral_news_hide_title']) ? true : false;
    update_post_meta($post_id, 'viral_news_hide_title', $viral_news_data);
}

add_action('save_post', 'viral_news_sidebar_layout_save_meta_box');
