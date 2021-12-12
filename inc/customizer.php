<?php
/**
 * Viral News Theme Customizer.
 *
 * @package Viral News
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function viral_news_customize_register($wp_customize) {
    $image_path_url = get_template_directory_uri() . '/images/';

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    $wp_customize->get_setting('custom_logo')->transport = 'refresh';

    $wp_customize->register_section_type('Viral_News_Customize_Section_Pro');
    $wp_customize->register_section_type('Viral_News_Customize_Upgrade_Section');

    $wp_customize->add_section(new Viral_News_Customize_Section_Pro($wp_customize, 'viral-news-pro-section', array(
        'priority' => 0,
        'pro_text' => esc_html__('Upgrade to Pro', 'viral-news'),
        'pro_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-customizer-button&utm_campaign=viral-news-upgrade'
    )));

    $wp_customize->add_section(new Viral_News_Customize_Section_Pro($wp_customize, 'viral-news-doc-section', array(
        'title' => esc_html__('Documentation', 'viral-news'),
        'priority' => 1000,
        'pro_text' => esc_html__('View', 'viral-news'),
        'pro_url' => 'https://hashthemes.com/documentation/viral-news-documentation/'
    )));

    $wp_customize->add_section(new Viral_News_Customize_Section_Pro($wp_customize, 'viral-news-demo-import-section', array(
        'title' => esc_html__('Import Demo Content', 'viral-news'),
        'priority' => 0,
        'pro_text' => esc_html__('Import', 'viral-news'),
        'pro_url' => admin_url('admin.php?page=viral-news-welcome')
    )));

    /* ============HOMEPAGE SETTINGS PANEL============ */
    $wp_customize->add_setting('viral_news_enable_frontpage', array(
        'sanitize_callback' => 'viral_news_sanitize_checkbox'
    ));

    $wp_customize->add_control(new Viral_News_Toggle_Control($wp_customize, 'viral_news_enable_frontpage', array(
        'section' => 'static_front_page',
        'label' => esc_html__('Enable FrontPage', 'viral-news'),
        'description' => sprintf(esc_html__('Overwrites the homepage displays setting and shows the frontpage for Customizer %s', 'viral-news'), '<a href="javascript:wp.customize.panel(\'viral_news_front_page_panel\').focus()">' . esc_html__('Front Page Sections', 'viral-news') . '</a>') . '<br/><br/>' . esc_html__('Do not enable this option if you want to use Elementor in home page.', 'viral-news')
    )));

    /* ============GENERAL SETTINGS PANEL============ */
    $wp_customize->add_panel('viral_news_general_settings_panel', array(
        'title' => esc_html__('General Settings', 'viral-news'),
        'priority' => 2
    ));

    $wp_customize->get_section('static_front_page')->priority = 1;
    $wp_customize->get_section('title_tagline')->panel = 'viral_news_general_settings_panel';
    $wp_customize->get_section('title_tagline')->title = esc_html__('Site Logo Title and Tagline', 'viral-news');
    $wp_customize->get_control('header_text')->label = esc_html__('Display Site Title and Tagline(Only Displays if Logo is Removed)', 'viral-news');
    $wp_customize->get_section('background_image')->panel = 'viral_news_general_settings_panel';
    $wp_customize->get_section('colors')->panel = 'viral_news_general_settings_panel';
    $wp_customize->get_control('background_color')->section = 'background_image';
    $wp_customize->get_section('background_image')->title = esc_html__('Background', 'viral-news');

    $wp_customize->add_section('viral_news_website_layout_section', array(
        'title' => esc_html__('Website Layout', 'viral-news'),
        'panel' => 'viral_news_general_settings_panel'
    ));

    $wp_customize->add_setting('viral_news_website_layout', array(
        'default' => 'fullwidth',
        'sanitize_callback' => 'viral_news_sanitize_choices'
    ));

    $wp_customize->add_control('viral_news_website_layout', array(
        'type' => 'radio',
        'section' => 'viral_news_website_layout_section',
        'label' => esc_html__('Choose the Layout', 'viral-news'),
        'choices' => array(
            'fullwidth' => esc_html__('Full Width', 'viral-news'),
            'boxed' => esc_html__('Boxed', 'viral-news'),
    )));

    /* ============COLOR SETTING============ */
    $wp_customize->add_setting('viral_news_template_color', array(
        'default' => '#0078af',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_news_template_color', array(
        'section' => 'colors',
        'label' => esc_html__('Template Color', 'viral-news')
    )));

    $wp_customize->add_setting('viral_news_content_color', array(
        'default' => '#404040',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_news_content_color', array(
        'section' => 'colors',
        'label' => esc_html__('Content Color', 'viral-news')
    )));

    $wp_customize->add_setting('viral_news_color_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_color_upgrade_text', array(
        'section' => 'colors',
        'label' => esc_html__('For more color settings,', 'viral-news'),
        'priority' => 100
    )));

    /* ============TYPOGRAPHY SETTING ============ */
    $wp_customize->add_section('viral_news_typography_section', array(
        'title' => esc_html__('Typography Settings', 'viral-news'),
        'priority' => 1
    ));

    $wp_customize->add_setting('viral_news_header_typography', array(
        'sanitize_callback' => 'viral_news_sanitize_choices',
        'default' => 'Playfair Display'
    ));

    $wp_customize->add_control('viral_news_header_typography', array(
        'section' => 'viral_news_typography_section',
        'type' => 'select',
        'label' => esc_html__('Header Typography', 'viral-news'),
        'choices' => array(
            'Arial' => esc_html__('Arial', 'viral-news'),
            'Georgia' => esc_html__('Georgia', 'viral-news'),
            'Playfair Display' => esc_html__('Playfair Display', 'viral-news'),
            'Nunito Sans' => esc_html__('Nunito Sans', 'viral-news'),
            'Poppins' => esc_html__('Poppins', 'viral-news'),
            'Roboto' => esc_html__('Roboto', 'viral-news')
        )
    ));

    $wp_customize->add_setting('viral_news_body_typography', array(
        'sanitize_callback' => 'viral_news_sanitize_choices',
        'default' => 'Libre Baskerville'
    ));

    $wp_customize->add_control('viral_news_body_typography', array(
        'section' => 'viral_news_typography_section',
        'type' => 'select',
        'label' => esc_html__('Body Typography', 'viral-news'),
        'choices' => array(
            'Arial' => esc_html__('Arial', 'viral-news'),
            'Georgia' => esc_html__('Georgia', 'viral-news'),
            'Lato' => esc_html__('Lato', 'viral-news'),
            'Open Sans' => esc_html__('Open Sans', 'viral-news'),
            'Poppins' => esc_html__('Poppins', 'viral-news'),
            'Libre Baskerville' => esc_html__('Libre Baskerville', 'viral-news')
        )
    ));

    $wp_customize->add_setting('viral_news_typography_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_typography_upgrade_text', array(
        'section' => 'viral_news_typography_section',
        'label' => esc_html__('For more fonts and settings,', 'viral-news'),
        'choices' => array(
            esc_html__('800+ Google fonts', 'viral-news'),
            esc_html__('Seperate Typography settings for Menu, Header Titles(H1, H2, H3, H4, H5, H6), Page Title, Block Title, Widget Title and other', 'viral-news'),
            esc_html__('More advanced Typography options like font family, font weight, text transform, text dectoration, font size, line height, letter spacing', 'viral-news')
        ),
        'priority' => 100
    )));

    /* ============HEADER SETTING PANEL============ */
    $wp_customize->add_panel('viral_news_header_setting_panel', array(
        'title' => esc_html__('Header Settings', 'viral-news'),
        'priority' => 2
    ));

    $wp_customize->add_section('viral_news_header_settings_sec', array(
        'title' => esc_html__('Top Header Settings', 'viral-news'),
        'panel' => 'viral_news_header_setting_panel'
    ));

    $wp_customize->add_setting('viral_news_top_header_display', array(
        'sanitize_callback' => 'viral_news_sanitize_choices',
        'default' => 'yes'
    ));

    $wp_customize->add_control('viral_news_top_header_display', array(
        'section' => 'viral_news_header_settings_sec',
        'type' => 'select',
        'label' => esc_html__('Display Top Header', 'viral-news'),
        'choices' => array(
            'yes' => esc_html__('Yes', 'viral-news'),
            'no' => esc_html__('No', 'viral-news')
        )
    ));

    $wp_customize->add_setting('viral_news_top_header_style', array(
        'sanitize_callback' => 'viral_news_sanitize_choices',
        'default' => 'light'
    ));

    $wp_customize->add_control('viral_news_top_header_style', array(
        'section' => 'viral_news_header_settings_sec',
        'type' => 'select',
        'label' => esc_html__('Top Header Style', 'viral-news'),
        'choices' => array(
            'light' => esc_html__('Light', 'viral-news'),
            'dark' => esc_html__('Dark', 'viral-news'),
            'theme-color' => esc_html__('Theme Color', 'viral-news')
        )
    ));

    $wp_customize->add_setting('viral_news_left_header_date', array(
        'default' => true,
        'sanitize_callback' => 'viral_news_sanitize_checkbox'
    ));

    $wp_customize->add_control('viral_news_left_header_date', array(
        'type' => 'checkbox',
        'settings' => 'viral_news_left_header_date',
        'section' => 'viral_news_header_settings_sec',
        'label' => esc_html__('Show Date in Header (Left Header)', 'viral-news')
    ));

    $wp_customize->add_setting('viral_news_left_header_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control('viral_news_left_header_text', array(
        'type' => 'text',
        'settings' => 'viral_news_left_header_text',
        'section' => 'viral_news_header_settings_sec',
        'label' => esc_html__('Header Text (Left Header)', 'viral-news')
    ));

    $wp_customize->add_setting('viral_news_left_header_menu', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Customize_Info($wp_customize, 'viral_news_left_header_menu', array(
        'settings' => 'viral_news_left_header_menu',
        'section' => 'viral_news_header_settings_sec',
        'label' => esc_html__('Top Header Menu (Right Header)', 'viral-news'),
        'description' => esc_html__('To add the Menu, Go to Appearance -> Menu and save it as Top Menu', 'viral-news')
    )));

    $wp_customize->add_setting('viral_news_top_header_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_top_header_upgrade_text', array(
        'section' => 'viral_news_header_settings_sec',
        'label' => esc_html__('For more options,', 'viral-news'),
        'priority' => 100
    )));

    $wp_customize->add_section('viral_news_main_header_settings_sec', array(
        'title' => esc_html__('Main Header Settings', 'viral-news'),
        'panel' => 'viral_news_header_setting_panel'
    ));

    $wp_customize->add_setting('viral_news_header_image', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'viral_news_header_image', array(
        'label' => esc_html__('Main Header Background Image', 'viral-news'),
        'description' => esc_html__('Recommended Image Size: 2000x250px', 'viral-news'),
        'section' => 'viral_news_main_header_settings_sec'
    )));

    $wp_customize->add_setting('viral_news_main_header_text_color', array(
        'sanitize_callback' => 'viral_news_sanitize_choices',
        'default' => 'black'
    ));

    $wp_customize->add_control('viral_news_main_header_text_color', array(
        'section' => 'viral_news_main_header_settings_sec',
        'type' => 'select',
        'label' => esc_html__('Main Header Text Color', 'viral-news'),
        'description' => esc_html__('Social Icon, Search And Text Logo Color', 'viral-news'),
        'choices' => array(
            'white' => esc_html__('White', 'viral-news'),
            'black' => esc_html__('Black', 'viral-news')
        )
    ));

    $wp_customize->add_setting('viral_news_nav_style', array(
        'sanitize_callback' => 'viral_news_sanitize_choices',
        'default' => 'light'
    ));

    $wp_customize->add_control('viral_news_nav_style', array(
        'section' => 'viral_news_main_header_settings_sec',
        'type' => 'select',
        'label' => esc_html__('Navigation/Menu Background Color', 'viral-news'),
        'choices' => array(
            'light' => esc_html__('Light', 'viral-news'),
            'dark' => esc_html__('Dark', 'viral-news'),
            'theme-color' => esc_html__('Theme Color', 'viral-news')
        )
    ));

    $wp_customize->add_setting('viral_news_main_header_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_main_header_upgrade_text', array(
        'section' => 'viral_news_main_header_settings_sec',
        'label' => esc_html__('For more options,', 'viral-news'),
        'choices' => array(
            esc_html__('7 header layouts', 'viral-news'),
            esc_html__('Sticky header', 'viral-news'),
            esc_html__('Search button', 'viral-news'),
            esc_html__('OffCanvas menu', 'viral-news'),
            esc_html__('Header color options', 'viral-news'),
            esc_html__('10 Menu hover styles', 'viral-news')
        ),
        'priority' => 100
    )));

    $wp_customize->add_section('viral_news_social_icons_sec', array(
        'title' => esc_html__('Header Social Icons', 'viral-news'),
        'panel' => 'viral_news_header_setting_panel'
    ));

    $wp_customize->add_setting('viral_news_social_facebook', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#'
    ));

    $wp_customize->add_control('viral_news_social_facebook', array(
        'settings' => 'viral_news_social_facebook',
        'section' => 'viral_news_social_icons_sec',
        'type' => 'url',
        'label' => esc_html__('Facebook', 'viral-news')
    ));

    $wp_customize->add_setting('viral_news_social_twitter', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#'
    ));

    $wp_customize->add_control('viral_news_social_twitter', array(
        'settings' => 'viral_news_social_twitter',
        'section' => 'viral_news_social_icons_sec',
        'type' => 'url',
        'label' => esc_html__('Twitter', 'viral-news')
    ));

    $wp_customize->add_setting('viral_news_social_youtube', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#'
    ));

    $wp_customize->add_control('viral_news_social_youtube', array(
        'settings' => 'viral_news_social_youtube',
        'section' => 'viral_news_social_icons_sec',
        'type' => 'url',
        'label' => esc_html__('Youtube', 'viral-news')
    ));

    $wp_customize->add_setting('viral_news_social_instagram', array(
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#'
    ));

    $wp_customize->add_control('viral_news_social_instagram', array(
        'settings' => 'viral_news_social_instagram',
        'section' => 'viral_news_social_icons_sec',
        'type' => 'url',
        'label' => esc_html__('Instagram', 'viral-news')
    ));

    $wp_customize->add_setting('viral_news_social_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_social_upgrade_text', array(
        'section' => 'viral_news_social_icons_sec',
        'label' => esc_html__('For unlimited and all social icon option,', 'viral-news'),
        'priority' => 100
    )));

    /* ============FRONT PAGE PANEL============ */
    $wp_customize->add_panel('viral_news_front_page_panel', array(
        'title' => esc_html__('Front Page Sections', 'viral-news'),
        'priority' => 20
    ));

    /* ============FRONT PAGE TOP SECTION============ */
    $wp_customize->add_section('viral_news_frontpage_top_sec', array(
        'title' => esc_html__('Top News Module - Full Width', 'viral-news'),
        'panel' => 'viral_news_front_page_panel',
        'priority' => 10
    ));

    $wp_customize->add_setting('viral_news_frontpage_top_blocks', array(
        'sanitize_callback' => 'viral_news_sanitize_repeater',
        'default' => json_encode(array(
            array(
                'title' => '',
                'category' => '',
                'layout' => 'style1',
                'enable' => 'on'
            )
        ))
    ));

    $wp_customize->add_control(new Viral_News_Repeater_Controler($wp_customize, 'viral_news_frontpage_top_blocks', array(
        'label' => esc_html__('FrontPage Top Blocks - FullWidth', 'viral-news'),
        'section' => 'viral_news_frontpage_top_sec',
        'settings' => 'viral_news_frontpage_top_blocks',
        'viral_news_box_label' => esc_html__('News Section', 'viral-news'),
        'viral_news_box_add_control' => esc_html__('Add Section', 'viral-news'),
            ), array(
        'title' => array(
            'type' => 'text',
            'label' => esc_html__('Title', 'viral-news'),
            'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-news')
        ),
        'category' => array(
            'type' => 'multicategory',
            'label' => esc_html__('Select Category', 'viral-news'),
            'description' => esc_html__('All latest post will display if no category is selected', 'viral-news')
        ),
        'layout' => array(
            'type' => 'selector',
            'label' => esc_html__('Layouts', 'viral-news'),
            'description' => esc_html__('Select the Block Layout', 'viral-news'),
            'options' => array(
                'style1' => $image_path_url . 'top-layout1.png',
                'style2' => $image_path_url . 'top-layout2.png',
                'style3' => $image_path_url . 'top-layout3.png',
                'style4' => $image_path_url . 'top-layout4.png',
            ),
            'default' => 'style1'
        ),
        'enable' => array(
            'type' => 'switch',
            'label' => esc_html__('Enable Section', 'viral-news'),
            'switch' => array(
                'on' => 'Yes',
                'off' => 'No'
            ),
            'default' => 'on'
        )
    )));

    $wp_customize->add_setting('viral_news_top_section_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_top_section_upgrade_text', array(
        'section' => 'viral_news_frontpage_top_sec',
        'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
        'priority' => 100
    )));

    /* ============FRONT PAGE MIDDLE SECTION============ */
    $wp_customize->add_section('viral_news_frontpage_middle_left_sec', array(
        'title' => esc_html__('Middle News Module - Right Sidebar', 'viral-news'),
        'panel' => 'viral_news_front_page_panel',
        'priority' => 20
    ));

    $wp_customize->add_setting('viral_news_frontpage_middle_blocks', array(
        'sanitize_callback' => 'viral_news_sanitize_repeater',
        'default' => json_encode(array(
            array(
                'title' => esc_html__('Title', 'viral-news'),
                'category' => '',
                'layout' => 'style1',
                'enable' => 'on'
            )
        ))
    ));

    $wp_customize->add_control(new Viral_News_Repeater_Controler($wp_customize, 'viral_news_frontpage_middle_blocks', array(
        'label' => esc_html__('FrontPage Middle Blocks - Left Content', 'viral-news'),
        'description' => sprintf(esc_html__('For the right sidebar add the widgets in the "Middle News Module Sidebar" in the %s page.', 'viral-news'), '<a href="' . admin_url('/widgets.php') . '" target="_blank">widget</a>'),
        'section' => 'viral_news_frontpage_middle_left_sec',
        'settings' => 'viral_news_frontpage_middle_blocks',
        'viral_news_box_label' => esc_html__('News Section', 'viral-news'),
        'viral_news_box_add_control' => esc_html__('Add Section', 'viral-news'),
            ), array(
        'title' => array(
            'type' => 'text',
            'label' => esc_html__('Title', 'viral-news'),
            'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-news'),
            'default' => esc_html__('Title', 'viral-news')
        ),
        'category' => array(
            'type' => 'multicategory',
            'label' => esc_html__('Select Category', 'viral-news'),
            'description' => esc_html__('All latest post will display if no category is selected', 'viral-news')
        ),
        'layout' => array(
            'type' => 'selector',
            'label' => esc_html__('Layouts', 'viral-news'),
            'description' => esc_html__('Select the Block Layout', 'viral-news'),
            'options' => array(
                'style1' => $image_path_url . 'middle-layout1.png',
                'style2' => $image_path_url . 'middle-layout2.png',
                'style3' => $image_path_url . 'middle-layout3.png',
                'style4' => $image_path_url . 'middle-layout4.png',
            ),
            'default' => 'style1'
        ),
        'enable' => array(
            'type' => 'switch',
            'label' => esc_html__('Enable Section', 'viral-news'),
            'switch' => array(
                'on' => 'Yes',
                'off' => 'No'
            ),
            'default' => 'on'
        )
    )));

    $wp_customize->add_setting('viral_news_middle_left_section_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_middle_left_section_upgrade_text', array(
        'section' => 'viral_news_frontpage_middle_left_sec',
        'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
        'priority' => 100
    )));

    /* ============FRONT PAGE CAROUSEL SECTION============ */
    $wp_customize->add_section('viral_news_frontpage_carousel_sec', array(
        'title' => esc_html__('Carousel Module', 'viral-news'),
        'panel' => 'viral_news_front_page_panel',
        'priority' => 35
    ));

    $wp_customize->add_setting('viral_news_frontpage_carousel_blocks', array(
        'sanitize_callback' => 'viral_news_sanitize_repeater',
        'default' => json_encode(array(
            array(
                'title' => esc_html__('Title', 'viral-news'),
                'category' => '',
                'slide_no' => '4',
                'enable' => 'on'
            )
        ))
    ));

    $wp_customize->add_control(new Viral_News_Repeater_Controler($wp_customize, 'viral_news_frontpage_carousel_blocks', array(
        'label' => esc_html__('FrontPage Carousel Blocks', 'viral-news'),
        'section' => 'viral_news_frontpage_carousel_sec',
        'settings' => 'viral_news_frontpage_carousel_blocks',
        'viral_news_box_label' => esc_html__('News Section', 'viral-news'),
        'viral_news_box_add_control' => esc_html__('Add Section', 'viral-news'),
            ), array(
        'title' => array(
            'type' => 'text',
            'label' => esc_html__('Title', 'viral-news'),
            'description' => esc_html__('Optional - Leave blank to hide Title', 'viral-news'),
            'default' => esc_html__('Title', 'viral-news')
        ),
        'category' => array(
            'type' => 'multicategory',
            'label' => esc_html__('Select Category', 'viral-news'),
            'description' => esc_html__('All latest post will display if no category is selected', 'viral-news')
        ),
        'slide_no' => array(
            'type' => 'select',
            'label' => esc_html__('No of Slide to Show', 'viral-news'),
            'options' => array(
                '2' => esc_html__('2', 'viral-news'),
                '3' => esc_html__('3', 'viral-news'),
                '4' => esc_html__('4', 'viral-news'),
                '5' => esc_html__('5', 'viral-news'),
                '6' => esc_html__('6', 'viral-news')
            ),
            'default' => '4'
        ),
        'post_no' => array(
            'type' => 'select',
            'label' => esc_html__('No of Post to Show', 'viral-news'),
            'options' => array(
                '2' => esc_html__('2', 'viral-news'),
                '3' => esc_html__('3', 'viral-news'),
                '4' => esc_html__('4', 'viral-news'),
                '5' => esc_html__('5', 'viral-news'),
                '6' => esc_html__('6', 'viral-news'),
                '7' => esc_html__('7', 'viral-news'),
                '8' => esc_html__('8', 'viral-news'),
                '9' => esc_html__('9', 'viral-news'),
                '10' => esc_html__('10', 'viral-news'),
                '11' => esc_html__('11', 'viral-news'),
                '12' => esc_html__('12', 'viral-news'),
            ),
            'default' => '6'
        ),
        'enable' => array(
            'type' => 'switch',
            'label' => esc_html__('Enable Section', 'viral-news'),
            'switch' => array(
                'on' => 'Yes',
                'off' => 'No'
            ),
            'default' => 'on'
        )
    )));

    $wp_customize->add_setting('viral_news_frontpage_carousel_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_frontpage_carousel_upgrade_text', array(
        'section' => 'viral_news_frontpage_carousel_sec',
        'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
        'priority' => 100
    )));

    /* ============FRONT PAGE BOTTOM SECTION============ */
    $wp_customize->add_section('viral_news_frontpage_bottom_sec', array(
        'title' => esc_html__('Bottom Three Column Module', 'viral-news'),
        'panel' => 'viral_news_front_page_panel',
        'priority' => 40
    ));

    $wp_customize->add_setting('viral_news_frontpage_bottom_blocks', array(
        'sanitize_callback' => 'viral_news_sanitize_repeater',
        'default' => json_encode(array(
            array(
                'category1' => '-1',
                'category2' => '-1',
                'category3' => '-1',
                'layout' => 'style1',
                'enable' => 'on'
            )
        ))
    ));

    $wp_customize->add_control(new Viral_News_Repeater_Controler($wp_customize, 'viral_news_frontpage_bottom_blocks', array(
        'label' => esc_html__('FrontPage Bottom Blocks - FullWidth', 'viral-news'),
        'section' => 'viral_news_frontpage_bottom_sec',
        'settings' => 'viral_news_frontpage_bottom_blocks',
        'viral_news_box_label' => esc_html__('News Section', 'viral-news'),
        'viral_news_box_add_control' => esc_html__('Add Section', 'viral-news'),
            ), array(
        'category1' => array(
            'type' => 'category',
            'label' => esc_html__('Category', 'viral-news'),
            'default' => '-1',
            'class' => 'vn-bottom-block-cat1'
        ),
        'category2' => array(
            'type' => 'category',
            'label' => esc_html__('Category', 'viral-news'),
            'default' => '-1',
            'class' => 'vn-bottom-block-cat2'
        ),
        'category3' => array(
            'type' => 'category',
            'label' => esc_html__('Category', 'viral-news'),
            'default' => '-1',
            'class' => 'vn-bottom-block-cat3'
        ),
        'layout' => array(
            'type' => 'selector',
            'label' => esc_html__('Layouts', 'viral-news'),
            'description' => esc_html__('Select the Block Layout', 'viral-news'),
            'options' => array(
                'style1' => $image_path_url . 'bottom-layout1.png',
                'style2' => $image_path_url . 'bottom-layout2.png',
            ),
            'default' => 'style1',
            'class' => 'vn-bottom-block-layout'
        ),
        'enable' => array(
            'type' => 'switch',
            'label' => esc_html__('Enable Section', 'viral-news'),
            'switch' => array(
                'on' => 'Yes',
                'off' => 'No'
            ),
            'default' => 'on'
        )
    )));

    $wp_customize->add_setting('viral_news_frontpage_bottom_sec_upgrade_text', array(
        'sanitize_callback' => 'viral_news_sanitize_text'
    ));

    $wp_customize->add_control(new Viral_News_Upgrade_Text($wp_customize, 'viral_news_frontpage_bottom_sec_upgrade_text', array(
        'section' => 'viral_news_frontpage_bottom_sec',
        'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
        'priority' => 100
    )));

    $wp_customize->add_section(new Viral_News_Customize_Upgrade_Section($wp_customize, 'viral-news-upgrade-section', array(
        'title' => esc_html__('More Sections on Premium', 'viral-news'),
        'panel' => 'viral_news_front_page_panel',
        'priority' => 1000,
        'options' => array(
            esc_html__('--Drag and Drop Reorder Sections--', 'viral-news'),
            esc_html__('- Ticker Module', 'viral-news'),
            esc_html__('- Tile Module', 'viral-news'),
            esc_html__('- Slider Module', 'viral-news'),
            esc_html__('- Carousel Module', 'viral-news'),
            esc_html__('- News Module - Left Sidebar', 'viral-news'),
            esc_html__('- News Module - Right Sidebar', 'viral-news'),
            esc_html__('- Mini News Module', 'viral-news'),
            esc_html__('- Video Playlist Module', 'viral-news'),
            esc_html__('- Full Width News Module', 'viral-news'),
            esc_html__('- Featured Image Module', 'viral-news'),
            esc_html__('- Three Column Module', 'viral-news')
        )
    )));
}

add_action('customize_register', 'viral_news_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function viral_news_customize_preview_js() {
    wp_enqueue_script('viral_news_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), VIRAL_NEWS_VERSION, true);
}

add_action('customize_preview_init', 'viral_news_customize_preview_js');

function viral_news_customizer_script() {
    wp_enqueue_script('viral-news-customizer-script', get_template_directory_uri() . '/inc/js/customizer-scripts.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_NEWS_VERSION);
    wp_enqueue_style('viral-news-customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css', array(), VIRAL_NEWS_VERSION);
}

add_action('customize_controls_enqueue_scripts', 'viral_news_customizer_script');

if (class_exists('WP_Customize_Control')) {

    class Viral_News_Repeater_Controler extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';
        public $viral_news_box_label = '';
        public $viral_news_box_add_control = '';
        private $cats = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controler
         *
         * @since  1.0.0
         */
        public function __construct($manager, $id, $args = array(), $fields = array()) {
            $this->fields = $fields;
            $this->viral_news_box_label = $args['viral_news_box_label'];
            $this->viral_news_box_add_control = $args['viral_news_box_add_control'];
            $this->cats = get_categories(array('hide_empty' => false));
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {

            $values = json_decode($this->value());
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <ul class="viral-news-repeater-field-control-wrap">
                <?php
                $this->viral_news_get_fields();
                ?>
            </ul>

            <input type="hidden" <?php esc_attr($this->link()); ?> class="viral-news-repeater-collector" value="<?php echo esc_attr($this->value()); ?>" />
            <button type="button" class="button viral-news-add-control-field"><?php echo esc_html($this->viral_news_box_add_control); ?></button>
            <?php
        }

        private function viral_news_get_fields() {
            $fields = $this->fields;
            $values = json_decode($this->value());

            if (is_array($values)) {
                foreach ($values as $value) {
                    ?>
                    <li class="viral-news-repeater-field-control">
                        <h3 class="viral-news-repeater-field-title"><?php echo esc_html($this->viral_news_box_label); ?></h3>

                        <div class="viral-news-repeater-fields">
                            <?php
                            foreach ($fields as $key => $field) {
                                $class = isset($field['class']) ? $field['class'] : '';
                                ?>
                                <div class="viral-news-fields viral-news-type-<?php echo esc_attr($field['type']) . ' ' . $class; ?>">

                                    <?php
                                    $label = isset($field['label']) ? $field['label'] : '';
                                    $description = isset($field['description']) ? $field['description'] : '';
                                    if ($field['type'] != 'checkbox') {
                                        ?>
                                        <span class="customize-control-title"><?php echo esc_html($label); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html($description); ?></span>
                                        <?php
                                    }

                                    $new_value = isset($value->$key) ? $value->$key : '';
                                    $default = isset($field['default']) ? $field['default'] : '';

                                    switch ($field['type']) {
                                        case 'text':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        case 'textarea':
                                            echo '<textarea data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">' . esc_textarea($new_value) . '</textarea>';
                                            break;

                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($new_value) {
                                                $image = '<img src="' . esc_url($new_value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            echo '<div class="viral-news-fields-wrap">';
                                            echo '<div class="attachment-media-view">';
                                            echo '<div class="placeholder' . esc_attr($image_class) . '">';
                                            esc_html_e('No image selected', 'viral-news');
                                            echo '</div>';
                                            echo '<div class="thumbnail thumbnail-image">';
                                            echo $image;
                                            echo '</div>';
                                            echo '<div class="actions clearfix">';
                                            echo '<button type="button" class="button viral-news-delete-button align-left">' . esc_html__('Remove', 'viral-news') . '</button>';
                                            echo '<button type="button" class="button viral-news-upload-button alignright">' . esc_html__('Select Image', 'viral-news') . '</button>';
                                            echo '<input data-default="' . esc_attr($default) . '" class="upload-id" data-name="' . esc_attr($key) . '" type="hidden" value="' . esc_attr($new_value) . '"/>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            break;

                                        case 'category':
                                            echo '<select data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            echo '<option value="-1">' . esc_html__('Latest Posts', 'viral-news') . '</option>';
                                            foreach ($this->cats as $cat) {
                                                printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                            }
                                            echo '</select>';
                                            break;

                                        case 'select':
                                            $options = $field['options'];
                                            echo '<select  data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            foreach ($options as $option => $val) {
                                                printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                            }
                                            echo '</select>';
                                            break;

                                        case 'checkbox':
                                            echo '<label>';
                                            echo '<input data-default="' . esc_attr($default) . '" value="' . $new_value . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                            echo esc_html($label);
                                            echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                            echo '</label>';
                                            break;

                                        case 'colorpicker':
                                            echo '<input data-default="' . esc_attr($default) . '" class="viral-news-color-picker" data-alpha="true" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        case 'selector':
                                            $options = $field['options'];
                                            echo '<div class="selector-labels">';
                                            foreach ($options as $option => $val) {
                                                $class = ( $new_value == $option ) ? 'selector-selected' : '';
                                                echo '<label class="' . $class . '" data-val="' . esc_attr($option) . '">';
                                                echo '<img src="' . esc_url($val) . '"/>';
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'radio':
                                            $options = $field['options'];
                                            echo '<div class="radio-labels">';
                                            foreach ($options as $option => $val) {
                                                echo '<label>';
                                                echo '<input value="' . esc_attr($option) . '" type="radio" ' . checked($new_value, $option, false) . '/>';
                                                echo $val;
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'switch':
                                            $switch = $field['switch'];
                                            $switch_class = ($new_value == 'on') ? 'switch-on' : '';
                                            echo '<div class="onoffswitch ' . esc_attr($switch_class) . '">';
                                            echo '<div class="onoffswitch-inner">';
                                            echo '<div class="onoffswitch-active">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["on"]) . '</div>';
                                            echo '</div>';
                                            echo '<div class="onoffswitch-inactive">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["off"]) . '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'range':
                                            $options = $field['options'];
                                            $new_value = $new_value ? $new_value : $options['val'];
                                            echo '<div class="viral-news-range-slider" >';
                                            echo '<div class="range-input" data-defaultvalue="' . esc_attr($options['val']) . '" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                            echo '<input  class="range-input-selector" type="text" value="' . esc_attr($new_value) . '"  data-name="' . esc_attr($key) . '"/>';
                                            echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
                                            echo '</div>';
                                            break;

                                        case 'multicategory':
                                            $new_value_array = !is_array($new_value) ? explode(',', $new_value) : $new_value;
                                            echo '<ul class="viral-news-multi-category-list">';
                                            foreach ($this->cats as $cat) {
                                                $checked = in_array($cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                                echo '<li>';
                                                echo '<label>';
                                                echo '<input type="checkbox" value="' . esc_attr($cat->term_id) . '" ' . $checked . '/>';
                                                echo esc_html($cat->name);
                                                echo '</label>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr(implode(',', $new_value_array)) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        default:
                                            break;
                                    }
                                    ?>
                                </div>
                            <?php }
                            ?>

                            <div class="clearfix viral-news-repeater-footer">
                                <div class="alignright">
                                    <a class="viral-news-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'viral-news') ?></a> |
                                    <a class="viral-news-repeater-field-close" href="#close"><?php esc_html_e('Close', 'viral-news') ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
        }

    }

    class Viral_News_Customize_Heading extends WP_Customize_Control {

        public function render_content() {
            if (!empty($this->label)) :
                ?>
                <h3 class="viral-news-accordion-section-title"><?php echo esc_html($this->label); ?></h3>
                <?php
            endif;
        }

    }

    class Viral_News_Customize_Info extends WP_Customize_Control {

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>
                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </label>
            <?php
        }

    }

    class Viral_News_Dropdown_Chooser extends WP_Customize_Control {

        public function render_content() {
            if (empty($this->choices))
                return;
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <select class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $value => $label)
                        echo '<option value="' . esc_attr($value) . '"' . selected($this->value(), $value, false) . '>' . esc_html($label) . '</option>';
                    ?>
                </select>
            </label>
            <?php
        }

    }

    class Viral_News_Category_Dropdown extends WP_Customize_Control {

        private $cats = false;

        public function __construct($manager, $id, $args = array(), $options = array()) {
            $this->cats = get_categories($options);

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (!empty($this->cats)) {
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                    <span class="description customize-control-description">
                        <?php echo esc_html($this->description); ?>
                    </span>
                    <select <?php $this->link(); ?>>
                        <option value="-1"><?php esc_html_e('Latest Posts', 'viral-news'); ?></option>
                        <?php
                        foreach ($this->cats as $cat) {
                            printf('<option value="%s" %s>%s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                        }
                        ?>
                    </select>
                </label>
                <?php
            }
        }

    }

    class Viral_News_Toggle_Control extends WP_Customize_Control {

        /**
         * Control type
         *
         * @var string
         */
        public $type = 'viral-news-toggle';

        /**
         * Control method
         *
         * @since 1.0.0
         */
        public function render_content() {
            ?>
            <div class="viral-news-checkbox-toggle">
                <div class="toggle-switch">
                    <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> <?php checked($this->value()); ?>>
                    <label class="toggle-label" for="<?php echo esc_attr($this->id); ?>"><span></span></label>
                </div>
                <span class="customize-control-title toggle-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo $this->description; ?>
                    </span>
                <?php } ?>
            </div>
            <?php
        }

    }

    // Upgrade Text
    class Viral_News_Upgrade_Text extends WP_Customize_Control {

        public $type = 'viral-news-upgrade-text';

        public function render_content() {
            ?>
            <label>
                <span class="dashicons dashicons-info"></span>

                <?php if ($this->label) { ?>
                    <span>
                        <?php echo wp_kses_post($this->label); ?>
                    </span>
                <?php } ?>

                <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade'); ?>" target="_blank"> <strong><?php echo esc_html__('Upgrade to PRO', 'viral-news'); ?></strong></a>
            </label>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }

            $choices = $this->choices;
            if ($choices) {
                echo '<ul>';
                foreach ($choices as $choice) {
                    echo '<li>' . esc_html($choice) . '</li>';
                }
                echo '</ul>';
            }
        }

    }

}


if (class_exists('WP_Customize_Section')) {

    /**
     * Pro customizer section.
     *
     * @since  1.0.0
     * @access public
     */
    class Viral_News_Customize_Section_Pro extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'viral-news-pro-section';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url'] = $this->pro_url;

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

                <h3 class="accordion-section-title">
                    <# if ( data.title ) { #>
                    {{ data.title }}
                    <# } #>

                    <# if ( data.pro_text && data.pro_url ) { #>
                    <a href="{{ data.pro_url }}" class="button button-primary" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
            <?php
        }

    }

    class Viral_News_Customize_Upgrade_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'viral-news-upgrade-section';

        /**
         * Custom button text to output.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $text = '';
        public $options = array();

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();

            $json['text'] = $this->text;
            $json['options'] = $this->options;

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
                <label>
                    <# if ( data.title ) { #>
                    {{ data.title }}
                    <# } #>
                </label>

                <# if ( data.text ) { #>
                {{ data.text }}
                <# } #>

                <# _.each( data.options, function(key, value) { #>
                {{ key }}<br/>
                <# }) #>

                <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade'); ?>" class="button button-primary" target="_blank"><?php echo esc_html__('Upgrade to Pro', 'viral-news'); ?></a>
            </li>
            <?php
        }

    }

}

//SANITIZATION FUNCTIONS
function viral_news_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

function viral_news_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}

function viral_news_sanitize_integer($input) {
    if (is_numeric($input)) {
        return intval($input);
    }
}

function viral_news_sanitize_choices($input, $setting) {
    global $wp_customize;

    $control = $wp_customize->get_control($setting->id);

    if (array_key_exists($input, $control->choices)) {
        return $input;
    } else {
        return $setting->default;
    }
}

function viral_news_sanitize_multicategory($value) {
    if (!is_array($value)) {
        $value = explode(',', $value);
    }

    $valid_value = !empty($value) ? array_map('viral_news_sanitize_category', $value) : array();

    return implode(',', $valid_value);
}

function viral_news_sanitize_category($value) {
    $categories = get_categories(array('hide_empty' => false));
    $valid_category_ids = array('-1');
    foreach ($categories as $category) {
        $valid_category_ids[] = $category->term_id;
    }

    return in_array($value, $valid_category_ids) ? $value : NULL;
}

function viral_news_sanitize_repeater($input) {
    $input_decoded = json_decode($input, true);
    $valid_layouts = array('style1', 'style2', 'style3', 'style4');
    $valid_enable = array('on', 'off');
    $valid_slide_no = array('2', '3', '4', '5', '6');
    $valid_post_no = array('2', '3', '4', '5', '6', '7', '8', '9', '10', '12');

    if (!empty($input_decoded)) {
        foreach ($input_decoded as $boxes => $box) {
            foreach ($box as $key => $value) {
                if ($key == 'title') {
                    $input_decoded[$boxes][$key] = sanitize_text_field($value);
                } elseif ($key == 'category') {
                    $input_decoded[$boxes][$key] = viral_news_sanitize_multicategory($value);
                } elseif ($key == 'layout') {
                    $input_decoded[$boxes][$key] = in_array($value, $valid_layouts) ? $value : 'style1';
                } elseif ($key == 'enable') {
                    $input_decoded[$boxes][$key] = in_array($value, $valid_enable) ? $value : 'on';
                } elseif ($key == 'slide_no') {
                    $input_decoded[$boxes][$key] = in_array($value, $valid_slide_no) ? $value : '4';
                } elseif ($key == 'post_no') {
                    $input_decoded[$boxes][$key] = in_array($value, $valid_post_no) ? $value : '6';
                } elseif ($key == 'category1' || $key == 'category1' || $key == 'category1') {
                    $input_decoded[$boxes][$key] = viral_news_sanitize_category($value);
                }
            }
        }

        return json_encode($input_decoded);
    }

    return $input;
}
