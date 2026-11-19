<?php

class Viral_News_Multiple_Selectize_Control extends WP_Customize_Control {

    public $type = 'ht--multiple-selectize';
    public $placeholder;
    public $empty_text;

    public function __construct($manager, $id, $args = array()) {
        $this->placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';
        $this->empty_text = isset($args['empty_text']) ? $args['empty_text'] : '';
        parent::__construct($manager, $id, $args);
    }

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
                <?php
            }

            if (empty($this->choices)) {
                echo esc_html($this->empty_text);
                return;
            } else {
                $saved_value = (array) $this->value();
                // Saved items first, in their saved (dragged) order.
                $choices = $this->choices;
                $ordered = array();
                foreach ($saved_value as $val) {
                    if (isset($choices[$val])) {
                        $ordered[$val] = $choices[$val];
                    }
                }
                $ordered += $choices;
                ?>
                <select multiple="multiple" class="ht--selectize" data-placeholder="<?php echo esc_attr($this->placeholder); ?>" <?php $this->link(); ?>>
                    <?php foreach ($ordered as $value => $label): ?>
                        <option value="<?php echo esc_attr($value); ?>" <?php selected(in_array($value, $saved_value), true); ?>>
                            <?php echo esc_html($label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php
            } ?>
        </label>
        <?php
    }

}
