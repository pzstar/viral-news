<?php

/** Dropdown Multiple Chooser Control */
class Viral_News_Multiple_Select_Control extends WP_Customize_Control {

    public $type = 'ht--multiple-select';
    public $placeholder;

    public function __construct($manager, $id, $args = array()) {
        $this->placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';

        parent::__construct($manager, $id, $args);
    }

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
            <?php }
            ?>

            <select data-placeholder="<?php echo esc_attr($this->placeholder); ?>" multiple="multiple" class="ht--chosen-select" <?php $this->link(); ?>>
                <?php
                $selected_value = is_array($this->value()) ? $this->value() : array($this->value());
                foreach ($this->choices as $value => $label) {
                    $selected = '';
                    if (in_array($value, $selected_value)) {
                        $selected = 'selected="selected"';
                    }
                    echo '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($label) . '</option>';
                }
                ?>
            </select>
        </label>
        <?php
    }

}
