<?php

/**
 * @package Viral News
 */
$viral_news_frontpage_carousel_blocks = get_theme_mod('viral_news_frontpage_carousel_blocks', json_encode(array(
    array(
        'title' => esc_html__('Title', 'viral-news'),
        'category' => '',
        'slide_no' => '4',
        'post_no' => '6',
        'enable' => 'on'
    ))));

if ($viral_news_frontpage_carousel_blocks) {
    $viral_news_frontpage_carousel_blocks = json_decode($viral_news_frontpage_carousel_blocks);
    foreach ($viral_news_frontpage_carousel_blocks as $viral_news_frontpage_carousel_block) {
        if ($viral_news_frontpage_carousel_block->enable == 'on') {

            $args = array(
                'title' => $viral_news_frontpage_carousel_block->title,
                'cat' => $viral_news_frontpage_carousel_block->category,
                'slide_no' => $viral_news_frontpage_carousel_block->slide_no,
                'post_no' => $viral_news_frontpage_carousel_block->post_no
            );

            do_action('viral_news_carousel_section', $args);
        }
    }
}