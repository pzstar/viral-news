<?php

$image_path_url = get_template_directory_uri() . '/images/';

$wp_customize->get_setting('blogname')->transport = 'postMessage';
$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
$wp_customize->get_setting('custom_logo')->transport = 'refresh';

$viral_pro_features = '<ul class="upsell-features">
    <li>' . esc_html__("13 more demos that can be imported with one click", "viral-news") . '</li>
    <li>' . esc_html__("Elementor compatible - Built your Home Page with Customizer or Elementor whichever you like", "viral-news") . '</li>
    <li>' . esc_html__("50+ magazine blocks for customizer", "viral-news") . '</li>
    <li>' . esc_html__("Customizer home page section reorder", "viral-news") . '</li>
    <li>' . esc_html__("45+ magazine widgets for Elementor", "viral-news") . '</li>
    <li>' . esc_html__("Ajax Tabs and Ajax Paginations for all Elementor widgets", "viral-news") . '</li>
    <li>' . esc_html__("7 differently designed Blog/Archive layouts", "viral-news") . '</li>
    <li>' . esc_html__("7 differently designed Single Article/Post layouts", "viral-news") . '</li>
    <li>' . esc_html__("22 custom widgets", "viral-news") . '</li>
    <li>' . esc_html__("GDPR compliance & cookies consent", "viral-news") . '</li>
    <li>' . esc_html__("Multiple header layouts and settings", "viral-news") . '</li>
    <li>' . esc_html__("In-built megaMenu", "viral-news") . '</li>
    <li>' . esc_html__("Advanced typography options", "viral-news") . '</li>
    <li>' . esc_html__("Advanced color options", "viral-news") . '</li>
    <li>' . esc_html__("Preloader option", "viral-news") . '</li>
    <li>' . esc_html__("Sidebar layout options", "viral-news") . '</li>
    <li>' . esc_html__("Website layout (fullwidth or boxed)", "viral-news") . '</li>
    <li>' . esc_html__("Advanced blog & article settings", "viral-news") . '</li>
    <li>' . esc_html__("Advanced footer setting", "viral-news") . '</li>
    <li>' . esc_html__("Advanced advertising & monetization options", "viral-news") . '</li>
    <li>' . esc_html__("Blog single page - Author Box, Social Share and Related Post", "viral-news") . '</li>
    <li>' . esc_html__("WooCommerce compatible", "viral-news") . '</li>
    <li>' . esc_html__("Fully multilingual and translation ready", "viral-news") . '</li>
    <li>' . esc_html__("Fully RTL(right to left) languages compatible", "viral-news") . '</li>
        <li>' . esc_html__("Maintenance mode option", "viral-news") . '</li>
        <li>' . esc_html__("Remove footer credit text", "viral-news") . '</li>
    </ul>
    <a class="ht-implink" href="' . admin_url('admin.php?page=viral-news-welcome&section=free_vs_pro') . '" target="_blank">' . esc_html__("Comparision - Free Vs Pro", "viral-news") . '</a>';

$wp_customize->add_section(new Viral_News_Upgrade_Section($wp_customize, 'viral-news-pro-section', array(
    'priority' => 0,
    //'title' => esc_html__('Christmas & New Year Deal. Use Coupon Code: HOLIDAY', 'viral-news'),
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-customizer-button&utm_campaign=viral-news-upgrade',
)));

$wp_customize->add_section(new Viral_News_Upgrade_Section($wp_customize, 'viral-news-doc-section', array(
    'title' => esc_html__('Documentation', 'viral-news'),
    'priority' => 1000,
    'upgrade_text' => esc_html__('View', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/documentation/viral-news-documentation/'
)));

$wp_customize->add_section(new Viral_News_Upgrade_Section($wp_customize, 'viral-news-demo-import-section', array(
    'title' => esc_html__('Import Demo Content', 'viral-news'),
    'priority' => 999,
    'upgrade_text' => esc_html__('Import', 'viral-news'),
    'upgrade_url' => admin_url('admin.php?page=viral-news-welcome')
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
$wp_customize->get_section('title_tagline')->panel = 'viral_news_header_setting_panel';
$wp_customize->get_section('title_tagline')->title = esc_html__('Logo & Favicon', 'viral-news');
$wp_customize->get_control('header_text')->label = esc_html__('Display Site Title and Tagline(Only Displays if Logo is Removed)', 'viral-news');
$wp_customize->get_section('background_image')->panel = 'viral_news_general_settings_panel';
$wp_customize->get_section('colors')->title = esc_html__('Colors Settings', 'viral-news');
$wp_customize->get_section('colors')->priority = 5;

//MOVE BACKGROUND AND COLOR SETTING INTO GENERAL SETTING PANEL
$wp_customize->get_control('background_color')->section = 'viral_news_website_layout_section';
$wp_customize->get_control('background_image')->section = 'viral_news_website_layout_section';
$wp_customize->get_control('background_preset')->section = 'viral_news_website_layout_section';
$wp_customize->get_control('background_position')->section = 'viral_news_website_layout_section';
$wp_customize->get_control('background_size')->section = 'viral_news_website_layout_section';
$wp_customize->get_control('background_repeat')->section = 'viral_news_website_layout_section';
$wp_customize->get_control('background_attachment')->section = 'viral_news_website_layout_section';

$wp_customize->get_control('background_color')->priority = 20;
$wp_customize->get_control('background_image')->priority = 20;
$wp_customize->get_control('background_preset')->priority = 20;
$wp_customize->get_control('background_position')->priority = 20;
$wp_customize->get_control('background_size')->priority = 20;
$wp_customize->get_control('background_repeat')->priority = 20;
$wp_customize->get_control('background_attachment')->priority = 20;

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

$wp_customize->add_setting('viral_news_background_heading', array(
    'sanitize_callback' => 'viral_news_sanitize_text',
));

$wp_customize->add_control(new Viral_News_Heading_Control($wp_customize, 'viral_news_background_heading', array(
    'section' => 'viral_news_website_layout_section',
    'label' => esc_html__('Background', 'viral-news'),
)));

$wp_customize->add_setting('viral_news_web_layout_upgrade_text', array(
    'sanitize_callback' => 'viral_news_sanitize_text'
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_web_layout_upgrade_text', array(
    'section' => 'viral_news_website_layout_section',
    'label' => esc_html__('For more options,', 'viral-news'),
    'choices' => array(
        esc_html__('Fuild Layout', 'viral-news'),
        esc_html__('Set custom container & sidebar width', 'viral-news'),
        esc_html__('16+ animated preloaders', 'viral-news'),
        esc_html__('Admin page custom logo', 'viral-news'),
        esc_html__('Show/Hide Back to Top button with advanced settings', 'viral-news')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* GOOGLE FONT SECTION */
$wp_customize->add_section('viral_news_google_font_section', array(
    'title' => esc_html__('Google Fonts', 'viral-news'),
    'panel' => 'viral_news_general_settings_panel',
    'priority' => 1000
));

$wp_customize->add_setting('viral_news_load_google_font_locally', array(
    'sanitize_callback' => 'viral_news_sanitize_checkbox',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_News_Toggle_Control($wp_customize, 'viral_news_load_google_font_locally', array(
    'section' => 'viral_news_google_font_section',
    'label' => esc_html__('Load Google Fonts Locally', 'viral-news'),
    'description' => esc_html__('It is required to load the Google Fonts locally in order to comply with GDPR. However, if your website is not required to comply with GDPR then you can check this field off. Loading the Fonts locally with lots of different Google fonts can decrease the speed of the website slightly.', 'viral-news'),
)));

$wp_customize->add_setting('viral_news_title_tagline_upgrade_text', array(
    'sanitize_callback' => 'viral_news_sanitize_text'
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_title_tagline_upgrade_text', array(
    'section' => 'title_tagline',
    'label' => esc_html__('For more options,', 'viral-news'),
    'choices' => array(
        esc_html__('Show/Hide title & tagline seperately', 'viral-news'),
        esc_html__('Set title/tagline position', 'viral-news'),
        esc_html__('Set logo height and top/bottom spacing', 'viral-news'),
        esc_html__('Set title & tagline typography individually', 'viral-news'),
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* SEO SECTION */
$wp_customize->add_section('viral_news_seo_section', array(
    'title' => esc_html__('SEO', 'viral-news'),
    'panel' => 'viral_news_general_settings_panel',
    'priority' => 1000
));

$wp_customize->add_setting('viral_news_schema_markup', array(
    'sanitize_callback' => 'viral_news_sanitize_checkbox',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_News_Toggle_Control($wp_customize, 'viral_news_schema_markup', array(
    'section' => 'viral_news_seo_section',
    'label' => esc_html__('Schema.org Markup', 'viral-news'),
    'description' => esc_html__('Enable Schema.org markup feature for your site. You can disable this option if if you use a SEO plugin.', 'viral-news'),
)));

/* ============COLOR SETTING============ */
$wp_customize->add_setting('viral_news_template_color', array(
    'default' => '#0078af',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_news_template_color', array(
    'section' => 'colors',
    'label' => esc_html__('Template Color', 'viral-news')
)));

$wp_customize->add_setting('viral_news_color_upgrade_text', array(
    'sanitize_callback' => 'viral_news_sanitize_text'
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_color_upgrade_text', array(
    'section' => 'colors',
    'label' => esc_html__('For more color settings,', 'viral-news'),
    'choices' => array(
        esc_html__('Content text color', 'viral-news'),
        esc_html__('Content link & link hover color', 'viral-news'),
        esc_html__('Category tags color for front page blocks', 'viral-news'),
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* ============TYPOGRAPHY SETTING ============ */
$wp_customize->add_panel('viral_news_typography_panel', array(
    'priority' => 10,
    'title' => esc_html__('Typography Settings', 'viral-news')
));

// Add the body typography section.
$wp_customize->add_section('viral_news_body_typography_section', array(
    'panel' => 'viral_news_typography_panel',
    'title' => esc_html__('Body', 'viral-news')
));

$wp_customize->add_setting('viral_news_body_typography', array(
    'default' => 'Libre Baskerville',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_body_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_body_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_body_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_body_size', array(
    'default' => '14',
    'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('viral_news_body_line_height', array(
    'default' => '1.8',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_body_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_body_color', array(
    'default' => '#444444',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new Viral_News_Typography_Control($wp_customize, 'viral_news_body_typo', array(
    'label' => esc_html__('Body Typography', 'viral-news'),
    'description' => __('Select how you want your body to appear.', 'viral-news'),
    'section' => 'viral_news_body_typography_section',
    'settings' => array(
        'family' => 'viral_news_body_typography',
        'style' => 'viral_news_body_style',
        'text_decoration' => 'viral_news_body_text_decoration',
        'text_transform' => 'viral_news_body_text_transform',
        'size' => 'viral_news_body_size',
        'line_height' => 'viral_news_body_line_height',
        'letter_spacing' => 'viral_news_body_letter_spacing',
        'color' => 'viral_news_body_color'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 40,
        'step' => 1
    )
)));


// Add Header typography section.
$wp_customize->add_section('viral_news_header_typography_section', array(
    'panel' => 'viral_news_typography_panel',
    'title' => esc_html__('Header', 'viral-news')
));

// Add H typography section.
$wp_customize->add_setting('viral_news_header_typography', array(
    'default' => 'Playfair Display',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_header_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_header_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_header_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_header_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_header_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(new Viral_News_Typography_Control($wp_customize, 'viral_news_header_typo', array(
    'label' => esc_html__('Header Typography', 'viral-news'),
    'description' => __('Select how you want your Header to appear.', 'viral-news'),
    'section' => 'viral_news_header_typography_section',
    'settings' => array(
        'family' => 'viral_news_header_typography',
        'style' => 'viral_news_header_style',
        'text_decoration' => 'viral_news_header_text_decoration',
        'text_transform' => 'viral_news_header_text_transform',
        'line_height' => 'viral_news_header_line_height',
        'letter_spacing' => 'viral_news_header_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));


// Add Menu typography section.
$wp_customize->add_section('viral_news_menu_typography_section', array(
    'panel' => 'viral_news_typography_panel',
    'title' => esc_html__('Menu', 'viral-news')
));

// Add Menu typography section.
$wp_customize->add_setting('viral_news_menu_typography', array(
    'default' => 'Playfair Display',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_menu_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_menu_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_menu_text_transform', array(
    'default' => 'uppercase',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_setting('viral_news_menu_size', array(
    'default' => '15',
    'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('viral_news_menu_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control(new Viral_News_Typography_Control($wp_customize, 'viral_news_menu_typo', array(
    'label' => esc_html__('Menu Typography', 'viral-news'),
    'description' => __('Select how you want your menu to appear.', 'viral-news'),
    'section' => 'viral_news_menu_typography_section',
    'settings' => array(
        'family' => 'viral_news_menu_typography',
        'style' => 'viral_news_menu_style',
        'text_decoration' => 'viral_news_menu_text_decoration',
        'text_transform' => 'viral_news_menu_text_transform',
        'size' => 'viral_news_menu_size',
        'letter_spacing' => 'viral_news_menu_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_news_typography_upgrade_text', array(
    'sanitize_callback' => 'viral_news_sanitize_text'
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_typography_upgrade_text', array(
    'section' => 'viral_news_typography_section',
    'label' => esc_html__('For more fonts and settings,', 'viral-news'),
    'choices' => array(
        esc_html__('800+ Google fonts', 'viral-news'),
        esc_html__('Seperate Typography settings for Menu, Header Titles(H1, H2, H3, H4, H5, H6), Page Title, Block Title, Widget Title and other', 'viral-news'),
        esc_html__('More advanced Typography options like font family, font weight, text transform, text dectoration, font size, line height, letter spacing', 'viral-news')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_News_Upgrade_Section($wp_customize, 'viral-news-hcfu-section', array(
    'title' => esc_html__('Want To Use Custom Fonts?', 'viral-news'),
    'panel' => 'viral_news_typography_panel',
    'priority' => 1000,
    'class' => 'ht--boxed',
    'options' => array(
        esc_html__('Upload custom fonts. The uploaded font will display in the typography font family list.', 'viral-news'),
    ),
    'upgrade_text' => esc_html__('Purchase Custom Font Uploader', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/downloads/hash-custom-font-uploader/',
    'active_callback' => 'viral_news_check_cfu'
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_left_header_menu', array(
    'settings' => 'viral_news_left_header_menu',
    'section' => 'viral_news_header_settings_sec',
    'description' => esc_html__('To add the Menu, Go to Appearance -> Menu and save it as Top Menu', 'viral-news')
)));

$wp_customize->add_setting('viral_news_top_header_upgrade_text', array(
    'sanitize_callback' => 'viral_news_sanitize_text'
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_top_header_upgrade_text', array(
    'section' => 'viral_news_header_settings_sec',
    'label' => esc_html__('For more options,', 'viral-news'),
    'choices' => array(
        esc_html__('Set custom content for left & right header', 'viral-news'),
        esc_html__('Custom content includes Social Icons, Menu, Widget, Html Text, Date & Time, News Ticker', 'viral-news'),
        esc_html__('Set header height, custom background, border and text colors', 'viral-news')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

$wp_customize->add_section('viral_news_main_header_settings_sec', array(
    'title' => esc_html__('Main Header Settings', 'viral-news'),
    'panel' => 'viral_news_header_setting_panel'
));

$wp_customize->add_setting('viral_news_header_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_main_header_upgrade_text', array(
    'section' => 'viral_news_main_header_settings_sec',
    'label' => esc_html__('For more options,', 'viral-news'),
    'choices' => array(
        esc_html__('7 header layouts', 'viral-news'),
        esc_html__('Sticky header', 'viral-news'),
        esc_html__('Search button', 'viral-news'),
        esc_html__('OffCanvas menu', 'viral-news'),
        esc_html__('Header color options', 'viral-news'),
        esc_html__('10 Menu hover styles', 'viral-news'),
        esc_html__('Menu color options', 'viral-news'),
        esc_html__('Differently designed call to action button at the end of the menu', 'viral-news'),
        esc_html__('Enable/Disable header breadcrumb', 'viral-news'),
        esc_html__('Page title custom typography', 'viral-news'),
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_social_upgrade_text', array(
    'section' => 'viral_news_social_icons_sec',
    'label' => esc_html__('For unlimited and all social icon option,', 'viral-news'),
    'choices' => array(
        esc_html__('Unlimited social icon with custom icon selection', 'viral-news')
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* ============FRONT PAGE PANEL============ */
$wp_customize->add_panel('viral_news_front_page_panel', array(
    'title' => esc_html__('Front Page Sections', 'viral-news'),
    'priority' => 20
));

$wp_customize->add_section(new Viral_News_Upgrade_Section($wp_customize, 'viral-news-frontpage-notice', array(
    'title' => sprintf(esc_html__('Important! Home Page Sections are not enabled. Enable it %1shere%2s.', 'viral-news'), '<a href="javascript:wp.customize.section( \'static_front_page\' ).focus()">', '</a>'),
    'priority' => -1,
    'class' => 'ht--single-row',
    'panel' => 'viral_news_front_page_panel',
    'active_callback' => 'viral_news_check_frontpage'
)));

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

$wp_customize->add_control(new Viral_News_Repeater_Control($wp_customize, 'viral_news_frontpage_top_blocks', array(
    'label' => esc_html__('FrontPage Top Blocks - FullWidth', 'viral-news'),
    'section' => 'viral_news_frontpage_top_sec',
    'settings' => 'viral_news_frontpage_top_blocks',
    'box_label' => esc_html__('News Section', 'viral-news'),
    'add_label' => esc_html__('Add Section', 'viral-news'),
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_top_section_upgrade_text', array(
    'section' => 'viral_news_frontpage_top_sec',
    'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
    'choices' => array(
        esc_html__('30+ more block styles', 'viral-news'),
        esc_html__('Show/Hide category, author and date', 'viral-news'),
        esc_html__('Display Advertisement(image/Google ads) above and below the section', 'viral-news'),
        esc_html__('Add color, image, gradient or video background for the section', 'viral-news'),
        esc_html__('Set top and bottom margin & padding', 'viral-news'),
        esc_html__('Set top and bottom SVG seperators', 'viral-news'),
        esc_html__('12 heading styles with custom colors', 'viral-news'),
        esc_html__('Lazy load for image', 'viral-news'),
        esc_html__('10 image hover styles', 'viral-news'),
        esc_html__('Set typography for heading and post titles', 'viral-news'),
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* ============FRONT PAGE MIDDLE SECTION============ */
$wp_customize->add_section('viral_news_frontpage_middle_left_sec', array(
    'title' => esc_html__('Middle News Module', 'viral-news'),
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

$wp_customize->add_control(new Viral_News_Repeater_Control($wp_customize, 'viral_news_frontpage_middle_blocks', array(
    'label' => esc_html__('FrontPage Middle Blocks - Left Content', 'viral-news'),
    'description' => sprintf(esc_html__('For the right sidebar, add the widgets in the "Middle News Module Sidebar" in the %s page.', 'viral-news'), '<a href="' . admin_url('/widgets.php') . '" target="_blank">widget</a>'),
    'section' => 'viral_news_frontpage_middle_left_sec',
    'settings' => 'viral_news_frontpage_middle_blocks',
    'box_label' => esc_html__('News Section', 'viral-news'),
    'add_label' => esc_html__('Add Section', 'viral-news'),
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_middle_left_section_upgrade_text', array(
    'section' => 'viral_news_frontpage_middle_left_sec',
    'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
    'priority' => 100,
    'choices' => array(
        esc_html__('30+ more block styles', 'viral-news'),
        esc_html__('Show/Hide category, author and date', 'viral-news'),
        esc_html__('Display Advertisement(image/Google ads) above and below the section', 'viral-news'),
        esc_html__('Add color, image, gradient or video background for the section', 'viral-news'),
        esc_html__('Set top and bottom margin & padding', 'viral-news'),
        esc_html__('Set top and bottom SVG seperators', 'viral-news'),
        esc_html__('12 heading styles with custom colors', 'viral-news'),
        esc_html__('Lazy load for image', 'viral-news'),
        esc_html__('10 image hover styles', 'viral-news'),
        esc_html__('Set typography for heading and post titles', 'viral-news'),
    ),
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
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

$wp_customize->add_control(new Viral_News_Repeater_Control($wp_customize, 'viral_news_frontpage_carousel_blocks', array(
    'label' => esc_html__('FrontPage Carousel Blocks', 'viral-news'),
    'section' => 'viral_news_frontpage_carousel_sec',
    'settings' => 'viral_news_frontpage_carousel_blocks',
    'box_label' => esc_html__('News Section', 'viral-news'),
    'add_label' => esc_html__('Add Section', 'viral-news'),
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_frontpage_carousel_upgrade_text', array(
    'section' => 'viral_news_frontpage_carousel_sec',
    'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
    'choices' => array(
        esc_html__('30+ more block styles', 'viral-news'),
        esc_html__('Show/Hide category, author and date', 'viral-news'),
        esc_html__('Display Advertisement(image/Google ads) above and below the section', 'viral-news'),
        esc_html__('Add color, image, gradient or video background for the section', 'viral-news'),
        esc_html__('Set top and bottom margin & padding', 'viral-news'),
        esc_html__('Set top and bottom SVG seperators', 'viral-news'),
        esc_html__('12 heading styles with custom colors', 'viral-news'),
        esc_html__('Lazy load for image', 'viral-news'),
        esc_html__('10 image hover styles', 'viral-news'),
        esc_html__('Set typography for heading and post titles', 'viral-news'),
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
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

$wp_customize->add_control(new Viral_News_Repeater_Control($wp_customize, 'viral_news_frontpage_bottom_blocks', array(
    'label' => esc_html__('FrontPage Bottom Blocks - FullWidth', 'viral-news'),
    'section' => 'viral_news_frontpage_bottom_sec',
    'settings' => 'viral_news_frontpage_bottom_blocks',
    'box_label' => esc_html__('News Section', 'viral-news'),
    'add_label' => esc_html__('Add Section', 'viral-news'),
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

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_frontpage_bottom_sec_upgrade_text', array(
    'section' => 'viral_news_frontpage_bottom_sec',
    'label' => esc_html__('For more block layouts and settings,', 'viral-news'),
    'choices' => array(
        esc_html__('30+ more block styles', 'viral-news'),
        esc_html__('Show/Hide category, author and date', 'viral-news'),
        esc_html__('Display Advertisement(image/Google ads) above and below the section', 'viral-news'),
        esc_html__('Add color, image, gradient or video background for the section', 'viral-news'),
        esc_html__('Set top and bottom margin & padding', 'viral-news'),
        esc_html__('Set top and bottom SVG seperators', 'viral-news'),
        esc_html__('12 heading styles with custom colors', 'viral-news'),
        esc_html__('Lazy load for image', 'viral-news'),
        esc_html__('10 image hover styles', 'viral-news'),
        esc_html__('Set typography for heading and post titles', 'viral-news'),
    ),
    'priority' => 100,
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_News_Upgrade_Section($wp_customize, 'viral-news-upgrade-section', array(
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
        esc_html__('- Three Column Module', 'viral-news'),
        esc_html__('- Google Ads/Image Ads in betweeen Modules', 'viral-news')
    ),
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* ============SINGLE POST SECTION============ */
$wp_customize->add_section('viral_news_single_post_sec', array(
    'title' => esc_html__('Single Post Settings', 'viral-news'),
    'priority' => 30
));

$wp_customize->add_setting('viral_news_display_featured_image', array(
    'sanitize_callback' => 'viral_news_sanitize_checkbox'
));

$wp_customize->add_control(new Viral_News_Toggle_Control($wp_customize, 'viral_news_display_featured_image', array(
    'section' => 'viral_news_single_post_sec',
    'label' => esc_html__('Display Featured Image', 'viral-news'),
    'description' => esc_html__('Displays Featured Image at the top of the post.', 'viral-news'),
)));

$wp_customize->add_setting('viral_news_display_date_option', array(
    'default' => 'posted',
    'sanitize_callback' => 'viral_news_sanitize_choices'
));

$wp_customize->add_control('viral_news_display_date_option', array(
    'section' => 'viral_news_single_post_sec',
    'type' => 'radio',
    'label' => esc_html__('Display Posted/Updated Date', 'viral-news'),
    'description' => esc_html__('Applies on Single and Archive Pages', 'viral-news'),
    'choices' => array(
        'posted' => esc_html__('Posted Date', 'viral-news'),
        'updated' => esc_html__('Updated Date', 'viral-news')
    )
));

$wp_customize->add_setting('viral_news_single_post_sec_upgrade_text', array(
    'sanitize_callback' => 'viral_news_sanitize_text'
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_news_single_post_sec_upgrade_text', array(
    'section' => 'viral_news_single_post_sec',
    'label' => esc_html__('For more options,', 'viral-news'),
    'choices' => array(
        esc_html__('7 differently designed single post layouts', 'viral-news'),
        esc_html__('Enable and disable every elements like author, date, comments, tags, categories', 'viral-news'),
        esc_html__('Display reading time & post view counts', 'viral-news'),
        esc_html__('Sticky & non sticky social share button', 'viral-news'),
        esc_html__('Author box & 4 differently designed related posts', 'viral-news'),
    ),
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-news'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-news-link&utm_campaign=viral-news-upgrade',
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));

/* ============PRO FEATURES============ */
$wp_customize->add_section('viral_pro_feature_section', array(
    'title' => esc_html__('Pro Theme Features', 'viral-news'),
    'priority' => 0
));

$wp_customize->add_setting('viral_news_hide_upgrade_notice', array(
    'sanitize_callback' => 'viral_news_sanitize_checkbox',
    'default' => false,
));

$wp_customize->add_control(new Viral_News_Toggle_Control($wp_customize, 'viral_news_hide_upgrade_notice', array(
    'section' => 'viral_pro_feature_section',
    'label' => esc_html__('Hide all Upgrade Notices from Customizer', 'viral-news'),
    'description' => esc_html__('If you don\'t want to upgrade to premium version then you can turn off all the upgrade notices. However you can turn it on anytime if you make mind to upgrade to premium version.', 'viral-news')
)));

$wp_customize->add_setting('viral_pro_features', array(
    'sanitize_callback' => 'viral_news_sanitize_text',
));

$wp_customize->add_control(new Viral_News_Upgrade_Info_Control($wp_customize, 'viral_pro_features', array(
    'settings' => 'viral_pro_features',
    'section' => 'viral_pro_feature_section',
    'description' => $viral_pro_features,
    'active_callback' => 'viral_news_is_upgrade_notice_active'
)));
