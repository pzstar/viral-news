<?php

/**
 * Viral News functions and definitions.
 *
 * @package Viral News
 */
if (!function_exists('viral_news_setup')) :

    function viral_news_setup() {

        load_theme_textdomain('viral-news', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-thumbnails');
        add_image_size('viral-news-840x440', 840, 440, true);
        add_image_size('viral-news-600x600', 600, 600, true);
        add_image_size('viral-news-400x400', 400, 400, true);
        add_image_size('viral-news-400x300', 400, 300, true);
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
            'header-text' => array('.vl-site-title', '.vl-site-description'),
        ));
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
        'name' => esc_html__('Sidebar', 'viral-news'),
        'id' => 'viral-news-sidebar',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Middle Section - Right Sidebar', 'viral-news'),
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

if (!function_exists('viral_news_fonts_url')) :

    /**
     * Register Google fonts for Viral News.
     *
     * @return string Google fonts URL for the theme.
     */
    function viral_news_fonts_url() {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';
        
        $viral_news_header_typography = get_theme_mod('viral_news_header_typography', 'Playfair Display');
        $viral_news_body_typography = get_theme_mod('viral_news_body_typography', 'Libre Baskerville');
        
        $fonts = array($viral_news_header_typography.':400,400i,700', $viral_news_body_typography.':400,400i,700');
        $fonts = array_unique($fonts);

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'viral-news');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                    ), '//fonts.googleapis.com/css');
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
    wp_enqueue_style('viral-news-fonts', viral_news_fonts_url(), array(), null);
    wp_enqueue_style('font-awesome-4.7', get_template_directory_uri() . '/css/font-awesome.css', array(), '1.0.0');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.0.0');
    wp_enqueue_style('viral-news-style', get_stylesheet_uri());
    wp_add_inline_style('viral-news-style', viral_news_dymanic_styles());

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('viral-news-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'viral_news_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function viral_news_admin_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('viral-news-admin-scripts', get_template_directory_uri() . '/inc/js/admin-scripts.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('viral-news-admin-style', get_template_directory_uri() . '/inc/css/admin-style.css');
}

add_action('admin_enqueue_scripts', 'viral_news_admin_scripts');

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
require get_template_directory() . '/inc/customizer.php';

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
require get_template_directory() . '/inc/widgets/widget-advertisement.php';
