<?php

/** Info Text Control */
class Viral_News_Text_Info_Control extends WP_Customize_Control {

    public function render_content() {
        if ($this->label) {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>
            <?php
        }

        if ($this->description) {
            ?>
            <span class="customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php }
    }

}
