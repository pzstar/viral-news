<?php

/** Range Control */
class Viral_News_Range_Slider_Control extends WP_Customize_Control {

    /**
     * The type of control being rendered
     */
    public $type = 'ht--range-slider';
    public $unit = '';

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['unit'])) {
            $this->unit = $args['unit'];
        }
        parent::__construct($manager, $id, $args);
    }

    /**
     * Render the control in the customizer
     */
    public function render_content() {
        ?>
        <span class="customize-control-title">
            <?php echo esc_html($this->label); ?>
            <span class="ht--slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr($this->value()); ?>"></span>
        </span>

        <div class="ht--range-slider-control-wrap">
            <div class="ht--range-slider"></div>
            <div class="ht--range-slider-input">
                <input type="number" value="<?php echo esc_attr($this->value()); ?>" min="<?php echo esc_attr($this->input_attrs['min']); ?>" max="<?php echo esc_attr($this->input_attrs['max']); ?>" step="<?php echo esc_attr($this->input_attrs['step']); ?>" <?php $this->link(); ?> />
            </div>

            <?php if ($this->unit) { ?>
                <div class="ht--range-slider-unit">
                    <?php echo esc_html($this->unit); ?>
                </div>
            <?php } ?>
        </div>

        <?php
        if ($this->description) {
            ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php
        }
    }

}
