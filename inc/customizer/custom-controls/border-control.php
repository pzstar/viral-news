<?php

/** Border Control */
class Viral_News_Border_Control extends WP_Customize_Control {

    /**
     * Official control name.
     */
    public $type = 'ht--border';
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

        $this->json['id'] = $this->id;
        $this->json['l10n'] = $this->l10n();
        $this->json['border_type'] = array();
        $this->json['top'] = array();
        $this->json['right'] = array();
        $this->json['bottom'] = array();
        $this->json['left'] = array();

        foreach ($this->settings as $setting_key => $setting) {
            $this->json[$setting_key] = array(
                'id' => $setting->id,
                'link' => $this->get_link($setting_key),
                'value' => $this->value($setting_key),
            );

            if ('border_type' === $setting_key) {
                $this->json[$setting_key]['default_choices'] = $this->get_all_border_types();
            }
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
            'border_width' => esc_attr__('Width', 'viral-news'),
            'border_type' => esc_attr__('Border Type', 'viral-news'),
            'color' => esc_attr__('Border Color', 'viral-news'),
            'top' => esc_attr__('Top', 'viral-news'),
            'right' => esc_attr__('Right', 'viral-news'),
            'bottom' => esc_attr__('Bottom', 'viral-news'),
            'left' => esc_attr__('Left', 'viral-news')
        );
        if (false === $id) {
            return $translation_strings;
        }
        return $translation_strings[$id];
    }

    /**
     * Renders the control wrapper and calls $this->render_content() for the internals.
     *
     * @see WP_Customize_Control::render()
     */
    protected function render() {
        $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
        $class = 'customize-control customize-control-' . $this->type;
        ?>
        <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
            <?php $this->render_content(); ?>
        </li><?php
    }

    /**
     * Render the control.
     */
    public function content_template() {
        ?>
        <# if ( data.label ) { #>
        <span class="customize-control-title">{{ data.label }}</span>
        <# } #>

        <ul>
            <li class="ht--border-type">
                <span class="customize-control-title">
                    {{{ data.l10n['border_type'] }}}
                </span>

                <select {{{ data.border_type.link }}} data-default="{{data.border_type.default}}">

                    <# if ( data.border_type.default_choices ) { #>
                    <# _.each( data.border_type.default_choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.border_type.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>
                    <# } #>

                </select>
            </li>

            <li class="ht--border-width">
                <span class="customize-control-title">
                    {{{ data.l10n['border_width'] }}}
                </span>

                <ul>
                    <li class="ht--dimension-wrap top">
                        <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-top" {{{ data.top.link }}} value="{{{ data.top.value }}}" />
                            <span class="ht--dimension-label">{{ data.l10n[ 'top' ] }}</span>
                    </li>

                    <li class="ht--dimension-wrap right">
                        <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-right" {{{ data.right.link }}} value="{{{ data.right.value }}}" />
                            <span class="ht--dimension-label">{{ data.l10n[ 'right' ] }}</span>
                    </li>

                    <li class="ht--dimension-wrap bottom">
                        <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-bottom" {{{ data.bottom.link }}} value="{{{ data.bottom.value }}}" />
                            <span class="ht--dimension-label">{{ data.l10n[ 'bottom' ] }}</span>
                    </li>

                    <li class="ht--dimension-wrap left">
                        <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-left" {{{ data.left.link }}} value="{{{ data.left.value }}}" />
                            <span class="ht--dimension-label">{{ data.l10n[ 'left' ] }}</span>
                    </li>

                    <li class="ht--dimension-wrap">
                        <div class="ht--link-dimensions">
                            <span class="dashicons dashicons-admin-links ht--linked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                            <span class="dashicons dashicons-editor-unlink ht--unlinked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                        </div>
                    </li>
                </ul>

            </li>

            <# if ( data.color ) { #>
            <li class="ht--border-color">
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

    /**
     * Returns the available Default border types.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    function get_all_border_types() {
        return array(
            '' => esc_attr__('None', 'viral-news'),
            'solid' => esc_attr__('Solid', 'viral-news'),
            'double' => esc_attr__('Double', 'viral-news'),
            'dotted' => esc_attr__('Dotted', 'viral-news'),
            'dashed' => esc_attr__('Dashed', 'viral-news'),
            'groove' => esc_attr__('Groove', 'viral-news')
        );
    }

}
