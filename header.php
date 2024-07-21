<?php
/**
 * @package Viral News
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div id="vn-page">
            <a class="skip-link screen-reader-text" href="#vn-content"><?php esc_html_e('Skip to content', 'viral-news'); ?></a>
            <?php
            $viral_news_top_header_display = get_theme_mod('viral_news_top_header_display', 'yes');
            $viral_news_top_header_style = get_theme_mod('viral_news_top_header_style', 'light');
            $viral_news_nav_style = get_theme_mod('viral_news_nav_style', 'light');
            $viral_news_main_header_text_color = get_theme_mod('viral_news_main_header_text_color', 'black');
            ?>
            <header id="vn-masthead" class="vn-site-header" <?php echo viral_news_get_schema_attribute('header'); ?>>
                <?php if ($viral_news_top_header_display == 'yes') { ?>
                    <div class="vn-top-header vn-<?php echo esc_attr($viral_news_top_header_style) ?>">
                        <div class="vn-container">
                            <div class="vn-top-left-header">
                                <?php
                                /*
                                 * Left Header Hook
                                 * @hooked - viral_news_show_date - 10
                                 * @hooked - viral_news_header_text - 10
                                 */
                                do_action('viral_news_left_header_content')
                                    ?>
                            </div>

                            <div class="vn-top-right-header">
                                <?php
                                /*
                                 * Right Header Hook
                                 * @hooked - viral_news_top_menu - 10
                                 */
                                do_action('viral_news_right_header_content')
                                    ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="vn-header vn-<?php echo esc_attr($viral_news_main_header_text_color) ?>">
                    <div class="vn-container">
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

                <?php if (viral_news_is_amp()) { ?>
                    <nav id="vn-site-navigation" class="vn-main-navigation vn-<?php echo esc_attr($viral_news_nav_style) ?>">
                        <div class="vn-container">
                            <div class="vn-header-search"><span <?php echo viral_news_amp_search_toggle(); ?>><i class="mdi-magnify"></i></span></div>

                            <span class="vn-toggle-menu" aria-expanded="false" <?php viral_news_amp_menu_toggle(); ?>><span></span></span>

                            <div id="vn-amp-navigation" <?php viral_news_amp_menu_is_toggled(); ?>     <?php echo viral_news_get_schema_attribute('navigation'); ?>>
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'viral-news-primary-menu',
                                        'container_class' => 'vn-menu vn-clearfix',
                                        'menu_class' => 'vn-clearfix',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    )
                                );
                                ?>
                            </div>
                        </div>
                    </nav>
                <?php } else { ?>
                    <nav id="vn-site-navigation" class="vn-main-navigation vn-<?php echo esc_attr($viral_news_nav_style) ?>">
                        <div class="vn-container">
                            <div class="vn-header-search"><span <?php echo viral_news_amp_search_toggle(); ?>><i class="mdi-magnify"></i></span></div>

                            <a href="#" class="vn-toggle-menu"><span></span></a>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'viral-news-primary-menu',
                                    'container_class' => 'vn-menu vn-clearfix',
                                    'menu_class' => 'vn-clearfix',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                )
                            );
                            ?>
                        </div>
                    </nav>
                <?php } ?>
            </header>

            <div id="vn-content" class="vn-site-content">