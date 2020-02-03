<?php
/**
 * @package Viral News
 */

$viral_news_frontpage_top_blocks = get_theme_mod('viral_news_frontpage_top_blocks');

if($viral_news_frontpage_top_blocks){
	$viral_news_frontpage_top_blocks = json_decode($viral_news_frontpage_top_blocks);
	foreach ($viral_news_frontpage_top_blocks as $viral_news_frontpage_top_block) {
		if( $viral_news_frontpage_top_block->enable == 'on' ){
			$viral_news_layout = $viral_news_frontpage_top_block->layout;
			
			$args = array(
				'cat' => $viral_news_frontpage_top_block->category,
				'layout' => $viral_news_layout
				);

			do_action('viral_news_top_section', $args);
	
		}
	}
}