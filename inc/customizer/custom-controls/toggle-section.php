<?php
if (class_exists('WP_Customize_Section')) {

    /**
     * Class Viral_News_Toggle_Section
     *
     * @access public
     */
    class Viral_News_Toggle_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @access public
         * @var    string
         */
        public $type = 'ht--toggle-section';

        /**
         * Flag to display icon when entering in customizer
         *
         * @access public
         * @var bool
         */
        public $hide;

        /**
         * Name of customizer hiding control.
         *
         * @access public
         * @var bool
         */
        public $hiding_control;

        /**
         * Viral_News_Toggle_Section constructor.
         *
         * @param WP_Customize_Manager $manager Customizer Manager.
         * @param string               $id Control id.
         * @param array                $args Arguments.
         */
        public function __construct(WP_Customize_Manager $manager, $id, array $args = array()) {
            parent::__construct($manager, $id, $args);

            $default = isset($args['default']) ? $args['default'] : 'off';
            if (isset($args['hiding_control'])) {
                $this->hide = get_theme_mod($args['hiding_control'], $default);
            }

            add_action('customize_controls_init', array($this, 'enqueue'));
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @access public
         */
        public function json() {
            $json = parent::json();
            $json['hide'] = $this->hide;
            $json['hiding_control'] = $this->hiding_control;
            return $json;
        }

        /**
         * Enqueue function.
         *
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script('ht--toggle-section', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/assets/js/toggle-section.js', array('jquery'), VIRAL_NEWS_VERSION, true);
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
                <h3 class="accordion-section-title <# if ( data.hide != 'on' ) { #> ht--section-visible <# } else { #> ht--section-hidden <# }#>" tabindex="0">
                    <button type="button" class="accordion-trigger" aria-expanded="false" aria-controls="{{ data.id }}-content">
                    {{ data.title }}
                    <# if ( data.hide !== 'on' ) { #>
                    <a data-control="{{ data.hiding_control }}" class="ht--toggle-section" href="#"><span class="dashicons dashicons-visibility"></span></a>
                    <# } else { #>
                    <a data-control="{{ data.hiding_control }}" class="ht--toggle-section" href="#"><span class="dashicons dashicons-hidden"></span></a>
                    <# } #>
                    </button>
                </h3>
                <ul class="accordion-section-content">
                    <li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
                        <div class="customize-section-title">
                            <button class="customize-section-back" tabindex="-1">
                            </button>
                            <h3>
                                <span class="customize-action">
                                    {{{ data.customizeAction }}}
                                </span>
                                {{ data.title }}
                            </h3>
                            <# if ( data.description && data.description_hidden ) { #>
                            <button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"></button>
                            <div class="description customize-section-description">
                                {{{ data.description }}}
                            </div>
                            <# } #>
                        </div>

                        <# if ( data.description && ! data.description_hidden ) { #>
                        <div class="description customize-section-description">
                            {{{ data.description }}}
                        </div>
                        <# } #>
                    </li>
                </ul>
            </li>
            <?php
        }

    }

}