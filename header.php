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
        <div id="vl-page">
            <a class="skip-link screen-reader-text" href="#vl-content"><?php esc_html_e('Skip to content', 'viral-news'); ?></a>
            <?php
            $viral_news_top_header_display = get_theme_mod('viral_news_top_header_display', 'yes');
            $viral_news_top_header_style = get_theme_mod('viral_news_top_header_style', 'light');
            $viral_news_nav_style = get_theme_mod('viral_news_nav_style', 'light');
            $viral_news_main_header_text_color = get_theme_mod('viral_news_main_header_text_color', 'black');
            ?>
            <header id="vl-masthead" class="vl-site-header">
                <?php if ($viral_news_top_header_display == 'yes') { ?>
                    <div class="vl-top-header vl-<?php echo esc_attr($viral_news_top_header_style) ?>">
                        <div class="vl-container">
                            <div class="vl-top-left-header">
                                <?php
                                /*
                                 * Left Header Hook
                                 * @hooked - viral_news_show_date - 10
                                 * @hooked - viral_news_header_text - 10
                                 */
                                do_action('viral_news_left_header_content')
                                ?>
                            </div>

                            <div class="vl-top-right-header">
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

                <div class="vl-header vl-<?php echo esc_attr($viral_news_main_header_text_color) ?>">
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

                <nav id="vl-site-navigation" class="vl-main-navigation vl-<?php echo esc_attr($viral_news_nav_style) ?>">
                    <div class="vl-container">
                        <a href="#" class="vl-toggle-menu"><span></span></a>
                        <?php
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'viral-news-primary-menu',
                                    'container_class' => 'vl-menu vl-clearfix',
                                    'menu_class' => 'vl-clearfix',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                )
                        );
                        ?>
                    </div>
                </nav>
            </header>

            <div id="vl-content" class="vl-site-content">