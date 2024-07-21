<?php

/**
 * @package Viral News
 */
$viral_news_frontpage_middle_blocks = get_theme_mod('viral_news_frontpage_middle_blocks', json_encode(array(
    array(
        'title' => esc_html__('Title', 'viral-news'),
        'category' => '',
        'layout' => 'style1',
        'enable' => 'on'
    ))));

if ($viral_news_frontpage_middle_blocks) {
    $viral_news_frontpage_middle_blocks = json_decode($viral_news_frontpage_middle_blocks);
    foreach ($viral_news_frontpage_middle_blocks as $viral_news_frontpage_middle_block) {
        if ($viral_news_frontpage_middle_block->enable == 'on') {
            $viral_news_layout = $viral_news_frontpage_middle_block->layout;

            $args = array(
                'cat' => $viral_news_frontpage_middle_block->category,
                'layout' => $viral_news_layout,
                'title' => $viral_news_frontpage_middle_block->title
            );

            do_action('viral_news_middle_section', $args);
        }
    }
}