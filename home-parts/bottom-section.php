<?php

/**
 * @package Viral News
 */
$viral_news_frontpage_bottom_blocks = get_theme_mod('viral_news_frontpage_bottom_blocks', json_encode(array(
    array(
        'category1' => '-1',
        'category2' => '-1',
        'category3' => '-1',
        'layout' => 'style1',
        'enable' => 'on'
    ))));

if ($viral_news_frontpage_bottom_blocks) {
    $viral_news_frontpage_bottom_blocks = json_decode($viral_news_frontpage_bottom_blocks);
    foreach ($viral_news_frontpage_bottom_blocks as $viral_news_frontpage_bottom_block) {
        if ($viral_news_frontpage_bottom_block->enable == 'on') {
            $viral_news_layout = $viral_news_frontpage_bottom_block->layout;

            $args = array(
                'cat1' => $viral_news_frontpage_bottom_block->category1,
                'cat2' => $viral_news_frontpage_bottom_block->category2,
                'cat3' => $viral_news_frontpage_bottom_block->category3,
                'layout' => $viral_news_layout,
            );

            do_action('viral_news_bottom_section', $args);
        }
    }
}