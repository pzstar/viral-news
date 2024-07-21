<?php

/**
 * @package Viral News
 */
$viral_news_frontpage_top_blocks = get_theme_mod('viral_news_frontpage_top_blocks', json_encode(array(
    array(
        'title' => '',
        'category' => '',
        'layout' => 'style1',
        'enable' => 'on'
    ))));

if ($viral_news_frontpage_top_blocks) {
    $viral_news_frontpage_top_blocks = json_decode($viral_news_frontpage_top_blocks);
    foreach ($viral_news_frontpage_top_blocks as $viral_news_frontpage_top_block) {
        if ($viral_news_frontpage_top_block->enable == 'on') {
            $viral_news_layout = $viral_news_frontpage_top_block->layout;

            $args = array(
                'title' => $viral_news_frontpage_top_block->title,
                'cat' => $viral_news_frontpage_top_block->category,
                'layout' => $viral_news_layout
            );

            do_action('viral_news_top_section', $args);
        }
    }
}