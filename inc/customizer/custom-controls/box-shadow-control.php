<?php

/** Color Tab Control */
class Viral_News_Box_Shadow_Control extends WP_Customize_Control {

    public $type = 'ht--box-shadow';

    /**
     * Add support for palettes to be passed in.
     *
     * Supported palette values are true, false, or an array of RGBa and Hex colors.
     */
    public $unit = '';

    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
    }

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @see WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();
        // Loop through each of the settings and set up the data for it.
        $this->json['inputAttrs'] = '';
        foreach ($this->input_attrs as $attr => $value) {
            $this->json['inputAttrs'] .= esc_attr($attr) . '="' . esc_attr($value) . '" ';
        }

        $this->json['l10n'] = $this->l10n();
        $this->json['x'] = array();
        $this->json['y'] = array();
        $this->json['blur'] = array();
        $this->json['spread'] = array();
        $this->json['inset'] = array();

        foreach ($this->settings as $setting_key => $setting) {
            $this->json[$setting_key] = array(
                'id' => $setting->id,
                'link' => $this->get_link($setting_key),
                'value' => $this->value($setting_key),
                'default' => $setting->default
            );
        }
    }

    /**
     * Returns an array of translation strings.
     *
     * @access protected
     * @param string|false $id The string-ID.
     * @return string
     */
    protected function l10n($id = false) {
        $translation_strings = array(
            'box_shadow' => esc_attr__('Box Shadow', 'viral-news'),
            'x' => esc_attr__('X', 'viral-news'),
            'y' => esc_attr__('Y', 'viral-news'),
            'blur' => esc_attr__('Blur', 'viral-news'),
            'spread' => esc_attr__('Spread', 'viral-news'),
            'inset' => esc_attr__('Inset', 'viral-news'),
            'color' => esc_attr__('Color', 'viral-news'),
        );
        if (false === $id) {
            return $translation_strings;
        }
        return $translation_strings[$id];
    }

    /**
     * Outputs the Underscore.js template.
     *
     * @access public
     * @return void
     */
    protected function content_template() {
        ?>
        <# if ( data.label ) { #>
        <span class="customize-control-title">{{ data.label }}</span>
        <# } #>
        <ul>
            <li class="ht--box-shadow-values">
                <span class="customize-control-title">
                    {{{ data.l10n['box_shadow'] }}}
                </span>

                <ul>
                    <li class="ht--dimension-wrap">
                        <input type="number" value="{{ data.x.value }}" {{{ data.x.link }}} />
                               <span class="ht--dimension-label">{{ data.l10n['x'] }}</span>
                    </li>
                    <li class="ht--dimension-wrap">
                        <input type="number" value="{{ data.y.value }}" {{{ data.y.link }}} />
                               <span class="ht--dimension-label">{{ data.l10n['y'] }}</span>
                    </li>
                    <li class="ht--dimension-wrap">
                        <input type="number" value="{{ data.blur.value }}" {{{ data.blur.link }}} />
                               <span class="ht--dimension-label">{{ data.l10n['blur'] }}</span>
                    </li>
                    <li class="ht--dimension-wrap">
                        <input type="number" value="{{ data.spread.value }}" {{{ data.spread.link }}} />
                               <span class="ht--dimension-label">{{ data.l10n['spread'] }}</span>
                    </li>
                </ul>
            </li>
            <li class="ht--box-shadow-inset">
                <div class="ht--toggle-container">
                    <div class="ht--toggle">
                        <input class="ht--toggle-checkbox" type="checkbox" id="{{ data.inset.id }}" name="<?php echo esc_attr($this->id); ?>" value="{{ data.inset.value }}" {{{ data.inset.link }}} {{ data.inset.value ? 'checked' : '' }} />
                               <label class="ht--toggle-label" for="{{ data.inset.id }}"></label>
                    </div>
                    <span class="customize-control-title ht--toggle-title">{{ data.l10n['inset'] }}</span>
                </div>
            </li>

            <# if ( data.color ) { #>
            <li class="ht--box-shadow-color">
                <span class="customize-control-title">
                    {{{ data.l10n['color'] }}}
                </span>

                <div class="customize-control-content">
                    <input class="ht--color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e('Hex Value', 'viral-news'); ?>" {{{ data.color.link }}} value="{{ data.color.value }}" />
                </div>
            </li>
            <# } #>
        </ul>
        <?php
    }

}
