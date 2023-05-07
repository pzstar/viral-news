<?php

if (!class_exists('Viral_News_Customizer_Custom_Controls')) {

    class Viral_News_Customizer_Custom_Controls {

        function __construct() {
            add_action('customize_register', array($this, 'register_controls'));
            add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_customizer_script'));
        }

        public function register_controls($wp_customize) {
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/alpha-color-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/background-image-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/color-tab-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/date-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/editor-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/dimensions-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/gallery-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/graident-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/heading-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/icon-selector-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/image-selector-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/multiple-checkbox-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/multiple-select-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/multiple-selectize-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/range-slider-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/repeater-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/responsive-range-slider-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/chosen-select-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/selector-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/separator-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/sortable-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/switch-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/tab-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/text-info-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/text-selector-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/toggle-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/typography/typography-control-class.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/column-control/column-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/upgrade-section.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/upgrade-info.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/toggle-section.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/border-control.php';
            require VIRAL_NEWS_CUSTOMIZER_PATH . 'custom-controls/box-shadow-control.php';

            /** Register Control Type */
            $wp_customize->register_control_type('Viral_News_Color_Tab_Control');
            $wp_customize->register_control_type('Viral_News_Background_Image_Control');
            $wp_customize->register_control_type('Viral_News_Tab_Control');
            $wp_customize->register_control_type('Viral_News_Dimensions_Control');
            $wp_customize->register_control_type('Viral_News_Responsive_Range_Slider_Control');
            $wp_customize->register_control_type('Viral_News_Sortable_Control');
            $wp_customize->register_control_type('Viral_News_Typography_Control');
            $wp_customize->register_control_type('Viral_News_Icon_Selector_Control');
            $wp_customize->register_control_type('Viral_News_Border_Control');
            $wp_customize->register_control_type('Viral_News_Box_Shadow_Control');

            // Register custom section types.
            $wp_customize->register_section_type('Viral_News_Upgrade_Section');
            $wp_customize->register_section_type('Viral_News_Toggle_Section');
        }

        public function enqueue_customizer_script() {
            //See customizer-fonts-iucon.php file
            $icons = apply_filters('viral_news_register_icon', array());

            if ($icons && is_array($icons)) {
                foreach ($icons as $icon) {
                    if (isset($icon['name']) && isset($icon['url'])) {
                        wp_enqueue_style($icon['name'], $icon['url'], array(), VIRAL_NEWS_VERSION);
                    }
                }
            }

            wp_enqueue_script('selectize', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/js/selectize.js', array('jquery'), VIRAL_NEWS_VERSION, true);
            wp_enqueue_script('chosen-jquery', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/js/chosen.jquery.js', array('jquery'), VIRAL_NEWS_VERSION, true);
            wp_enqueue_script('wp-color-picker-alpha', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), VIRAL_NEWS_VERSION, true);
            wp_enqueue_script('viral-customizer-control', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/js/customizer-controls.js', array('jquery', 'jquery-ui-datepicker'), VIRAL_NEWS_VERSION, true);

            wp_enqueue_style('selectize', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/css/selectize.css', array(), VIRAL_NEWS_VERSION);
            wp_enqueue_style('chosen', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/css/chosen.css', array(), VIRAL_NEWS_VERSION);
            if (is_rtl()) {
                wp_enqueue_style('viral-customizer-control', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/css/customizer-controls.rtl.css', array('wp-color-picker'), VIRAL_NEWS_VERSION);
            } else {
                wp_enqueue_style('viral-customizer-control', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/css/customizer-controls.css', array('wp-color-picker'), VIRAL_NEWS_VERSION);
            }
        }

    }

    new Viral_News_Customizer_Custom_Controls();
}



