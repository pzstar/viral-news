<?php
/**
 * @package Viral News
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="vl-page">
	<header id="vl-masthead" class="vl-site-header">
		<div class="vl-top-header">
			<div class="vl-container vl-clearfix">
				<div class="vl-top-left-header">
					<?php 
					/*
					* Left Header Hook
					* @hooked - viral_news_show_date - 10
					* @hooked - viral_news_header_text - 10
					*/
					do_action('viral_news_left_header_content') ?>
				</div>

				<div class="vl-top-right-header">
					<?php 
					/*
					* Right Header Hook
					* @hooked - viral_news_top_menu - 10
					*/
					do_action('viral_news_right_header_content') ?>
				</div>
			</div>
		</div>

		<div class="vl-header">
			<div class="vl-container">
				<?php 
					/*
					* Right Header Hook
					* @hooked - viral_news_left_header - 10
					* @hooked - viral_news_middle_header - 20
					* @hooked - viral_news_right_header - 30
					*/
					do_action('viral_news_main_header_content') 
				?>
			</div>
		</div>

		<nav id="vl-site-navigation" class="vl-main-navigation">
			<div class="vl-container">
			<div class="vl-toggle-menu"><span></span></div>
				<?php wp_nav_menu( 
						array( 
						'theme_location' => 'primary', 
						'container_class' => 'vl-menu vl-clearfix' ,
						'menu_class' => 'vl-clearfix',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 
						) 
					); 
				?>
			</div>
		</nav><!-- #vl-site-navigation -->
	</header><!-- #vl-masthead -->

	<div id="vl-content" class="vl-site-content">