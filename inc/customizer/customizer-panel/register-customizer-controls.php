<?php

if (!class_exists('Viral_News_Register_Customizer_Controls')) {

    class Viral_News_Register_Customizer_Controls {

        function __construct() {
            add_action('customize_register', array($this, 'register_customizer_settings'));
            add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_customizer_script'));
            add_action('customize_preview_init', array($this, 'enqueue_customize_preview_js'));
        }

        public function register_customizer_settings($wp_customize) {
            /** Theme Options */
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'customizer-panel/settings.php';

            /** For Additional Hooks */
            do_action('viral_news_new_options', $wp_customize);
        }

        public function enqueue_customizer_script() {
            wp_enqueue_script('viral-customizer', VIRAL_NEWS_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.js', array('jquery'), VIRAL_NEWS_VERSION, true);
            if (is_rtl()) {
                wp_enqueue_style('viral-customizer', VIRAL_NEWS_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.rtl.css', array(), VIRAL_NEWS_VERSION);
            } else {
                wp_enqueue_style('viral-customizer', VIRAL_NEWS_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.css', array(), VIRAL_NEWS_VERSION);
            }
        }

        public function enqueue_customize_preview_js() {
            wp_enqueue_script('viral-customizer-preview', VIRAL_NEWS_CUSTOMIZER_URL . 'customizer-panel/assets/customizer-preview.js', array('customize-preview'), VIRAL_NEWS_VERSION, true);
        }

    }

    new Viral_News_Register_Customizer_Controls();
}
