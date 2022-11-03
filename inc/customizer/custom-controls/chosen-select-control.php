<?php

/** Select2 Chooser */
class Viral_News_Chosen_Select_Control extends WP_Customize_Control {

    public $type = 'ht--chosen-select';

    public function render_content() {
        if (empty($this->choices)) {
            return;
        }
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

            <select class="ht--chosen-select" <?php $this->link(); ?>>
                <?php
                foreach ($this->choices as $value => $label) {
                    echo '<option value="' . esc_attr($value) . '" ' . selected($value, $this->value(), false) . '>' . esc_html($label) . '</option>';
                }
                ?>
            </select>
        </label>
        <?php
    }

}
