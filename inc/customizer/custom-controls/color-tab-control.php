<?php

/** Color Tab Control */
class Viral_News_Color_Tab_Control extends WP_Customize_Control {

    public $type = 'ht--color-tab';

    /**
     * Add support for palettes to be passed in.
     *
     * Supported palette values are true, false, or an array of RGBa and Hex colors.
     */
    public $palette;

    /**
     * Add support for showing the opacity value on the slider handle.
     */
    public $show_opacity = false;
    public $hide_control = true;
    public $group;

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['palette'])) {
            $this->palette = $args['palette'];
        }

        if (isset($args['hide_control'])) {
            $this->hide_control = $args['hide_control'];
        }

        if (isset($args['show_opacity'])) {
            $this->show_opacity = $args['show_opacity'];
        }
        parent::__construct($manager, $id, $args);
    }

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @see WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();

        // Process the palette
        if (is_array($this->palette)) {
            $palette_string = implode('|', $this->palette);
        } else {
            // Default to true.
            $palette_string = (false === $this->palette || 'false' === $this->palette) ? 'false' : 'true';
        }
        $this->json['show_opacity'] = (false === $this->show_opacity || 'false' === $this->show_opacity) ? 'false' : 'true';
        $this->json['group'] = array();
        $this->json['l10n'] = $this->l10n();
        $this->json['group'] = $this->group;
        $this->json['palette'] = $palette_string;
        $this->json['hide_control'] = $this->hide_control;
        $this->json['hide_control_style'] = $this->hide_control ? 'style="display:none"' : '';

        foreach ($this->settings as $setting_key => $setting) {
            list($_key) = explode('_', $setting_key);
            $this->json[$_key][$setting_key] = array(
                'id' => $setting->id,
                'link' => $this->get_link($setting_key),
                'value' => $this->value($setting_key),
                'default' => $setting->default
            );
        }
    }

    /**
     * An Underscore (JS) template for this control's content (but not its container).
     *
     * Class variables for this control class are available in the `data` JS object;
     * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
     *
     * @see WP_Customize_Control::print_template()
     *
     * @access protected
     */
    protected function content_template() {
        ?>
        <span class="customize-control-title">
            <# if ( data.label ) { #>
            <label>{{{ data.label }}}</label>
            <# } #>

            <# if ( data.hide_control ) { #>
            <div class="ht--color-tab-toggle"><span class="dashicons dashicons-edit"></span></div>
            <# } #>
        </span>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <div class="ht--color-tab-wrap" {{{ data.hide_control_style }}}>
             <ul class="ht--color-tab-switchers">
                <li data-tab="ht--color-tab-content-normal" class="active">{{{ data.l10n['normal'] }}}</li>
                <li data-tab="ht--color-tab-content-hover">{{{ data.l10n['hover'] }}}</li>
            </ul>

            <div class="ht--color-tab-contents">
                <div class="ht--color-tab-content-normal" style="display:block">
                    <# _.each( data.normal, function( args, key ) { #>
                    <div class="ht--color-content-wrap {{ key }}">
                        <label class="ht--color-tab-label">{{ data.group[ key ] }}</label>
                        <input class="ht--alpha-color-control" type="text" value="{{ args.value }}" data-alpha-color-type="hex" data-alpha-enabled="{{ data.show_opacity }}" data-default-color="{{ args.default }}" data-palette="{{ data.palette }}" {{{ args.link }}} />
                    </div>
                    <# } ); #>
                </div>

                <div class="ht--color-tab-content-hover" style="display:none">
                    <# _.each( data.hover, function( args, key ) { #>
                    <div class="ht--color-content-wrap {{ key }}">
                        <label class="ht--color-tab-label">{{ data.group[ key ] }}</label>
                        <input class="ht--alpha-color-control" type="text" value="{{ args.value }}" data-alpha-color-type="hex" data-alpha-enabled="{{ data.show_opacity }}" data-default-color="{{ args.default }}" data-palette="{{ data.palette }}" {{{ args.link }}} />
                    </div>
                    <# } ); #>
                </div>
            </div>
        </div>
        <?php

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
            'normal' => esc_attr__('Normal', 'viral-news'),
            'hover' => esc_attr__('Hover', 'viral-news')
        );
        if (false === $id) {
            return $translation_strings;
        }
        return $translation_strings[$id];
    }

}
