<?php

/** Multiple Checkbox Control */
class Viral_News_Multiple_Checkbox_Control extends WP_Customize_Control {

    public $type = 'ht--checkbox-multiple';

    public function render_content() {

        if (empty($this->choices)) {
            return;
        }
        ?>

        <span class="customize-control-title">
            <?php echo esc_html($this->label); ?>
        </span>

        <?php if ($this->description) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php } ?>

        <?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>

        <ul>
            <?php foreach ($this->choices as $value => $label): ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> />
                        <?php echo esc_html($label); ?>
                    </label>
                </li>

            <?php endforeach; ?>
        </ul>

        <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
        <?php
    }

}
