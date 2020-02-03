<?php
/**
 *
 * @package Viral News
 */
 
function viral_news_import_files() {
  return array(
    array(
      'import_file_name'           => 'Viral News Demo Import',
      'import_file_url'            => 'https://hashthemes.com/import-files/viral/viral.xml',
      'import_widget_file_url'     => 'https://hashthemes.com/import-files/viral/viral-news-widgets.wie',
      'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral/viral-news-customizer.dat',
      'import_preview_image_url'   => 'https://i0.wp.com/themes.svn.wordpress.org/viral/1.3.1/screenshot.png',
      'preview_url' => 'http://demo.hashthemes.com/viral'
    )
  );
}
add_filter( 'pt-ocdi/import_files', 'viral_news_import_files' );

function viral_news_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home Page' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'viral_news_after_import_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );