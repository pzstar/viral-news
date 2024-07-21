<?php

/** Image Select Control */
class Viral_News_Image_Selector_Control extends WP_Customize_Control {

    public $type = 'select';

    public function __construct($manager, $id, $args = array(), $choices = array()) {
        $this->image_path = $args['image_path'];
        $this->image_type = isset($args['image_type']) ? $args['image_type'] : 'jpg';
        $this->choices = $args['choices'];
        parent::__construct($manager, $id, $args);
    }

    public function render_content() {
        if (!empty($this->choices)) {
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

                <select class="ht--image-selector" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $key => $choice) {
                        printf('<option data-image="%1$s" value="%2$s" %3$s>%4$s</option>', esc_attr($this->image_path . $key) . '.' . esc_attr($this->image_type), esc_attr($key), selected($this->value(), $key, false), esc_html($choice));
                    }
                    ?>
                </select>

                <div class="ht--image-container"><img src="<?php echo esc_url($this->image_path . $this->value() . '.' . esc_attr($this->image_type)); ?>" /></div>
            </label>
            <?php
        }
    }

}
