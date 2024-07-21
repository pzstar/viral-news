<?php

/** Checkbox Control */
class Viral_News_Toggle_Control extends WP_Customize_Control {

    /**
     * Control type
     *
     * @var string
     */
    public $type = 'ht--toggle';

    /**
     * Control method
     *
     * @since 1.0.0
     */
    public function render_content() {
        ?>
        <div class="ht--toggle-container">
            <div class="ht--toggle">
                <input class="ht--toggle-checkbox" type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" <?php checked($this->value()); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
                <label class="ht--toggle-label" for="<?php echo esc_attr($this->id); ?>"></label>
            </div>
            <span class="customize-control-title ht--toggle-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) { ?>
                <span class="description customize-control-description">
                    <?php echo $this->description; ?>
                </span>
            <?php } ?>
        </div>
        <?php
    }

}
