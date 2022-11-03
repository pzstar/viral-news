<?php

/** Date Control */
class Viral_News_Date_Control extends WP_Customize_Control {

    public $type = 'ht--date-picker';

    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <input class="ht--datepicker" type="text" autocomplete="off" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>>
        </label>
        <?php
    }

}
