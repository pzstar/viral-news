<?php

/** Alpha Color Control */
class Viral_News_Alpha_Color_Control extends WP_Customize_Control {

    /**
     * Official control name.
     */
    public $type = 'ht--alpha-color';

    /**
     * Add support for palettes to be passed in.
     *
     * Supported palette values are true, false, or an array of RGBa and Hex colors.
     */
    public $palette;

    /**
     * Add support for showing the opacity value on the slider handle.
     */
    public $show_opacity;

    /**
     * Render the control.
     */
    public function render_content() {

        // Process the palette
        if (is_array($this->palette)) {
            $palette = implode('|', $this->palette);
        } else {
            // Default to true.
            $palette = (false === $this->palette || 'false' === $this->palette) ? 'false' : 'true';
        }

        // Support passing show_opacity as string or boolean. Default to true.
        $show_opacity = (false === $this->show_opacity || 'false' === $this->show_opacity) ? 'false' : 'true';

        // Begin the output. 
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if (!empty($this->description)) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>
        </label>
        <input class="ht--alpha-color-control" data-alpha-color-type="hex" data-alpha-enabled="<?php echo esc_attr($show_opacity); ?>" type="text" data-palette="<?php echo esc_attr($palette); ?>" data-default-color="<?php echo esc_attr($this->settings['default']->default); ?>" <?php $this->link(); ?> />
        <?php
    }

}
