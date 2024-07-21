<?php

/** Dimensions Control */
class Viral_News_Dimensions_Control extends WP_Customize_Control {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'ht--dimensions';
    public $responsive = true;

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['responsive'])) {
            $this->responsive = $args['responsive'];
        }
        //$this->device = implode(' ', $this->device);
        parent::__construct($manager, $id, $args);
    }

    /**
     * Renders the control wrapper and calls $this->render_content() for the internals.
     *
     * @see WP_Customize_Control::render()
     */
    protected function render() {
        $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
        $switcher_class = $this->responsive ? ' has-switchers' : '';
        $class = 'customize-control customize-control-' . $this->type . $switcher_class;
        ?>
        <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
            <?php $this->render_content(); ?>
        </li><?php
    }

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @see WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();

        $this->json['id'] = $this->id;
        $this->json['l10n'] = $this->l10n();
        $this->json['title'] = esc_html__('Link values together', 'viral-news');
        $this->json['responsive'] = $this->responsive;

        $this->json['inputAttrs'] = '';
        foreach ($this->input_attrs as $attr => $value) {
            $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
        }

        $this->json['desktop'] = array();
        $this->json['tablet'] = array();
        $this->json['mobile'] = array();

        foreach ($this->settings as $setting_key => $setting) {

            list($_key) = explode('_', $setting_key);

            $this->json[$_key][$setting_key] = array(
                'id' => $setting->id,
                'link' => $this->get_link($setting_key),
                'value' => $this->value($setting_key),
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
        <# if ( data.label ) { #>
        <span class="customize-control-title">
            <span>{{{ data.label }}}</span>

            <# if ( data.responsive ) { #>
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

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <ul class="desktop control-wrap active">
            <# _.each( data.desktop, function( args, key ) { #>
            <li class="ht--dimension-wrap {{ key }}">
                <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                    <span class="ht--dimension-label">{{ data.l10n[ key ] }}</span>
            </li>
            <# } ); #>

            <li class="ht--dimension-wrap">
                <div class="ht--link-dimensions">
                    <span class="dashicons dashicons-admin-links ht--linked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                    <span class="dashicons dashicons-editor-unlink ht--unlinked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                </div>
            </li>
        </ul>

        <# if ( data.responsive ) { #>
        <ul class="tablet control-wrap">
            <# _.each( data.tablet, function( args, key ) { #>
            <li class="ht--dimension-wrap {{ key }}">
                <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                    <span class="ht--dimension-label">{{ data.l10n[ key ] }}</span>
            </li>
            <# } ); #>

            <li class="ht--dimension-wrap">
                <div class="ht--link-dimensions">
                    <span class="dashicons dashicons-admin-links ht--linked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
                    <span class="dashicons dashicons-editor-unlink ht--unlinked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
                </div>
            </li>
        </ul>
        <# } #>

        <# if ( data.responsive ) { #>
        <ul class="mobile control-wrap">
            <# _.each( data.mobile, function( args, key ) { #>
            <li class="ht--dimension-wrap {{ key }}">
                <input {{{ data.inputAttrs }}} type="number" class="ht--dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                    <span class="ht--dimension-label">{{ data.l10n[ key ] }}</span>
            </li>
            <# } ); #>

            <li class="ht--dimension-wrap">
                <div class="ht--link-dimensions">
                    <span class="dashicons dashicons-admin-links ht--linked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
                    <span class="dashicons dashicons-editor-unlink ht--unlinked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
                </div>
            </li>
        </ul>
        <# } #>

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
            'desktop_top' => esc_attr__('Top', 'viral-news'),
            'desktop_right' => esc_attr__('Right', 'viral-news'),
            'desktop_bottom' => esc_attr__('Bottom', 'viral-news'),
            'desktop_left' => esc_attr__('Left', 'viral-news'),
            'tablet_top' => esc_attr__('Top', 'viral-news'),
            'tablet_right' => esc_attr__('Right', 'viral-news'),
            'tablet_bottom' => esc_attr__('Bottom', 'viral-news'),
            'tablet_left' => esc_attr__('Left', 'viral-news'),
            'mobile_top' => esc_attr__('Top', 'viral-news'),
            'mobile_right' => esc_attr__('Right', 'viral-news'),
            'mobile_bottom' => esc_attr__('Bottom', 'viral-news'),
            'mobile_left' => esc_attr__('Left', 'viral-news'),
        );
        if (false === $id) {
            return $translation_strings;
        }
        return $translation_strings[$id];
    }

}
