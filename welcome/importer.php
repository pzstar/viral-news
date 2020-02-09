<?php

/**
 *
 * @package Viral News
 */
function viral_news_import_files() {
    return array(
        array(
            'import_file_name' => 'Viral News - Demo One',
            'import_file_url' => 'https://hashthemes.com/import-files/viral-news/demo1/content.xml',
            'import_widget_file_url' => 'https://hashthemes.com/import-files/viral-news/demo1/widgets.wie',
            'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral-news/demo1/customizer.dat',
            'import_preview_image_url' => 'https://hashthemes.com/import-files/viral-news/demo1/screenshot.jpg',
            'preview_url' => 'http://demo.hashthemes.com/viral-news/demo1'
        ),
        array(
            'import_file_name' => 'Viral News - Demo Two',
            'import_file_url' => 'https://hashthemes.com/import-files/viral-news/demo2/content.xml',
            'import_widget_file_url' => 'https://hashthemes.com/import-files/viral-news/demo2/widgets.wie',
            'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral-news/demo2/customizer.dat',
            'import_preview_image_url' => 'https://hashthemes.com/import-files/viral-news/demo2/screenshot.jpg',
            'preview_url' => 'http://demo.hashthemes.com/viral-news/demo2'
        ),
        array(
            'import_file_name' => 'Viral News - Demo Three',
            'import_file_url' => 'https://hashthemes.com/import-files/viral-news/demo3/content.xml',
            'import_widget_file_url' => 'https://hashthemes.com/import-files/viral-news/demo3/widgets.wie',
            'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral-news/demo3/customizer.dat',
            'import_preview_image_url' => 'https://hashthemes.com/import-files/viral-news/demo3/screenshot.jpg',
            'preview_url' => 'http://demo.hashthemes.com/viral-news/demo3'
        ),
        array(
            'import_file_name' => 'Viral News - Demo Four',
            'import_file_url' => 'https://hashthemes.com/import-files/viral-news/demo4/content.xml',
            'import_widget_file_url' => 'https://hashthemes.com/import-files/viral-news/demo4/widgets.wie',
            'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral-news/demo4/customizer.dat',
            'import_preview_image_url' => 'https://hashthemes.com/import-files/viral-news/demo4/screenshot.jpg',
            'preview_url' => 'http://demo.hashthemes.com/viral-news/demo4'
        ),
        array(
            'import_file_name' => 'Viral News - Demo Five',
            'import_file_url' => 'https://hashthemes.com/import-files/viral-news/demo5/content.xml',
            'import_widget_file_url' => 'https://hashthemes.com/import-files/viral-news/demo5/widgets.wie',
            'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral-news/demo5/customizer.dat',
            'import_preview_image_url' => 'https://hashthemes.com/import-files/viral-news/demo5/screenshot.jpg',
            'preview_url' => 'http://demo.hashthemes.com/viral-news/demo5'
        ),
        array(
            'import_file_name' => 'Viral News - Demo Six',
            'import_file_url' => 'https://hashthemes.com/import-files/viral-news/demo6/content.xml',
            'import_widget_file_url' => 'https://hashthemes.com/import-files/viral-news/demo6/widgets.wie',
            'import_customizer_file_url' => 'https://hashthemes.com/import-files/viral-news/demo6/customizer.dat',
            'import_preview_image_url' => 'https://hashthemes.com/import-files/viral-news/demo6/screenshot.jpg',
            'preview_url' => 'http://demo.hashthemes.com/viral-news/demo1'
        )
    );
}

add_filter('pt-ocdi/import_files', 'viral_news_import_files');

function viral_news_after_import_setup($selected_import) {
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
    $top_menu = get_term_by('name', 'Top Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'viral-news-primary-menu' => $main_menu->term_id,
        'viral-news-top-menu' => $top_menu->term_id,
    ));

    if ('Viral News - Demo Six' === $selected_import['import_file_name']) {
        update_option('show_on_front', 'posts');
    } else {
        $front_page_id = get_page_by_title('Home');
        $blog_page_id = get_page_by_title('Blog');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
    }
}

add_action('pt-ocdi/after_import', 'viral_news_after_import_setup');

add_filter('pt-ocdi/disable_pt_branding', '__return_true');
