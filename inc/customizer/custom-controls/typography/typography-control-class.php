<?php

/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */
class Viral_News_Typography_Control extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'ht--typography';

    /**
     * Array 
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $l10n = array();

    /**
     * Set up our control.
     *
     * @since  1.0.0
     * @access public
     * @param  object  $manager
     * @param  string  $id
     * @param  array   $args
     * @return void
     */
    public function __construct($manager, $id, $args = array()) {
        // Let the parent class do its thing.
        parent::__construct($manager, $id, $args);
        // Make sure we have labels.
        $this->l10n = wp_parse_args(
                $this->l10n, array(
            'family' => esc_html__('Font Family', 'viral-news'),
            'style' => esc_html__('Font Weight/Style', 'viral-news'),
            'text_transform' => esc_html__('Text Transform', 'viral-news'),
            'text_decoration' => esc_html__('Text Decoration', 'viral-news'),
            'size' => esc_html__('Font Size', 'viral-news'),
            'line_height' => esc_html__('Line Height', 'viral-news'),
            'letter_spacing' => esc_html__('Letter Spacing', 'viral-news'),
            'color' => esc_html__('Font Color', 'viral-news')
                )
        );
    }

    /**
     * Renders the control wrapper and calls $this->render_content() for the internals.
     *
     * @see WP_Customize_Control::render()
     */
    protected function render() {
        $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
        $class = 'customize-control has-switchers customize-control-' . $this->type;
        ?>
        <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
            <?php $this->render_content(); ?>
        </li><?php
    }

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {
        wp_enqueue_script('ht--customize-typograhpy-controls', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/typography/js/customize-controls.js', array('jquery'), VIRAL_NEWS_VERSION, true);
        wp_enqueue_style('ht--customize-typograhpy-controls', VIRAL_NEWS_CUSTOMIZER_URL . 'custom-controls/typography/css/customize-controls.css', array(), VIRAL_NEWS_VERSION);
    }

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function to_json() {
        parent::to_json();
        // Loop through each of the settings and set up the data for it.
        $this->json['inputAttrs'] = '';
        foreach ($this->input_attrs as $attr => $value) {
            $this->json['inputAttrs'] .= esc_attr($attr) . '="' . esc_attr($value) . '" ';
        }

        $this->json['size'] = array();
        $this->json['size_tablet'] = array();
        $this->json['size_mobile'] = array();
        $this->json['line_height'] = array();
        $this->json['line_height_tablet'] = array();
        $this->json['line_height_mobile'] = array();
        $this->json['letter_spacing'] = array();
        $this->json['letter_spacing_tablet'] = array();
        $this->json['letter_spacing_mobile'] = array();

        foreach ($this->settings as $setting_key => $setting_id) {
            $this->json[$setting_key] = array(
                'link' => $this->get_link($setting_key),
                'value' => $this->value($setting_key),
                'label' => isset($this->l10n[$setting_key]) ? $this->l10n[$setting_key] : ''
            );

            if ('family' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_registered_fonts();
            } elseif ('style' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_font_weight_choices();
            } elseif ('text_transform' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_text_transform_choices();
            } elseif ('text_decoration' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_text_decoration_choices();
            }
        }
    }

    /**
     * Underscore JS template to handle the control's output.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function content_template() {
        ?>
        <# if ( data.label ) { #>
        <span class="customize-control-title ht--typography-customize-control-title">{{ data.label }}</span>
        <# } #>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <ul>
            <# if ( data.family ) { #>
            <li class="ht--typography-font-family">
                <# if ( data.family.label ) { #>
                <span class="customize-control-title">{{ data.family.label }}</span>
                <# } #>

                <select {{{ data.family.link }}} data-default="{{data.family.default}}">
                    <# if ( data.family.choices ) { _.each(data.family.choices, function(options){ #>
                    <optgroup label="{{options.label}}">
                        <# _.each( options.fonts, function( label, value ) { #>
                        <option value="{{ label.family }}" <# if ( label.family === data.family.value ) { #> selected="selected" <# } #>>{{ label.family }}</option>
                        <# } ) #>
                    </optgroup>
                    <# }) } #>
                </select>
            </li>
            <# } #>

            <# if ( data.style && data.style.choices ) { #>
            <li class="ht--typography-font-style">
                <# if ( data.style.label ) { #>
                <span class="customize-control-title">{{ data.style.label }}</span>
                <# } #>
                <select {{{ data.style.link }}}>
                    <# _.each( data.style.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>
                </select>
            </li>
            <# } #>

            <# if ( data.text_transform && data.text_transform.choices ) { #>
            <li class="ht--typography-text-transform">
                <# if ( data.text_transform.label ) { #>
                <span class="customize-control-title">{{ data.text_transform.label }}</span>
                <# } #>
                <select {{{ data.text_transform.link }}}>
                    <# _.each( data.text_transform.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.text_transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>
                </select>
            </li>
            <# } #>

            <# if ( data.text_decoration && data.text_decoration.choices ) { #>
            <li class="ht--typography-text-decoration">
                <# if ( data.text_decoration.label ) { #>
                <span class="customize-control-title">{{ data.text_decoration.label }}</span>
                <# } #>
                <select {{{ data.text_decoration.link }}}>
                    <# _.each( data.text_decoration.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.text_decoration.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>
                </select>
            </li>
            <# } #>

            <# if ( !_.isEmpty(data.size) ) { #>
            <li class="ht--typography-font-size">
                <# if ( data.size.label ) { #>
                <span class="customize-control-title">
                    <span>{{ data.size.label }} (px)</span>
                    <# if ( !_.isEmpty(data.size_tablet) && !_.isEmpty(data.size_mobile) ) { #>
                    <ul class="responsive-switchers">
                        <li class="desktop">
                            <button type="button" class="preview-desktop active" data-device="desktop">
                                <i class="dashicons dashicons-desktop"></i>
                            </button>
                        </li>
                        <li class="tablet">
                            <button type="button" class="preview-tablet" data-device="tablet">
                                <i class="dashicons dashicons-tablet"></i>
                            </button>
                        </li>
                        <li class="mobile">
                            <button type="button" class="preview-mobile" data-device="mobile">
                                <i class="dashicons dashicons-smartphone"></i>
                            </button>
                        </li>
                    </ul>
                    <# } #>
                </span>
                <# } #>

                <div class="ht--range-slider-control-wrap<# if ( !_.isEmpty(data.size_tablet) && !_.isEmpty(data.size_mobile) ) { #> desktop control-wrap active<# } #>">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.size.value }}" {{{ data.size.link }}} {{{ data.inputAttrs }}} />
                    </div>
                </div>

                <# if ( !_.isEmpty(data.size_tablet) ) { #>
                <div class="tablet ht--range-slider-control-wrap control-wrap">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.size_tablet.value }}" {{{ data.size_tablet.link }}} {{{ data.inputAttrs }}} />
                    </div>
                </div>
                <# } #>

                <# if ( !_.isEmpty(data.size_mobile) ) { #>
                <div class="mobile ht--range-slider-control-wrap control-wrap">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.size_mobile.value }}" {{{ data.size_mobile.link }}} {{{ data.inputAttrs }}} />
                    </div>
                </div>
                <# } #>
            </li>
            <# } #>

            <# if ( !_.isEmpty(data.letter_spacing) ) { #>
            <li class="ht--typography-letter-spacing">
                <# if ( data.letter_spacing.label ) { #>
                <span class="customize-control-title">
                    <span>{{ data.letter_spacing.label }} (px)</span>
                    <# if ( !_.isEmpty(data.letter_spacing_tablet) && !_.isEmpty(data.letter_spacing_mobile) ) { #>
                    <ul class="responsive-switchers">
                        <li class="desktop">
                            <button type="button" class="preview-desktop active" data-device="desktop">
                                <i class="dashicons dashicons-desktop"></i>
                            </button>
                        </li>
                        <li class="tablet">
                            <button type="button" class="preview-tablet" data-device="tablet">
                                <i class="dashicons dashicons-tablet"></i>
                            </button>
                        </li>
                        <li class="mobile">
                            <button type="button" class="preview-mobile" data-device="mobile">
                                <i class="dashicons dashicons-smartphone"></i>
                            </button>
                        </li>
                    </ul>
                    <# } #>
                </span>
                <# } #>

                <div class="ht--range-slider-control-wrap<# if ( !_.isEmpty(data.letter_spacing_tablet) && !_.isEmpty(data.letter_spacing_mobile) ) { #> desktop control-wrap active <# } #>">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.letter_spacing.value }}" min="-10" max="10" step="0.1" {{{ data.letter_spacing.link }}} />
                    </div>
                </div>

                <# if ( !_.isEmpty(data.letter_spacing_tablet) ) { #>
                <div class="tablet ht--range-slider-control-wrap control-wrap">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.letter_spacing_tablet.value }}" min="-10" max="10" step="0.1" {{{ data.letter_spacing_tablet.link }}} />
                    </div>
                </div>
                <# } #>

                <# if ( !_.isEmpty(data.letter_spacing_mobile) ) { #>
                <div class="mobile ht--range-slider-control-wrap control-wrap">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.letter_spacing_mobile.value }}" min="-10" max="10" step="0.1" {{{ data.letter_spacing_mobile.link }}} />
                    </div>
                </div>
                <# } #>
            </li>
            <# } #>

            <# if ( !_.isEmpty(data.line_height) ) { #>
            <li class="ht--typography-line-height">
                <# if ( data.line_height.label ) { #>
                <span class="customize-control-title">
                    <span>{{ data.line_height.label }}</span>
                    <# if ( !_.isEmpty(data.line_height_tablet) && !_.isEmpty(data.line_height_mobile) ) { #>
                    <ul class="responsive-switchers">
                        <li class="desktop">
                            <button type="button" class="preview-desktop active" data-device="desktop">
                                <i class="dashicons dashicons-desktop"></i>
                            </button>
                        </li>
                        <li class="tablet">
                            <button type="button" class="preview-tablet" data-device="tablet">
                                <i class="dashicons dashicons-tablet"></i>
                            </button>
                        </li>
                        <li class="mobile">
                            <button type="button" class="preview-mobile" data-device="mobile">
                                <i class="dashicons dashicons-smartphone"></i>
                            </button>
                        </li>
                    </ul>
                    <# } #>
                </span>
                <# } #>

                <div class="ht--range-slider-control-wrap<# if ( !_.isEmpty(data.line_height_tablet) && !_.isEmpty(data.line_height_mobile) ) { #> desktop control-wrap active <# } #>">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.line_height.value }}" min="0.8" max="5" step="0.1" {{{ data.line_height.link }}} />
                    </div>
                </div>

                <# if ( !_.isEmpty(data.line_height_tablet) ) { #>
                <div class="tablet ht--range-slider-control-wrap control-wrap">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.line_height_tablet.value }}" min="0.8" max="5" step="0.1" {{{ data.line_height_tablet.link }}} />
                    </div>
                </div>
                <# } #>

                <# if ( !_.isEmpty(data.line_height_mobile) ) { #>
                <div class="mobile ht--range-slider-control-wrap control-wrap">
                    <div class="ht--range-slider"></div>
                    <div class="ht--range-slider-input">
                        <input type="number" value="{{ data.line_height_mobile.value }}" min="0.8" max="5" step="0.1" {{{ data.line_height_mobile.link }}} />
                    </div>
                </div>
                <# } #>
            </li>
            <# } #>

            <# if ( data.color ) { #>
            <li class="ht--typography-color">
                <# if ( data.color.label ) { #>
                <span class="customize-control-title">{{{ data.color.label }}}</span>
                <# } #>

                <div class="customize-control-content">
                    <input class="ht--color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e('Hex Value', 'viral-news'); ?>" {{{ data.color.link }}} value="{{ data.color.value }}" />
                </div>
            </li>
            <# } #>

        </ul>
        <?php
    }

    /**
     * Returns the all registered fonts with label.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_registered_fonts() {
        return viral_news_register_fonts();
    }

    /**
     * Returns the all fonts.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_fonts() {
        return viral_news_all_fonts();
    }

    /**
     * Returns the available font weights.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_font_weight_choices() {
        $fonts = $this->get_fonts();

        if ($this->settings['family']->id) {
            $font_family_id = $this->settings['family']->id;
            $default_font_family = $this->settings['family']->default;
            $font_family = get_theme_mod($font_family_id, $default_font_family);

            if (isset($fonts[$font_family]['variants'])) {
                return $fonts[$font_family]['variants'];
            }
        }

        return array(
            '400' => esc_html__('Normal', 'viral-news'),
            '400italic' => esc_html__('Normal Italic', 'viral-news'),
            '700' => esc_html__('Bold', 'viral-news'),
            '700italic' => esc_html__('Bold Italic', 'viral-news')
        );
    }

    /**
     * Returns the available font text decoration.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_text_decoration_choices() {
        return array(
            'none' => esc_html__('None', 'viral-news'),
            'underline' => esc_html__('Underline', 'viral-news'),
            'line-through' => esc_html__('Line-through', 'viral-news'),
            'overline' => esc_html__('Overline', 'viral-news')
        );
    }

    /**
     * Returns the available font text transform.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_text_transform_choices() {
        return array(
            'none' => esc_html__('None', 'viral-news'),
            'uppercase' => esc_html__('Uppercase', 'viral-news'),
            'lowercase' => esc_html__('Lowercase', 'viral-news'),
            'capitalize' => esc_html__('Capitalize', 'viral-news')
        );
    }

}
