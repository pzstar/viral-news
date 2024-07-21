<?php

/** Selector Control */
class Viral_News_Selector_Control extends WP_Customize_Control {

    public $type = 'ht--selector';
    public $options = array();
    public $class = '';

    public function __construct($manager, $id, $args = array()) {
        $this->options = $args['options'];
        $this->class = isset($args['class']) ? $args['class'] : '';
        parent::__construct($manager, $id, $args);
    }

    public function render_content() {
        $options = $this->options;
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

            <div class="ht--selector-labels <?php echo esc_attr($this->class) ?>">
                <?php
                foreach ($options as $key => $image) {
                    $selected_class = ($this->value() == $key) ? 'selector-selected' : '';
                    echo '<label class="' . esc_attr($selected_class) . '" data-val="' . esc_attr($key) . '">';
                    echo '<img src="' . esc_url($image) . '"/>';
                    echo '</label>';
                }
                ?>
            </div>
            <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />

        </label>
        <?php
    }

}
