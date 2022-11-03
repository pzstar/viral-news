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

            <?php if ($this->description && !empty($this->choices)) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }

            if (empty($this->choices)) {
                echo $this->empty_text;
                return;
            } else {

                $new_array = $choices = $this->choices;
                $stored = $unstored = array();

                $saved_value = $this->value();
                if (!is_array($saved_value)) {
                    $saved_value = array();
                }

                if ($saved_value) {
                    foreach ($saved_value as $val) {
                        $stored[$val] = $choices[$val];
                    }

                    foreach ($choices as $value => $label) {
                        $selected = '';
                        if (!in_array($value, $saved_value)) {
                            $unstored[$value] = $label;
                        }
                    }

                    $new_array = $stored + $unstored;
                }
                ?>

                <select data-placeholder="<?php echo esc_html($this->placeholder); ?>" multiple="multiple" class="ht--selectize" <?php $this->link(); ?>>
                    <?php
                    foreach ($new_array as $value => $label) {
                        echo '<option value="' . esc_attr($value) . '">' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            <?php } ?>
        </label>
        <?php
    }

}
