<?php

/**
 * Viral News functions and definitions.
 *
 * @package Viral News
 */
if (!defined('VIRAL_NEWS_VERSION')) {
    $viral_news_get_theme = wp_get_theme();
    $viral_news_version = $viral_news_get_theme->Version;
    define('VIRAL_NEWS_VERSION', $viral_news_version);
}

if (!function_exists('viral_news_setup')):

    function viral_news_setup() {

        load_theme_textdomain('viral-news', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        add_image_size('viral-news-840x440', 840, 440, true);
        add_image_size('viral-news-600x600', 600, 600, true);
        add_image_size('viral-news-400x400', 400, 400, true);
        add_image_size('viral-news-150x150', 150, 150, true);

        register_nav_menus(array(
            'viral-news-primary-menu' => esc_html__('Main Menu', 'viral-news'),
            'viral-news-top-menu' => esc_html__('Top Header Menu', 'viral-news'),
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        ));

        add_theme_support('custom-background', apply_filters('viral_news_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('custom-logo', array(
            'height' => 60,
            'width' => 300,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('.vn-site-title', '.vn-site-description'),
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Add support editor style.
        add_theme_support('editor-styles');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css'));
        // Add theme support for AMP.

        add_theme_support('amp');
    }

endif; // viral_news_setup
add_action('after_setup_theme', 'viral_news_setup');

function viral_news_content_width() {
    $GLOBALS['content_width'] = apply_filters('viral_news_content_width', 810);
}

add_action('after_setup_theme', 'viral_news_content_width', 0);

/**
 * Register widget area.
 */
function viral_news_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'viral-news'),
        'id' => 'viral-news-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'viral-news'),
        'id' => 'viral-news-left-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Middle News Module Sidebar', 'viral-news'),
        'id' => 'viral-news-frontpage-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"><span>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'viral-news'),
        'id' => 'viral-news-footer1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'viral-news'),
        'id' => 'viral-news-footer2',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'viral-news'),
        'id' => 'viral-news-footer3',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'viral-news'),
        'id' => 'viral-news-footer4',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'viral_news_widgets_init');

if (!function_exists('viral_news_fonts_url')):

    /**
     * Register Google fonts for Viral News.
     *
     * @return string Google fonts URL for the theme.
     */
    function viral_news_fonts_url() {
        $fonts_url = '';
        $fonts = $customizer_font_family = array();
        $subsets = 'latin,latin-ext';
        $all_fonts = viral_news_all_fonts();
        $google_fonts = viral_news_google_fonts();

        $customizer_fonts = apply_filters('viral_news_customizer_fonts', array(
            'viral_news_header_typography' => 'Playfair Display',
            'viral_news_body_typography' => 'Libre Baskerville',
            'viral_news_menu_typography' => 'Playfair Display'
        ));

        foreach ($customizer_fonts as $key => $value) {
            $font = get_theme_mod($key, $value);
            if (array_key_exists($font, $google_fonts)) {
                $customizer_font_family[] = $font;
            }
        }

        if ($customizer_font_family) {
            $customizer_font_family = array_unique($customizer_font_family);
            foreach ($customizer_font_family as $font_family) {
                if (isset($all_fonts[$font_family]['variants'])) {
                    $variants_array = $all_fonts[$font_family]['variants'];
                    $variants_keys = array_keys($variants_array);
                    $variants = implode(',', $variants_keys);

                    $fonts[] = $font_family . ':' . str_replace('italic', 'i', $variants);
                }
            }

            if ($fonts) {
                $fonts_url = add_query_arg(array(
                    'family' => urlencode(implode('|', $fonts)),
                    'subset' => urlencode($subsets),
                    'display' => 'swap',
                ), 'https://fonts.googleapis.com/css');
            }
        }

        return $fonts_url;
    }

endif;


/**
 * Backward Compatibility if 'wp_body_open' function does not exist
 */
if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        do_action('wp_body_open');
    }

}

/**
 * Enqueue scripts and styles.
 */
function viral_news_scripts() {

    wp_enqueue_style('viral-news-style', get_stylesheet_uri(), array(), VIRAL_NEWS_VERSION);
    wp_add_inline_style('viral-news-style', viral_news_dymanic_styles());
    wp_style_add_data('viral-news-style', 'rtl', 'replace');
    wp_enqueue_style('twittericon', get_template_directory_uri() . '/css/twittericon.css', array(), VIRAL_NEWS_VERSION);

    if (viral_news_is_amp()) {
        wp_enqueue_style('materialdesignicons-amp', get_template_directory_uri() . '/css/materialdesignicons.amp.css', array(), VIRAL_NEWS_VERSION);
        wp_enqueue_style('viral-news-amp-style', get_template_directory_uri() . '/style-amp.css', array('viral-news-style'), VIRAL_NEWS_VERSION);
    }

    if (!viral_news_is_amp()) {
        wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_NEWS_VERSION);
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), VIRAL_NEWS_VERSION);
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), VIRAL_NEWS_VERSION, true);
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), VIRAL_NEWS_VERSION, true);
        wp_enqueue_script('jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery'), VIRAL_NEWS_VERSION, true);
        wp_enqueue_script('viral-news-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), VIRAL_NEWS_VERSION, true);
        wp_localize_script('viral-news-custom', 'viral_news_localize', array(
            'is_rtl' => is_rtl() ? 'true' : 'false'
        ));

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    $fonts_url = viral_news_fonts_url();
    $load_font_locally = get_theme_mod('viral_news_load_google_font_locally', false);
    if ($fonts_url && $load_font_locally) {
        require_once get_theme_file_path('inc/wptt-webfont-loader.php');
        $fonts_url = wptt_get_webfont_url($fonts_url);
    }

    // Load Fonts if necessary.
    if ($fonts_url) {
        wp_enqueue_style('viral-news-fonts', $fonts_url, array(), NULL);
    }
}

add_action('wp_enqueue_scripts', 'viral_news_scripts');

add_action('wp_print_scripts', function () {
    if (!is_admin()) {
        return;
    }
    if (function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor() && get_current_screen()->base === 'post') {
        echo '<style id="viral-news-admin-css-vars">';
        echo viral_news_dymanic_styles();
        echo '</style>';
    }
});

/**
 * Enqueue admin scripts and styles.
 */
function viral_news_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('viral-news-admin-scripts', get_template_directory_uri() . '/inc/js/admin-scripts.js', array('jquery'), VIRAL_NEWS_VERSION, true);
    wp_enqueue_style('viral-news-admin-style', get_template_directory_uri() . '/inc/css/admin-style.css', array(), VIRAL_NEWS_VERSION);

    $fonts_url = viral_news_fonts_url();

    // Load Fonts if necessary.
    if ($fonts_url && function_exists('get_current_screen') && get_current_screen() && get_current_screen()->is_block_editor() && get_current_screen()->base === 'post') {
        wp_enqueue_style('viral-news-fonts', $fonts_url, array(), NULL);
    }
}

add_action('admin_enqueue_scripts', 'viral_news_admin_scripts');

add_action('elementor/editor/before_enqueue_scripts', 'viral_news_admin_scripts');

add_filter('template_include', 'viral_news_frontpage_template', 9999);

function viral_news_frontpage_template($template) {
    if (is_front_page()) {
        $enable_frontpage = get_theme_mod('viral_news_enable_frontpage', false);
        if ($enable_frontpage) {
            $new_template = locate_template(array('templates/template-home.php'));
            if ('' != $new_template) {
                return $new_template;
            }
        }
    }
    return $template;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Metabox additions.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Hooks additions.
 */
require get_template_directory() . '/inc/hooks.php';


/**
 * Dynamic Styles additions.
 */
require get_template_directory() . '/inc/style.php';

/**
 * Widgets additions.
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/widget-contact-info.php';
require get_template_directory() . '/inc/widgets/widget-personal-info.php';
require get_template_directory() . '/inc/widgets/widget-timeline.php';
require get_template_directory() . '/inc/widgets/widget-category-block.php';

/**
 * Welcome Page.
 */
require get_template_directory() . '/welcome/welcome.php';
