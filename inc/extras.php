<?php
/**
 * @package Viral News
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function viral_news_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $post_type = array('post', 'page');

    if (is_singular($post_type)) {
        global $post;
        $sidebar_layout = get_post_meta($post->ID, 'viral_news_sidebar_layout', true);

        if (!$sidebar_layout) {
            $sidebar_layout = 'right-sidebar';
        }

        $classes[] = 'viral-news-' . $sidebar_layout;
    }

    $website_layout = get_theme_mod('viral_news_website_layout', 'fullwidth');
    if ($website_layout == 'boxed') {
        $classes[] = 'vn-boxed';
    }

    // Check for AMP pages.
    if (viral_news_is_amp()) {
        $classes[] = 'vn-amp-page';
    }

    return $classes;
}

add_filter('body_class', 'viral_news_body_classes');

if (!function_exists('viral_news_excerpt')) {

    function viral_news_excerpt($content, $letter_count) {
        $new_content = strip_shortcodes($content);
        $new_content = wp_strip_all_tags($new_content);
        $content = mb_substr($new_content, 0, $letter_count);

        if (($letter_count !== 0) && (strlen($new_content) > $letter_count)) {
            $content .= "...";
        }
        return $content;
    }

}

add_filter('wp_page_menu_args', 'viral_news_change_wp_page_menu_args');

if (!function_exists('viral_news_change_wp_page_menu_args')) {

    function viral_news_change_wp_page_menu_args($args) {
        $args['menu_class'] = 'vn-menu vn-clearfix';
        return $args;
    }

}

if (!function_exists('viral_news_filter_archive_title')) {

    function viral_news_filter_archive_title($title) {
        if (is_category()) {
            $title = single_cat_title('', false);
        }
        return $title;
    }

}

add_filter('get_the_archive_title', 'viral_news_filter_archive_title');

if (!function_exists('viral_news_comment')) {

    function viral_news_comment($comment, $args, $depth) {
        $tag = ('div' === $args['style']) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'parent' : '', $comment); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body" <?php echo viral_news_get_schema_attribute('article'); ?>>
                <footer class="comment-meta">
                    <div class="comment-author vcard">
                        <?php if (0 != $args['avatar_size'])
                            echo get_avatar($comment, $args['avatar_size']); ?>
                        <?php echo sprintf('<b class="fn">%s</b>', get_comment_author_link($comment)); ?>
                    </div><!-- .comment-author -->

                    <?php if ('0' == $comment->comment_approved): ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'viral-news'); ?></p>
                    <?php endif; ?>
                    <?php edit_comment_link(esc_html__('Edit', 'viral-news'), '<span class="edit-link">', '</span>'); ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->

                <div class="comment-metadata vn-clearfix">
                    <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            /* translators: 1: comment date, 2: comment time */
                            printf(esc_html__('%1$s at %2$s', 'viral-news'), get_comment_date('', $comment), get_comment_time());
                            ?>
                        </time>
                    </a>

                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => 'div-comment',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        'before' => '<div class="reply">',
                        'after' => '</div>'
                    )));
                    ?>
                </div><!-- .comment-metadata -->
            </article><!-- .comment-body -->
            <?php
    }

}

add_filter('get_custom_logo', 'viral_news_remove_itemprop');

function viral_news_remove_itemprop() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>', esc_url(home_url('/')), wp_get_attachment_image($custom_logo_id, 'full', false, array(
        'class' => 'custom-logo',
    ))
    );
    return $html;
}

if (function_exists('viral_news_check_social_icon_exists')) {

    function viral_news_check_social_icon_exists() {
        $facebook = get_theme_mod('viral_news_social_facebook', '#');
        $twitter = get_theme_mod('viral_news_social_twitter', '#');
        $youtube = get_theme_mod('viral_news_social_youtube', '#');
        $instagram = get_theme_mod('viral_news_social_instagram', '#');

        if ($facebook || $twitter || $youtube || $instagram) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('viral_news_social_links')) {

    function viral_news_social_links() {
        echo '<div class="vn-header-social-icons">';
        $facebook = get_theme_mod('viral_news_social_facebook', '#');
        $twitter = get_theme_mod('viral_news_social_twitter', '#');
        $youtube = get_theme_mod('viral_news_social_youtube', '#');
        $instagram = get_theme_mod('viral_news_social_instagram', '#');

        if ($facebook)
            echo '<a class="vn-facebook" href="' . esc_url($facebook) . '" target="_blank"><i class="mdi-facebook"></i></a>';

        if ($twitter)
            echo '<a class="vn-twitter" href="' . esc_url($twitter) . '" target="_blank"><i class="ti-x-twitter"></i></a>';

        if ($youtube)
            echo '<a class="vn-youtube" href="' . esc_url($youtube) . '" target="_blank"><i class="mdi-youtube"></i></a>';

        if ($instagram)
            echo '<a class="vn-instagram" href="' . esc_url($instagram) . '" target="_blank"><i class="mdi-instagram"></i></a>';
        echo '</div>';
    }

}

if (!function_exists('viral_news_show_date')) {

    function viral_news_show_date() {
        $viral_news_left_header_date = get_theme_mod('viral_news_left_header_date', true);
        if ($viral_news_left_header_date) {
            echo '<span><i class="mdi-clock-time-nine-outline"></i>';
            echo date_i18n('l, F j', time());
            echo '</span>';
        }
    }

}

if (!function_exists('viral_news_header_text')) {

    function viral_news_header_text() {
        $viral_news_left_header_text = get_theme_mod('viral_news_left_header_text');
        if ($viral_news_left_header_text) {
            echo '<span>';
            echo '<i class="mdi-bookmark"></i>' . esc_html($viral_news_left_header_text);
            echo '</span>';
        }
    }

}

if (!function_exists('viral_news_top_menu')) {

    function viral_news_top_menu() {
        wp_nav_menu(
            array(
                'theme_location' => 'viral-news-top-menu',
                'container_class' => 'vn-top-menu',
                'depth' => -1,
                'menu_class' => 'vn-clearfix',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'fallback_cb' => false
            )
        );
    }

}

if (!function_exists('viral_news_site_logo')) {

    function viral_news_site_logo() {
        ?>
            <div id="vn-site-branding">
                <?php
                if (function_exists('has_custom_logo') && has_custom_logo()):
                    the_custom_logo();
                else:
                    if (is_front_page()):
                        ?>
                        <h1 class="vn-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php else: ?>
                        <p class="vn-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php endif; ?>
                    <p class="vn-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                <?php endif; ?>
            </div><!-- .site-branding -->
            <?php
    }

}

if (!function_exists('viral_news_search_icon')) {

    function viral_news_search_icon() {
        echo '<div class="vn-header-search" ' . viral_news_amp_search_toggle() . '>';
        echo '<span><i class="mdi-magnify"></i></span>';
        echo '</div>';
    }

}

if (!function_exists('viral_news_header_search_wrapper')) {

    function viral_news_header_wrapper() {
        $placeholder_text = esc_attr__('Enter a keyword to search...', 'viral-news');
        $form = '<div id="htSearchWrapper" class="ht-search-wrapper">';
        $form .= '<div class="ht-search-container">';
        $form .= '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">';
        $form .= '<input autocomplete="off" type="search" class="search-field" placeholder="' . $placeholder_text . '" value="' . get_search_query() . '" name="s" />';
        $form .= '<button type="submit" class="search-submit"><i class="mdi-magnify"></i></button>';
        $form .= '<a href="#" class="ht-search-close" ' . viral_news_amp_search_is_toggled() . '><span></span></a>';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div>';

        $result = apply_filters('get_search_form', $form);
        echo $result;
    }

}

function viral_news_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

add_action('wp_footer', 'viral_news_header_wrapper');

add_action('viral_news_left_header_content', 'viral_news_show_date', 10);
add_action('viral_news_left_header_content', 'viral_news_header_text', 10);
add_action('viral_news_right_header_content', 'viral_news_top_menu', 10);

add_action('viral_news_main_header_content', 'viral_news_social_links', 10);
add_action('viral_news_main_header_content', 'viral_news_site_logo', 20);
add_action('viral_news_main_header_content', 'viral_news_search_icon', 30);

function viral_news_filter_wordpress_widget_title_class($default_widget_args) {
    $default_widget_args['before_title'] = '<h2 class="vn-block-title"><span>';
    $default_widget_args['after_title'] = '</span></h2>';
    return $default_widget_args;
}

add_filter('elementor/widgets/wordpress/widget_args', 'viral_news_filter_wordpress_widget_title_class');

function viral_news_create_elementor_kit() {
    if (!did_action('elementor/loaded')) {
        return;
    }

    $kit = Elementor\Plugin::$instance->kits_manager->get_active_kit();

    if (!$kit->get_id()) {
        $created_default_kit = Elementor\Plugin::$instance->kits_manager->create_default();
        update_option('elementor_active_kit', $created_default_kit);
    }
}

function viral_news_enable_wpform_export($args) {
    $args['can_export'] = true;
    return $args;
}

add_action('init', 'viral_news_create_elementor_kit');
add_filter('wpforms_post_type_args', 'viral_news_enable_wpform_export');

function viral_news_typography_vars($keys) {
    if (!$keys && !is_array($keys)) {
        return;
    }
    $css = array();

    foreach ($keys as $key) {
        $family = get_theme_mod($key . '_typography');
        $style = get_theme_mod($key . '_style');
        $text_decoration = get_theme_mod($key . '_text_decoration');
        $text_transform = get_theme_mod($key . '_text_transform');
        $size = get_theme_mod($key . '_size');
        $line_height = get_theme_mod($key . '_line_height');
        $letter_spacing = get_theme_mod($key . '_letter_spacing');
        $color = get_theme_mod($key . '_color');

        if (strpos($style, 'italic')) {
            $italic = 'italic';
        }

        $weight = absint($style);
        $key = str_replace('_', '-', $key);

        $css[] = (!empty($family) && $family != 'Default') ? "--" . $key . "-family: '{$family}', serif" : NULL;
        $css[] = !empty($weight) ? "--" . $key . "-weight: {$weight}" : NULL;
        $css[] = !empty($italic) ? "--" . $key . "-style: {$italic}" : NULL;
        $css[] = !empty($text_transform) ? "--" . $key . "-text-transform: {$text_transform}" : NULL;
        $css[] = !empty($text_decoration) ? "--" . $key . "-text-decoration: {$text_decoration}" : NULL;
        $css[] = !empty($size) ? "--" . $key . "-size: {$size}px" : NULL;
        $css[] = !empty($line_height) ? "--" . $key . "-line-height: {$line_height}" : NULL;
        $css[] = !empty($letter_spacing) ? "--" . $key . "-letter-spacing: {$letter_spacing}px" : NULL;
        $css[] = !empty($color) ? "--" . $key . "-color: {$color}" : NULL;
    }

    $css = array_filter($css);

    return implode(';', $css);
}

if (!function_exists('viral_news_add_custom_fonts')) {

    function viral_news_add_custom_fonts($fonts) {
        if (class_exists('Hash_Custom_Font_Uploader_Public')) {
            if (!empty(Hash_Custom_Font_Uploader_Public::get_all_fonts_list())) {
                $new_fonts = array(
                    'label' => esc_html__('Custom Fonts', 'viral-news'),
                    'fonts' => Hash_Custom_Font_Uploader_Public::get_all_fonts_list()
                );
                array_unshift($fonts, $new_fonts);
            }
        }
        return $fonts;
    }

}

add_filter('viral_news_regsiter_fonts', 'viral_news_add_custom_fonts');

function viral_news_premium_demo_config($demos) {
    $premium_demos = array(
        'newspaper' => array(
            'name' => 'Viral Pro - NewsPaper',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/newspaper.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/newspaper/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'magazine' => array(
            'name' => 'Viral Pro - Magazine',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/magazine.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/magazine/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'news' => array(
            'name' => 'Viral Pro - News',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/news.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/news/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-one' => array(
            'name' => 'Viral Pro - News One',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-one.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-one/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-two' => array(
            'name' => 'Viral Pro - News Two',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-two.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-two/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-three' => array(
            'name' => 'Viral Pro - News Three',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-three.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-three/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-four' => array(
            'name' => 'Viral Pro - News Four',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-four.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-four/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'sports' => array(
            'name' => 'Viral Pro - Sports',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/sports.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/sports/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'technology' => array(
            'name' => 'Viral Pro - Technology',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/technology.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/technology/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'illustration' => array(
            'name' => 'Viral Pro - Illustration',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/illustration.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/illustration/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'fashion' => array(
            'name' => 'Viral Pro - Fashion',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/fashion.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/fashion/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'travel' => array(
            'name' => 'Viral Pro - Travel',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/travel.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/travel/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'food' => array(
            'name' => 'Viral Pro - Food',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/food.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/food/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'photography' => array(
            'name' => 'Viral Pro - Photography',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/photography.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/photography/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'rtl' => array(
            'name' => 'Viral Pro - RTL',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/rtl.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/rtl/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        )
    );

    $demos = array_merge($demos, $premium_demos);
    return $demos;
}

add_action('hdi_import_files', 'viral_news_premium_demo_config');
